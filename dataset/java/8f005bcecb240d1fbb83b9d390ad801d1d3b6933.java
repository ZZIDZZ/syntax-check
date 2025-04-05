private static LossInfo doReduce(SameDiff sd, String outputName, boolean isMean, LossInfo.Builder b, Reduction reduction,
                          SDVariable preReduceLoss, SDVariable label, SDVariable weights, int[] dimensions){
        switch (reduction){
            case NONE:
                //Return same shape as predictions/labels
                b.loss(preReduceLoss);
                break;
            case SPECIFIED_DIMS:
                //Reduce along specified dimensions
                if(isMean){
                    //Example: MSE + mean along examples
                    b.loss(sd.mean(outputName, preReduceLoss, dimensions));
                } else {
                    //Example: L1 loss (sum) + mean along examples
                    b.loss(sd.sum(outputName, preReduceLoss, dimensions));
                }
            case SUM:
                if(isMean){
                    //Example: MSE (mean) + sum along examples
                    SDVariable m = sd.mean(preReduceLoss, dimensions);
                    b.loss(sd.sum(outputName, m));
                } else {
                    //Example: L1 loss (sum) + sum along examples -> sum along all dimensions
                    b.loss(sd.sum(outputName, preReduceLoss));
                }
                break;
            case MEAN_BY_WEIGHT:
                SDVariable weightSum = sd.sum(weights);
                if(isMean){
                    //Example: MSE (mean) + mean by weights over examples
                    //reduce along dims + reduce along remaining dims == reduce along *all* dims
                    SDVariable m2 = sd.mean(preReduceLoss);
                    b.loss(m2.div(outputName, weightSum));
                } else {
                    //Example: L1 (sum) + mean by weights over examples
                    SDVariable sum = sd.sum(preReduceLoss, dimensions);
                    b.loss(sum.div(outputName, weightSum));
                }
                break;
            case MEAN_BY_COUNT:
                SDVariable nonZeroWeights = nonZeroCount(weights, label);
                SDVariable r;
                if(isMean){
                    //Example: MSE (mean) + mean by count over examples
                    r = sd.sum(preReduceLoss);
                } else {
                    //Example: L1 (sum) + mean by count over examples
                    SDVariable sum = sd.sum(preReduceLoss, dimensions);
                    r = sd.mean(sum);
                }
                b.loss(r.div(outputName, nonZeroWeights));
                break;
            default:
                throw new RuntimeException("Unknown reduction: " + reduction);
        }

        return b.build();
    }