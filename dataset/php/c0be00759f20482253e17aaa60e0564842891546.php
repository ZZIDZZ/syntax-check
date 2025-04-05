public function updateShippingAddress(ResourceControllerEvent $event): void
    {
        /** @var Order $order */
        $order = $event->getSubject();

        $pickup = $this->getPickupAddress($order);

        if (!empty($pickup)) {
            $shipping = clone $order->getShippingAddress();
            $shipping->setCompany($pickup['company']);
            $shipping->setStreet($pickup['street_1']);
            $shipping->setCity($pickup['city']);
            $shipping->setPostcode($pickup['postcode']);
            $shipping->setCountryCode($pickup['country']);

            $order->setShippingAddress($shipping);
        }
    }