<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permit
 * @package App
 *
 * @property User $user
 */
class Permit extends Model
{
    protected $fillable = [
        'user_id',
        'visit'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
