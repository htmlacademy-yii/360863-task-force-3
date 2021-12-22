<?php

namespace App\Statuses;

use App\Task;

class RejectAction extends BaseAction
{

    function can()
    {
        if ($this->task->getStatus() == Task::STATUS_IN_PROGRESS && $this->task->workerID == $this->user) {
            return true;
        }
        return false;
    }

    function getName()
    {
        return 'Отказаться';
    }

    function getCode()
    {
        return 'reject';
    }
}