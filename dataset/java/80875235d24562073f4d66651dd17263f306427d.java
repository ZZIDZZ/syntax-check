private static void checkResultBLAS()
    {
        if (exceptionsEnabled)
        {
            lastResult = cublasGetErrorNative();
            if (lastResult != cublasStatus.CUBLAS_STATUS_SUCCESS)
            {
                throw new CudaException(cublasStatus.stringFor(lastResult));
            }
        }
    }