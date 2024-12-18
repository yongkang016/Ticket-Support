<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property string name
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function staffOptions($value = null): array
    {
        $query = self::where('role', '4')->get();

        $options = $query->map(function (User $model) {
            return [
                'value' => $model->id, // Set the value as the industry ID
                'name' => $model->name, // Use the industry name for the option label
                'selected' => false, // Set a default for the selected state
            ];
        })->toArray();

        $options[] = [
            'value' => null,
            'name' => 'Select Staff', // Placeholder text
            'selected' => true, // Set this option as selected by default
        ];

        // Set the selected option if $value matches an industry ID
        foreach ($options as $key => $option) {
            $options[$key]['selected'] = $option['value'] == $value;
        }

        return $options;
    }


    /**
     * @param Builder|\Illuminate\Database\Query\Builder $query
     * @param $filters
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeFilter(Builder|\Illuminate\Database\Query\Builder $query, $filters)
    {
        if (isset($filters['name'])) {
            $query->whereLike('name', "%{$filters['name']}%");
        }

        if (!empty($filters['role'])) {
            $query->where('role', $filters['role']); // Exact match for roles
        }


        return $query;
    }


    public static function roleOptions($value = null): array
    {
        // Assuming 'id' refers to the user's role id and 'role' refers to the role name
        $roleMapping = Role::selection(true);

        // Map the roles and their ids
        $options = collect($roleMapping)->map(function ($name, $key) {
            return [
                'value' => $key, // Set the value as the user ID (or role ID if needed)
                'name' => $name, // Use the role name from the mapping
                'selected' => false, // Default selected state
            ];
        })->toArray();

        // Add the default "Select Role" option
        $options[] = [
            'value' => null,
            'name' => 'Select Role', // Placeholder text
            'selected' => $value === null, // If no value is passed, select this option
        ];

        // Set the selected option based on the provided $value
        foreach ($options as $key => $option) {
            if ($option['value'] == $value) {
                $options[$key]['selected'] = true; // Mark this option as selected
            }
        }

        return $options;
    }

    public function projectsUnderStaff(): HasMany
    {
        return $this->hasMany(user_project::class, 'user_id');
    }

    public function projectsSubmittedByClient(): HasMany
    {
        return $this->hasMany(TicketSupport::class, 'created_by');
    }

//    public static function roleOptions($value = null): array
//    {
//        // Assuming 'id' refers to the user's role id and 'role' refers to the role name
//        $roleMapping = [
//            1 => 'Super Admin',
//            2 => 'Admin',
//            3 => 'Client',
//            4 => 'Support Staff'
//        ];
//
//        // If you want to use a list of users for role options, you can fetch them like this:
////        $query = self::all();
//
//        // Map the roles and their ids
//        $options = $query->map(function (User $model) use ($roleMapping) {
//            return [
//                'value' => $model->id, // Set the value as the user ID (or role ID if needed)
//                'name' => $roleMapping[$model->role] ?? 'Unknown', // Use the role name from the mapping
//                'selected' => false, // Default selected state
//            ];
//        })->toArray();
//
//        // Add the default "Select Role" option
//        $options[] = [
//            'value' => null,
//            'name' => 'Select Role', // Placeholder text
//            'selected' => $value === null, // If no value is passed, select this option
//        ];
//
//        // Set the selected option based on the provided $value
//        foreach ($options as $key => $option) {
//            if ($option['value'] == $value) {
//                $options[$key]['selected'] = true; // Mark this option as selected
//            }
//        }
//
//        return $options;
//    }


}
