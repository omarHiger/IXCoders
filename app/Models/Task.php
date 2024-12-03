<?php

namespace App\Models;

use App\ModelFilters\TaskFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static create(mixed $data)
 * @method static find(\App\Http\Controllers\string $id)
 * @method static paginate(mixed $param)
 * @method static filter(array $all)
 * @method static count()
 */
class Task extends Model
{
    use HasFactory , Filterable;
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    public function modelFilter(): ?string
    {
        return $this->provideFilter(TaskFilter::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
