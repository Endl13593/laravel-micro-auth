<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function users(): BelongsToMany
    {
        return$this->belongsToMany(User::class);
    }
}
