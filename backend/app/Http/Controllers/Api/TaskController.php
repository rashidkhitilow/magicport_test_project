<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index($projectId)
    {
        return $this->taskService->getTasksByProjectId($projectId);
    }

    public function store(Request $request)
    {
        return $this->taskService->createTask($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->taskService->updateTask($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->taskService->deleteTask($id);
    }
}
