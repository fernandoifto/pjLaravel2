<?php

namespace pjLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectTask extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'project_id',
        'name',
        'project_id ',
        'start_date',
        'due_date',
        'status',
    ];
    
    public function project(){
        return $this->belongsTo(Project::class);
    }

}