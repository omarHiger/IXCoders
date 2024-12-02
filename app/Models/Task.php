<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static creat(mixed $data)
 */
class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
