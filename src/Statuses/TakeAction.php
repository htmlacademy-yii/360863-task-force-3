<?php

namespace App\Statuses;

use App\Task;

class TakeAction extends BaseAction
{

    function can()
    {
        if ($this->task->getStatus() == Task::STATUS_NEW && !$this->task->workerID && $this->task->customerID !== $this->user) {
            return true;
        }

        return false;
    }

    function getName()
    {
        return 'Откликнуться';
    }

    function getCode()
    {
        return 'take';
    }
}