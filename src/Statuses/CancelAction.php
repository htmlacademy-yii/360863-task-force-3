<?php

namespace App\Statuses;

use App\Task;

class CancelAction extends BaseAction
{

    function can()
    {
        if ($this->task->getStatus() == Task::STATUS_NEW && $this->task->customerID == $this->user) {
            return true;
        }
        return false;
    }

    function getName()
    {
        return 'Отменить';
    }

    function getCode()
    {
        return 'cancel';
    }
}