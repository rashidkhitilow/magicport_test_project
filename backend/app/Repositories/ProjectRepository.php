<?php
namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Project::with('tasks')->get();
    }

    public function getById($id)
    {
        return Project::with('tasks')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update($id, array $data)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        Project::destroy($id);
    }
}
