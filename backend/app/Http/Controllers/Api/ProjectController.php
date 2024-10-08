<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        return $this->projectService->getAllProjects();
    }

    public function store(Request $request)
    {
        return $this->projectService->createProject($request->all());
    }

    public function show($id)
    {
        return $this->projectService->getProjectById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->projectService->updateProject($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->projectService->deleteProject($id);
    }
}
