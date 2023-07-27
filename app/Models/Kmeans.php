<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kmeans extends Model
{
    use HasFactory;

    protected $fillable = ['stunting_id', 'cluster_id'];
}
