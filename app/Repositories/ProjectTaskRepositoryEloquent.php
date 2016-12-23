<?php

namespace pjLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use pjLaravel\Repositories\ProjectTaskRepository;
use pjLaravel\Entities\ProjectTask;
use pjLaravel\Validators\ProjectTaskValidator;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace pjLaravel\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectTask::class;
    }

    public function validator()
    {

        return ProjectTaskValidator::class;
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
