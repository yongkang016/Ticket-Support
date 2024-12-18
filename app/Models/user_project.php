<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_project extends Model
{
    use HasFactory;

    // Fillable fields for mass-assignment
    protected $fillable = [
        'user_id',
        'project_id',
    ];


    public function project()
    {
        return $this->belongsTo(company_project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
