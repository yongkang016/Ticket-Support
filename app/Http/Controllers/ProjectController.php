<?php

namespace App\Http\Controllers;

use App\Constants\WebRouteName;
use App\Http\Requests\Project\ProjectDeleteRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Models\company_industry;
use App\Models\company_project;
use App\Models\user_project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projectIndex(Request $projectRequest)
    {
        $filters = $projectRequest->only('name');

        // Combine `filter` and `with` into a single query
        $data = company_project::with('company_relationship','project_staff')
            ->filter($filters)
            ->get();

        // Fetch all companies
        $companies = company_industry::all();


        return view('/pages/project.projectDashboard', [
            'data' => $data,
            'companies' => $companies,
        ]);
    }

    public function create()
    {
        return view('/pages/project.projectCreate', [
            'method' => 'POST',
            'model_company' => new company_project(),
            'action' => route(WebRouteName::WEB_ROUTE_PROJECT_STORE),
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        $projectService = app(ProjectService::class);
        $projectService->create($data);

        return redirect()->route(WebRouteName::WEB_ROUTE_PROJECT_INDEX)
            ->with('success', 'Project created successfully.');

    }

    public function update(ProjectUpdateRequest $request)
    {
        $data = $request->validated();

        $data['company_id'] = $data['companySelection'];

        /** @var ProjectService $projectService */
        $projectService = app(ProjectService::class);

        $project_id = \App\Models\company_project::findOrFail($data['id']);

        // Call a service to handle the update logic
        $result = $projectService->update($project_id,$data);

        if ($result) {
            return redirect()->route(WebRouteName::WEB_ROUTE_PROJECT_INDEX)->with('success', 'Project updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update project.');
        }

    }

    public function delete(ProjectDeleteRequest $request)
    {

        // Validate the incoming request data
        $data = $request->validated();


        /** @var ProjectService $projectService */
        $projectService = app(ProjectService::class);

        // Find the user to be deleted
        $project = \App\Models\company_project::findOrFail($data['id']);

        // Call the service to delete the user
        $result = $projectService->delete($project);

        if ($result) {
            return redirect()->route(WebRouteName::WEB_ROUTE_PROJECT_INDEX)
                ->with('success', 'Project deleted successfully.');
        } else {
            return redirect()->back()
                ->withErrors([
                    'custom_errors' =>
                        'Failed to delete the project. The project has associated ticket.'
                    //Key => value
                ]);
        }
    }
}
