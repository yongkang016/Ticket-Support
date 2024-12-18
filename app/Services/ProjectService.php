<?php

namespace App\Services;

use App\Models\company_project;
use App\Models\User;
use App\Models\user_project;

class ProjectService
{
    public function create(array $data): company_project
    {
        // Create the project in the company_projects table
        $project = company_project::create($data);

        // Create the user-project assignment in user_projects table
        $userProjectData = [
            'user_id' => $data['role'], // Ensure user_id is in the data passed
            'project_id' => $project->id,
        ];

        // Assign user to the created project
        $this->assignUserToProject($userProjectData);


        // Find the user and update their company_id
        //        $this->updateUserCompanyId($data['role'], $data['company_id']);

        return $project;  // Returning the created project

//        return company_project::create($data);
    }

    public function assignUserToProject(array $data): user_project
    {
        // This method will assign the user to the project with a role
        return user_project::create($data);
    }

//    public function updateUserCompanyId(int $userId, int $companyId): void
//    {
//
//        // Find the user by ID and update the company_id
//        $user = User::find($userId);
//        dd($userId,$companyId,$user);
////        dd($userId,$companyId);
//        if ($user) {
//            $user->update(['company_id' => $companyId]);
//            $user->save();
//        }
//    }

    public function update(company_project $project, array $data): bool
    {
        return $project->update($data);
    }

    public function delete(company_project $project): bool
    {
        if ($project->projectsUnderTicket()->exists()) {
            return false;
        }

        return $project->delete();
    }
}
