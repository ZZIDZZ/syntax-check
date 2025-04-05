public String convert(Double theMoney) {
        if (theMoney == null) {
            throw new IllegalArgumentException("theMoney is null");
        }
        Long intPart = theMoney.longValue();
        Long fractPart = Math.round((theMoney - intPart) * NUM100);
        if (currency == Currency.PER1000) {
            fractPart = Math.round((theMoney - intPart) * NUM1000);
        }
        return convert(intPart, fractPart);
    }