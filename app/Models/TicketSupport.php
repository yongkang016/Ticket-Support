<?php

namespace App\Models;

use App\Constants\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',// Replace with your actual database column names
        'description',
        'status',
        'priority',
        'created_by',
        'project_id'
    ];


    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function projectName()
    {
        return $this->belongsTo(company_project::class, 'project_id', 'id');
    }

    public function staffProject()
    {
        return $this->belongsTo(user_project::class, 'project_id', 'project_id');

    }

    public function scopeFilter(Builder|\Illuminate\Database\Query\Builder $query, $filters)
    {
        if (isset($filters['title'])) {
            $query->whereLike('title', "%{$filters['title']}%");
        }

        // Filter by status
        if (isset($filters['status']) && !empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['priority']) && !empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (isset($filters['project_name']) && !empty($filters['project_name'])) {
            $query->whereHas('projectName', function ($query) use ($filters) {
                $query->whereLike('name', "%{$filters['project_name']}%");
            });
        }

        return $query;
    }


    public static function statusOptions($value = null): array
    {
        // Hardcoded status mapping
        $statusMapping = [
            1 => 'Open',
            2 => 'In Progress',
            3 => 'Resolved',
            4 => 'Closed',
        ];

        // Map the hardcoded statuses
        $options = collect($statusMapping)->map(function ($name, $key) {
            return [
                'value' => $key, // Status ID
                'name' => $name, // Status Name
                'selected' => false, // Default selected state
            ];
        })->values()->toArray(); // Ensure indexed array

        // Add the default "Select Status" option
        array_unshift($options, [
            'value' => null,
            'name' => 'Select Status', // Placeholder text
            'selected' => $value === null, // If no value is passed, select this option
        ]);

        // Set the selected option based on the provided $value
        foreach ($options as &$option) {
            if ($option['value'] == $value) {
                $option['selected'] = true; // Mark this option as selected
            }
        }

        return $options;
    }

    public static function priorityOptions($value = null): array
    {
        // Hardcoded status mapping
        $priorityMapping = [
            0 => 'Pending',
            1 => 'Low',
            2 => 'Medium',
            3 => 'High',
            4 => 'Critical',
        ];

        // Map the hardcoded statuses
        $options = collect($priorityMapping)->map(function ($name, $key) {
            return [
                'value' => $key, // priority ID
                'name' => $name, // priority Name
                'selected' => false, // Default selected state
            ];
        })->values()->toArray(); // Ensure indexed array

        // Add the default "Select Status" option
        array_unshift($options, [
            'value' => null,
            'name' => 'Select Status', // Placeholder text
            'selected' => $value === null, // If no value is passed, select this option
        ]);

        // Set the selected option based on the provided $value
        foreach ($options as &$option) {
            if ($option['value'] == $value) {
                $option['selected'] = true; // Mark this option as selected
            }
        }

        return $options;
    }
}
