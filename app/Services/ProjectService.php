<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    protected $taskRepository;

    public function __construct(ProjectRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
}