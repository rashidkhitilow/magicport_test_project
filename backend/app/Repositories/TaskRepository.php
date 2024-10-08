<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function getAll()
    {
        return Task::all();
    }

    public function getByProjectId($projectId)
    {
        return Task::where('project_id', $projectId)->get();
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
        Task::destroy($id);
    }
}
