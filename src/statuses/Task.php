<?php

namespace taskForce\statuses;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_IN_PROGRESS = 'inProgress';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';
    const CANCEL = 'cancel';
    const TAKE = 'take';
    const ACCEPT = 'accept';
    const REJECT = 'reject';

    protected $currentStatus;
    public $statusMap = [];
    public $actionMap = [];
    public $workerID;
    private $customerID;

    public function __construct($customerID, $workerID = null)
    {
        $this->customerID = $customerID;
        $this->workerID = $workerID;
        $this->statusMap = [
            self::STATUS_NEW => 'Новое',
            self::STATUS_CANCELLED => 'Отменено',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_FAILED => 'Провалено'
        ];
        $this->actionMap = [
            self::CANCEL => 'Отменить',
            self::TAKE => 'Откликнуться',
            self::ACCEPT => 'Выполнено',
            self::REJECT => 'Отказаться'
        ];
        $this->currentStatus = self::STATUS_NEW;
    }


    public function getStatus()
    {
        return $this->currentStatus;
    }

    public function getNextStatus($action)
    {
        switch ($action) {
            case self::CANCEL :
            {
                return self::STATUS_CANCELLED;
            }
            case self::TAKE :
            {
                return self::STATUS_IN_PROGRESS;
            }
            case self::ACCEPT :
            {
                return self::STATUS_DONE;
            }
            case self::REJECT :
            {
                return self::STATUS_FAILED;
            }
        }
        return null;
    }

    public function getWorkerAction()
    {
        switch ($this->currentStatus) {
            case self::STATUS_NEW :
            {
                return self::TAKE;
            }
            case self::STATUS_IN_PROGRESS :
            {
                return self::REJECT;
            }
        }
        return null;
    }

    public function getCustomerAction()
    {
        switch ($this->currentStatus) {
            case self::STATUS_NEW :
            {
                return self::CANCEL;
            }
            case self::STATUS_IN_PROGRESS :
            {
                return self::ACCEPT;
            }

        }
        return null;
    }
}