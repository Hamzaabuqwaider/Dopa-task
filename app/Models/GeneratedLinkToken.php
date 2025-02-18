<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Generated Link Token
 * @property int $id
 * @property string|null $token
 * @property boolean $used
 * @property Carbon|null $created_at
 * @property Carbon|null $expires_at
 * @property Carbon|null $updated_at
 */


class GeneratedLinkToken extends Model
{
    protected $table = 'generated_link_token';
    protected $guarded = [];

    const ID = 'id';
    const USED = 'used';
    const TOKEN = 'token';
    const EXPIRES_AT = 'expires_at';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $casts = [
        self::EXPIRES_AT => 'datetime',
        self::CREATED_AT => 'date',
        self::UPDATED_AT => 'date',
        self::USED => 'bool',
    ];

    // Mutator to format expires_at
    public function getExpiresAtAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
