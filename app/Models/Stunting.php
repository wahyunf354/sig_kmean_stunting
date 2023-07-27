<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stunting extends Model
{
    use HasFactory;

    public function cluster(): BelongsToMany
    {
        return $this->belongsToMany(Cluster::class, 'kmeans');
    }
}
