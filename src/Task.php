<?php

namespace App;

use App\Statuses\AcceptAction;
use App\Statuses\BaseAction;
use App\Statuses\CancelAction;
use App\Statuses\RejectAction;
use App\Statuses\TakeAction;

class Task
{

    //статусы
    const STATUS_NEW = 'new';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_IN_PROGRESS = 'inProgress';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';


    protected $currentStatus;
    public $statusMap = [];
    public $workerID;
    public $customerID;
    public $actions = [];

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

        $this->currentStatus = self::STATUS_IN_PROGRESS;

        $authUserId = 6;
        $this->actions = [
            new CancelAction($this, $authUserId),
            new TakeAction($this, $authUserId),
            new RejectAction($this, $authUserId),
            new AcceptAction($this, $authUserId),
        ];
    }

    public function getAvailableAction(){


        return current(array_filter($this->actions, function(BaseAction $action){
            return $action->can();
        }));

    }

    public function getStatus()
    {
        return $this->currentStatus;
    }


//переделать исходя из новых
    public function getNextStatus(BaseAction $action)
    {

            switch ($action) {
                case is_a($action, CancelAction::class):
                {
                    return self::STATUS_CANCELLED;
                }
                case is_a($action, TakeAction::class) :
                {
                    return self::STATUS_IN_PROGRESS;
                }
                case is_a($action, AcceptAction::class) :
                {
                    return self::STATUS_DONE;
                }
                case is_a($action, RejectAction::class) :
                {
                    return self::STATUS_FAILED;
                }
            }

       return null;
    }

}