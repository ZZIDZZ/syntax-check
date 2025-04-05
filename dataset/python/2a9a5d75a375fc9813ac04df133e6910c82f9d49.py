def estimate_tx_gas(self, safe_address: str, to: str, value: int, data: bytes, operation: int) -> int:
        """
        Estimate tx gas. Use the max of calculation using safe method and web3 if operation == CALL or
        use just the safe calculation otherwise
        """
        # Costs to route through the proxy and nested calls
        proxy_gas = 1000
        # https://github.com/ethereum/solidity/blob/dfe3193c7382c80f1814247a162663a97c3f5e67/libsolidity/codegen/ExpressionCompiler.cpp#L1764
        # This was `false` before solc 0.4.21 -> `m_context.evmVersion().canOverchargeGasForCall()`
        # So gas needed by caller will be around 35k
        old_call_gas = 35000
        safe_gas_estimation = (self.estimate_tx_gas_with_safe(safe_address, to, value, data, operation)
                               + proxy_gas + old_call_gas)
        # We cannot estimate DELEGATECALL (different storage)
        if SafeOperation(operation) == SafeOperation.CALL:
            try:
                web3_gas_estimation = (self.estimate_tx_gas_with_web3(safe_address, to, value, data)
                                       + proxy_gas + old_call_gas)
            except ValueError:
                web3_gas_estimation = 0
            return max(safe_gas_estimation, web3_gas_estimation)

        else:
            return safe_gas_estimation