function checkBounds(restrict) {
            var xDiff = 0;
            var yDiff = 0;

            if (boundXmin !== undefined && targetX < boundXmin) {
                xDiff = boundXmin - targetX;
            } else if (boundXmax !== undefined && targetX > boundXmax) {
                xDiff = boundXmax - targetX;
            }

            if (boundYmin !== undefined && targetY < boundYmin) {
                yDiff = boundYmin - targetY;
            } else if (boundYmax !== undefined && targetY > boundYmax) {
                yDiff = boundYmax - targetY;
            }

            if (restrict) {
                if (xDiff !== 0) {
                    targetX = (xDiff > 0) ? boundXmin : boundXmax;
                }
                if (yDiff !== 0) {
                    targetY = (yDiff > 0) ? boundYmin : boundYmax;
                }
            }

            return {
                x: xDiff,
                y: yDiff,
                inBounds: xDiff === 0 && yDiff === 0
            };
        }