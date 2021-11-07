<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = $this->setQuery(Project::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Project/Index', [
            'projects' => ProjectResource::collection($projects->paginate(request()->perpage ?? 100)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Project/Create', [
            'project' => new Project(),
        ]);
    }

    public function store(Request $request)
    {
        $project = Project::create($this->validateData($request));

        return redirect()
            ->route('projects.show', $project->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Project $project)
    {
        ProjectResource::withoutWrapping();
        
        return Inertia::render('Project/Show', [
            'project' => new ProjectResource($project),
        ]);
    }

    public function edit(Project $project)
    {
        return Inertia::render('Project/Edit', [
            'project' => $project,
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $project->update($this->validateData($request, $project->id));

        return redirect()
            ->route('projects.show', $project->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('status', 'The record has been delete successfully.');
    }

    protected function search()
    {
        $this->getQuery()
            ->when(request()->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', 'regexp', $search)
                        ->orWhere('name', 'regexp', $search)
                        ->orWhere('nikname', 'regexp', $search);
                });
            });

        return $this;
    }

    protected function filter()
    {
        $this->getQuery();

        return $this;
    }

    protected function getFilterProperty()
    {
        return [
            //
        ];
    }

    private function validateData($request, $id = '')
    {
        return $request->validate([
            'name' => [
                'required',
                'string',
            ],
            'nikname' => [
                'required',
                'string',
            ],
            'active' => [
                'required',
                'boolean',
            ]
        ]);
    }

}
