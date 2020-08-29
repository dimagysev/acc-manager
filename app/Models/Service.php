<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Service
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $salt
 * @property int $user_id
 * @property User $user
 * @property Collection $accounts
 */

class Service extends Model
{
    protected $fillable = ['name', 'salt'];

    protected $withCount = ['accounts'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Account::class);
    }
}
