<?php

namespace pjLaravel\Services;

use pjLaravel\Repositories\ProjectRepository;
use pjLaravel\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectService {
    
    protected $repository;
    protected $validator;
    protected $filesystem;
    protected $storage;
    /**
     * 
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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
    
    public function addMember($project_id, $member_id){
        $project = $this->repository->find($project_id);
        if(!$this->isMember($project_id, $member_id)){
            $project->members()->attach($member_id);
        }
        return $project->members()->get();
    }
    
      public function removeMember($project_id, $member_id)
  {
        try {
            return $this->service->removeMember($project_id, $member_id);
        } catch (ModelNotFoundException $e) {
            return $this->erroMsgm('Projeto não encontrado.');
        } catch (QueryException $e) {
            return $this->erroMsgm('Cliente não encontrado.');
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao remover o membro.');
        }
    }
    
    public function isMember($project_id, $member_id){
        
        if(count($this->repository->find($project_id)->members()->find(['member_id' => $member_id]))){
            return true;
        }

        return false;
    }
    
    public function createFile(array $data){
        $project = $this->repository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);
        
        $this->storage->put($projectFile->id . "." . $data['extension'], $this->filesystem->get($data['file']));
    }
    
}