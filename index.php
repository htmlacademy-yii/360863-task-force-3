<?php

require_once "vendor/autoload.php";
use App\Task;

$task = new Task(6, 5);
/*if($task->getNextStatus('cancel') === Task::STATUS_CANCELLED){echo 'Проверка 1 удалась' . '<br>';}
echo $task->getStatus() . '<br>';
echo $task->getWorkerAction() . '<br>';
echo $task->getCustomerAction() . '<br>';*/

/*$action = new \App\Statuses\AcceptAction($task, 3);

if($action->can()){
    echo 'действие доступно';
} else {
    echo 'действие не доступно';
}*/

#var_dump($task->getAvailableAction()->getCode());
$actions = $task->getAvailableAction();

var_dump($task->getNextStatus($actions));

d