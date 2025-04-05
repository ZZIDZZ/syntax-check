public function deleteAction(Request $request, int $id)
    {
        try {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository($this->entityClassName())->find($id);
            $em->remove($entity);
            $em->flush();

            return null;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }