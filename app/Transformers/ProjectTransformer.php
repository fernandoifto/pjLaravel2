<?php

namespace pjLaravel\Transformers;

use pjLaravel\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract {
    
    protected $defaultIncludes = ['members'];


    public function transform(Project $project){
        return [
            'project_id' => $project->id,
            'client_id' => $project->client_id,
            'owner_id' => $project->owner_id,
            'projeto' => $project->name,
            'descricao' => $project->description,
            'progresso' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
        ];
    }
    
    public function includeMembers(Project $project){
        return $this->collection($project->members, new ProjectMemberTransformer());
    }
    
}
