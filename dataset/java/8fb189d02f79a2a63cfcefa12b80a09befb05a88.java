public boolean[] asBoolArray() {
        boolean[] retval;
        UBArray array = asArray();
        switch(array.getStrongType()){
            case Int8: {
                byte[] data = ((UBInt8Array) array).getValues();
                retval = new boolean[data.length];
                for (int i = 0; i < data.length; i++) {
                    retval[i] = data[i] > 0;
                }
                break;
            }

            case Int16: {
                short[] data = ((UBInt16Array) array).getValues();
                retval = new boolean[data.length];
                for (int i = 0; i < data.length; i++) {
                    retval[i] = data[i] > 0;
                }
                break;
            }

            case Int32: {
                int[] data = ((UBInt32Array)array).getValues();
                retval = new boolean[data.length];
                for (int i = 0; i < data.length; i++) {
                    retval[i] = data[i] > 0;
                }
                break;
            }

            case Int64: {
                long[] data = ((UBInt64Array)array).getValues();
                retval = new boolean[data.length];
                for (int i = 0; i < data.length; i++) {
                    retval[i] = data[i] > 0;
                }
                break;
            }

            case Float32: {
                float[] data = ((UBFloat32Array) array).getValues();
                retval = new boolean[data.length];
                for (int i = 0; i < data.length; i++) {
                    retval[i] = data[i] > 0;
                }
                break;
            }

            case Float64: {
                double[] data = ((UBFloat64Array) array).getValues();
                retval = new boolean[data.length];
                for (int i = 0; i < data.length; i++) {
                    retval[i] = data[i] > 0;
                }
                break;
            }


            default:
                throw new RuntimeException("not an int32[] type");
        }

        return retval;
    }