function approach(index, x, onAxis)
        {
            while (0 <= x && x <= 1) {
                candidateHSVA[index] = x;
                WebInspector.Color.hsva2rgba(candidateHSVA, candidateRGBA);
                WebInspector.Color.blendColors(candidateRGBA, bgRGBA, blendedRGBA);
                var fgLuminance = WebInspector.Color.luminance(blendedRGBA);
                var dLuminance = fgLuminance - desiredLuminance;

                if (Math.abs(dLuminance) < (onAxis ? epsilon / 10 : epsilon))
                    return x;
                else
                    x += (index === V ? -dLuminance : dLuminance);
            }
            return null;
        }