<?php

namespace pjLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date'
    ];
    
        
    public function note(){
        return $this->hasMany(ProjectNote::class);
    }
    
    public function task(){
        return $this->hasMany(ProjectTask::class);
    }
    
    public function files(){
        return $this->hasMany(ProjectFile::class);
    }
    
    public function users() {
    	return $this->belongsTo(User::class);
    }
    
    public function members(){
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id');
    }

}

