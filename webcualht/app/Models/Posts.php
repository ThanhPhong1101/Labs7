<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    public $incrementing = true;

    public static function find(mixed $userID)
    {
    }

    /**
     * Relationship
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
