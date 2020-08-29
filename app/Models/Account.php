<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $login
 * @property string $password
 * @property int $service_id
 * @property string $salt
 * @property Service $service
 * @property User $user
 */

class Account extends Model
{

    protected $fillable = ['login', 'password', 'salt', 'service_id', 'user_id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
