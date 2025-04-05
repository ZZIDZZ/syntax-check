public function formRemoveItem(string $formUuid, int $onVersion, string $itemUuid)
    {
        /** @var \Symfony\Component\Security\Core\User\UserInterface $user */
        $user = $this->getUser();

        $success = false;
        $this->commandBus->dispatch(new FormRemoveItemCommand($user->getId(), Uuid::uuid1()->toString(), $formUuid, $onVersion, [
            'uuid' => $itemUuid,
        ], function ($commandBus, $event) use (&$success) {
            // Callback.
            $success = true;
        }));

        if ($success) {
            $this->addFlash(
                'success',
                $this->translator->trans('Field deleted')
            );

            return $this->redirectToForm($formUuid);
        }

        return $this->errorResponse($formUuid);
    }