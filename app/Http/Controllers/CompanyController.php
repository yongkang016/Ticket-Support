<?php

namespace App\Http\Controllers;

use App\Constants\WebRouteName;
use App\Http\Requests\Company\CompanyDeleteRequest;
use App\Http\Requests\Company\CompanyRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\company;
use App\Models\company_industry;
use App\Models\company_project;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function companyIndex(Request $companyRequest)
    {

        $filters = $companyRequest->only('name');
//        $data = company_industry::all();
        $data = company_industry::query()->filter($filters)->get();

        // Return the login view
        return view('/pages/company.companyDashboard', [
            'data' => $data,
        ]);


    }

    public function create()
    {
        return view('/pages/company.companyCreate', [
            'method' => 'POST',
            'model' => new company_industry(),
            'action' => route(WebRouteName::WEB_ROUTE_COMPANY_STORE),
        ]);
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        $companyService = app(CompanyService::class);
        $companyService->create($data);

        return redirect()->route(WebRouteName::WEB_ROUTE_COMPANY_INDEX)
            ->with('success', 'Company created successfully.');
    }

    public function update(CompanyUpdateRequest $request)
    {
        $data = $request->validated();

        /** @var CompanyService $companyService */
        $companyService = app(CompanyService::class);

        $company_id = \App\Models\company_industry::findOrFail($data['id']);

        // Call a service to handle the update logic
        $result = $companyService->update($company_id,$data);

        if ($result) {
            return redirect()->route(WebRouteName::WEB_ROUTE_COMPANY_INDEX)->with('success', 'Ticket updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update ticket.');
        }
    }

    public function delete(CompanyDeleteRequest $request)
    {
        // Validate the incoming request data
        $data = $request->validated();

        /** @var CompanyService $companyService */
        $companyService = app(CompanyService::class);

        // Find the user to be deleted
        $company = \App\Models\company_industry::findOrFail($data['id']);

        // Call the service to delete the user
        $result = $companyService->delete($company);

        if ($result) {
            return redirect()->route(WebRouteName::WEB_ROUTE_COMPANY_INDEX)
                ->with('success', 'Company deleted successfully.');
        } else {
            return redirect()->back()
                ->withErrors([
                    'custom_errors' =>
                        'Failed to delete the company. The company has associated projects/ticket.'
                    //Key => value
                ]);
        }
    }



}
