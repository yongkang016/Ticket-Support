<?php

namespace App\Services;

use App\Models\company_industry;

class CompanyService
{
    public function create(array $data): company_industry
    {
        return company_industry::create($data);
    }

    public function update(company_industry $company, array $data): bool
    {
        return $company->update($data);
    }

    public function delete(company_industry $company): bool
    {
        if ($company->projectsUnderCompany()->exists()) {
            return false;
        }
        return $company->delete();
    }
}
