<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class company_industry extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel's naming convention)
//    protected $table = 'company_industries';

    // Fillable fields for mass-assignment
    protected $fillable = [
        'name'// Replace with your actual database column names
    ];



    // CompanyIndustry model (or the corresponding model)
    public static function companyOptions($value = null): array
    {
        $query = self::all(); // Get all industries from the database

        $options = $query->map(function (company_industry $model) {
            return [
                'value' => $model->id, // Set the value as the industry ID
                'name' => $model->name, // Use the industry name for the option label
                'selected' => false, // Set a default for the selected state
            ];
        })->toArray();

        // Optionally, add an empty option
        $options[] = [
            'value' => null,
            'name' => 'Select Industry', // Placeholder text
            'selected' => false, // Set this option as selected by default
        ];

        // Set the selected option if $value matches an industry ID
        foreach ($options as $key => $option) {
            $options[$key]['selected'] = $option['value'] == $value;
        }

        return $options;
    }


    public function scopeFilter(Builder|\Illuminate\Database\Query\Builder $query, $filters)
    {
        if (isset($filters['name'])) {
            $query->whereLike('name', "%{$filters['name']}%");
        }

        return $query;
    }

    public function projectsUnderCompany(): HasMany
    {
        return $this->hasMany(company_project::class, 'company_id');
    }


}
