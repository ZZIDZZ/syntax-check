def HWProcess(cls, proc, ctx):
        """
        Serialize HWProcess objects as VHDL

        :param scope: name scope to prevent name collisions
        """
        body = proc.statements
        extraVars = []
        extraVarsSerialized = []

        hasToBeVhdlProcess = arr_any(body,
                                     lambda x: isinstance(x,
                                                          (IfContainer,
                                                           SwitchContainer,
                                                           WhileContainer,
                                                           WaitStm)))

        sensitivityList = sorted(
            map(lambda s: cls.sensitivityListItem(s, ctx),
                proc.sensitivityList))

        if hasToBeVhdlProcess:
            childCtx = ctx.withIndent()
        else:
            childCtx = copy(ctx)

        def createTmpVarFn(suggestedName, dtype):
            s = RtlSignal(None, None, dtype, virtualOnly=True)
            s.name = ctx.scope.checkedName(suggestedName, s)
            s.hidden = False
            serializedS = cls.SignalItem(s, childCtx, declaration=True)
            extraVars.append(s)
            extraVarsSerialized.append(serializedS)
            return s

        childCtx.createTmpVarFn = createTmpVarFn

        statemets = [cls.asHdl(s, childCtx) for s in body]
        proc.name = ctx.scope.checkedName(proc.name, proc)

        extraVarsInit = []
        for s in extraVars:
            if isinstance(s.defVal, RtlSignalBase) or s.defVal.vldMask:
                a = Assignment(s.defVal, s, virtualOnly=True)
                extraVarsInit.append(cls.Assignment(a, childCtx))
            else:
                assert s.drivers, s
            for d in s.drivers:
                extraVarsInit.append(cls.asHdl(d, childCtx))

        _hasToBeVhdlProcess = hasToBeVhdlProcess
        hasToBeVhdlProcess = extraVars or hasToBeVhdlProcess

        if hasToBeVhdlProcess and not _hasToBeVhdlProcess:
            # add indent because we did not added it before because we did not
            # know t
            oneIndent = getIndent(1)
            statemets = list(map(lambda x: oneIndent + x, statemets))

        return cls.processTmpl.render(
            indent=getIndent(ctx.indent),
            name=proc.name,
            hasToBeVhdlProcess=hasToBeVhdlProcess,
            extraVars=extraVarsSerialized,
            sensitivityList=", ".join(sensitivityList),
            statements=extraVarsInit + statemets
        )