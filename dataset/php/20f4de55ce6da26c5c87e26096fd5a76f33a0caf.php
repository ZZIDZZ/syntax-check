public function updateAction(Job $job, Request $request)
    {
        $editForm = $this->createForm(new JobType(), $job, array(
            'action' => $this->generateUrl('admin_amulen_job_update', array('id' => $job->getid())),
            'method' => 'PUT',
        ));
        if ($editForm->handleRequest($request)->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('admin_amulen_job_show', array('id' => $job->getId())));
        }
        $deleteForm = $this->createDeleteForm($job->getId(), 'admin_amulen_job_delete');

        return array(
            'job' => $job,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }