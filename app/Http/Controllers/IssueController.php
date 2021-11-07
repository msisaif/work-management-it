<?php

namespace App\Http\Controllers;

use App\Http\Resources\IssueResource;
use App\Models\Issue;
use App\Models\Project;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IssueController extends Controller
{
    use DateFilter;

    public function index()
    {
        $issues = $this->setQuery(Issue::query())
            ->search()->filter()
            ->dateFilter()
            ->getQuery()
            ->with([
                'project:id,name,nikname',
                'user:id,name'
            ]);

        return Inertia::render('Issue/Index', [
            'issues' => IssueResource::collection($issues->paginate(request()->perpage ?? 100)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Issue/Create', [
            'issue' => new Issue(),
            'projects' => Project::active()->get(),
            'workTypes' => Issue::getWorkType(),
        ]);
    }

    public function store(Request $request)
    {
        $issue = Issue::create($this->validateData($request) + [
            'user_id' => Auth::id()
        ]);

        return redirect()
            ->route('issues.show', $issue->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Issue $issue)
    {
        IssueResource::withoutWrapping();

        return Inertia::render('Issue/Show', [
            'issue' => new IssueResource($issue),
        ]);
    }

    public function edit(Issue $issue)
    {
        return Inertia::render('Issue/Edit', [
            'issue' => $issue,
            'projects' => Project::active()->get(),
            'workTypes' => Issue::getWorkType(),
        ]);
    }

    public function update(Request $request, Issue $issue)
    {
        $issue->update($this->validateData($request, $issue->id));

        return redirect()
            ->route('issues.show', $issue->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();

        return redirect()
            ->route('issues.index')
            ->with('status', 'The record has been delete successfully.');
    }

    protected function search()
    {
        $this->getQuery()
            ->when(request()->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', 'regexp', $search);
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
            'project_id' => [
                'required',
                'numeric',
            ],
            'type' => [
                'required',
                'numeric',
            ],
            'title' => [
                'required',
                'string'
            ],
            'body' => [
                ''
            ],
            'active' => [
                'required',
                'boolean'
            ]
        ]);
    }

}
