<?php

namespace pjLaravel\Services;

use pjLaravel\Repositories\ProjectTaskRepository;
use pjLaravel\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService {
    
    protected $repository;
    protected $validator;
    /**
     * 
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteValidator $validator
     */
    
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }
    
    public function create(array $data){  
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
              'error' => true,
               'message' => $e->getMessageBag()
            ];
        }  
    }
    
    public function update(array $data, $id){
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return [
              'error' => true,
               'message' => $e->getMessageBag()
            ];
        }
    }
    
}
