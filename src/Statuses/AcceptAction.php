<?php

namespace App\Statuses;

use App\Task;

class AcceptAction extends BaseAction
{

    function can()
    {
        if ($this->task->getStatus() == Task::STATUS_IN_PROGRESS && $this->task->customerID == $this->user) {
            return true;
        }
        return false;
    }

    function getName()
    {
        return 'Принять';
    }

    function getCode()
    {
        return 'accept';
    }
}