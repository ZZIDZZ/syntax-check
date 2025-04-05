private static PayPalAccountBuilder parseResponse(PayPalRequest paypalRequest, Request request, Result result,
            Intent intent) {
        PayPalAccountBuilder paypalAccountBuilder = new PayPalAccountBuilder()
                .clientMetadataId(request.getClientMetadataId());

        if (paypalRequest != null && paypalRequest.getMerchantAccountId() != null) {
            paypalAccountBuilder.merchantAccountId(paypalRequest.getMerchantAccountId());
        }

        if (request instanceof CheckoutRequest && paypalRequest != null) {
            paypalAccountBuilder.intent(paypalRequest.getIntent());
        }

        if (isAppSwitch(intent)) {
            paypalAccountBuilder.source("paypal-app");
        } else {
            paypalAccountBuilder.source("paypal-browser");
        }

        paypalAccountBuilder.oneTouchCoreData(result.getResponse());

        return paypalAccountBuilder;
    }