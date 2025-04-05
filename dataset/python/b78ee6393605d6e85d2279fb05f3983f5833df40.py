def next_generation(self, mut_rate=0, max_mut_amt=0, log_base=10):
        '''Generates the next population from a previously evaluated generation

        Args:
            mut_rate (float): mutation rate for new members (0.0 - 1.0)
            max_mut_amt (float): how much the member is allowed to mutate
                (0.0 - 1.0, proportion change of mutated parameter)
            log_base (int): the higher this number, the more likely the first
                Members (chosen with supplied selection function) are chosen
                as parents for the next generation
        '''

        if self.__num_processes > 1:
            process_pool = Pool(processes=self.__num_processes)
            members = [m.get() for m in self.__members]
        else:
            members = self.__members

        if len(members) == 0:
            raise Exception(
                'Generation 0 not found: use generate_population() first'
            )

        selected_members = self.__select_fn(members)
        reproduction_probs = list(reversed(logspace(0.0, 1.0,
                                  num=len(selected_members), base=log_base)))
        reproduction_probs = reproduction_probs / sum(reproduction_probs)

        self.__members = []

        for _ in range(self.__pop_size):
            parent_1 = nrandom.choice(selected_members, p=reproduction_probs)
            parent_2 = nrandom.choice(selected_members, p=reproduction_probs)

            feed_dict = {}
            for param in self.__parameters:
                which_parent = uniform(0, 1)
                if which_parent < 0.5:
                    feed_dict[param.name] = parent_1.parameters[param.name]
                else:
                    feed_dict[param.name] = parent_2.parameters[param.name]
                feed_dict[param.name] = self.__mutate_parameter(
                    feed_dict[param.name], param, mut_rate, max_mut_amt
                )

            if self.__num_processes > 1:
                self.__members.append(process_pool.apply_async(
                    self._start_process,
                    [self.__cost_fn, feed_dict, self.__cost_fn_args])
                )
            else:
                self.__members.append(
                    Member(
                        feed_dict,
                        self.__cost_fn(feed_dict, self.__cost_fn_args)
                    )
                )

        if self.__num_processes > 1:
            process_pool.close()
            process_pool.join()

        self.__determine_best_member()