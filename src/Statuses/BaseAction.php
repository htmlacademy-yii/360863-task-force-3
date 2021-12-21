<?php

namespace App\Statuses;
use App\Task;

abstract class BaseAction
{
    public function __construct(protected Task $task, protected $user)
    {
    }

    abstract function can();
    abstract function getName();
    abstract function getCode();
}