<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


class company_project extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel's naming convention)
//    protected $table = 'company_project';

    // Fillable fields for mass-assignment
    protected $fillable = [
        'name',// Replace with your actual database column names
        'description',// Replace with your actual database column names
        'company_id'// Replace with your actual database column names
    ];

    public function company_relationship()
    {
        return $this->belongsTo(company_industry::class, 'company_id');
    }

    public function company_staff()
    {
        return $this->belongsTo(company_industry::class, 'company_id');
    }

    public function project_staff()
    {
        return $this->belongsTo(user_project::class, 'id','project_id');
    }

    public function staff_user()
    {
        return $this->hasOneThrough(
            User::class,             // Final model (User)
            user_project::class,     // Intermediate model (user_project)
            'project_id',            // Foreign key on user_project (matches id on this model)
            'id',                    // Foreign key on User table
            'id',                    // Local key on this model
            'user_id'                // Local key on user_project
        );
    }

    public function projectsUnderTicket(): HasMany
    {
        return $this->hasMany(TicketSupport::class,'project_id', 'id');
    }


    public static function projectOptions($value = null): array
    {
        $query = self::all(); // Get all industries from the database

        $options = $query->map(function (company_project $model) {
            return [
                'value' => $model->id, // Set the value as the industry ID
                'name' => $model->name, // Use the industry name for the option label
                'selected' => false, // Set a default for the selected state
            ];
        })->toArray();

        // Optionally, add an empty option
        $options[] = [
            'value' => null,
            'name' => 'Select Project', // Placeholder text
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



}
