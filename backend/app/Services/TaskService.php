<?php
namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    protected TaskRepository $taskRepo;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function getAllTasks()
    {
        return $this->taskRepo->getAll();
    }

    public function getTasksByProjectId($projectId)
    {
        return $this->taskRepo->getByProjectId($projectId);
    }

    public function createTask(array $data)
    {
        return $this->taskRepo->create($data);
    }

    public function updateTask($id, array $data)
    {
        return $this->taskRepo->update($id, $data);
    }

    public function deleteTask($id)
    {
        return $this->taskRepo->delete($id);
    }
}
