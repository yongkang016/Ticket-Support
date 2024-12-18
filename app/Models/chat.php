<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property User user
 */
class chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'description',
    ];

    protected $appends = [
        'user_name'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(TicketSupport::class);
    }

    /**
     * @return Attribute
     */
    protected function userName() : Attribute
    {
        return Attribute::make(get: fn() => $this->user->name);
    }
}
