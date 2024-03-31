<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    /**
     * Get all of the task for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
