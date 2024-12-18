<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Permission
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Permission extends \Spatie\Permission\Models\Permission implements Auditable
{
    use HasFactory,
        \OwenIt\Auditing\Auditable;
}
