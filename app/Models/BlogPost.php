<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    /**
     * Кктегория статьи.
     *
     * @return BelongsTo
     *
     */
    public function category()
    {
        // СТАТЬИ ПРИНАДЛЕЖАТ КАТЕГОРИИ
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     *  // Автор статьи.
     *
     * @return \Illuminate\\DataBase\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        // Статья принадлежит пользователю
        return $this->belongsTo(User::class);
    }

    /**
     * @inheritDoc
     */
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
