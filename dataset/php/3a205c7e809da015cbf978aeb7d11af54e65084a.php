public function destroy($workOrder_id, $assignment_id)
    {
        if ($this->assignment->destroy($assignment_id)) {
            $this->message = 'Successfully removed worker from this work order.';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.work-orders.show', [$workOrder_id]);
        } else {
            $this->message = 'There was an error trying to remove this worker from this work order. Please try again later.';
            $this->messageType = 'danger';
            $this->redirect = route('maintenance.work-orders.show', [$workOrder_id]);
        }

        return $this->response();
    }