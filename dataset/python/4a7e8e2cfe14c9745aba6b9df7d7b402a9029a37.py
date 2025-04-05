def generate_sentence(self, chain):
        """
        !DEMO!
        Demo function that shows how to generate a simple sentence starting with
        uppercase letter without lenght limit.

        Args:
            chain: MarkovChain that will be used to generate sentence
        """

        def weighted_choice(choices):
            total_weight = sum(weight for val, weight in choices)
            rand = random.uniform(0, total_weight)

            upto = 0
            for val, weight in choices:
                if upto + weight >= rand:
                    return val
                upto += weight

        sentence = list(random.choice(chain.startwords))

        while not sentence[-1][-1] in ['.', '?', '!']:
            sentence.append(
                weighted_choice(
                    chain.content[tuple(sentence[-2:])].items()
                )
            )

        return ' '.join(sentence)