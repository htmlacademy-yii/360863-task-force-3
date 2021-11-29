<?php

require_once "vendor/autoload.php";

$task = new Task(3);
if($task->getNextStatus('cancel') === Task::STATUS_CANCELLED){echo 'Проверка 1 удалась' . '<br>';}

echo $task->getStatus() . '<br>';
echo $task->getWorkerAction() . '<br>';
echo $task->getCustomerAction() . '<br>';
