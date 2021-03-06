<?php

namespace pjLaravel\Services;

use pjLaravel\Repositories\ClientRepository;
use pjLaravel\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService {
    
    protected $repository;
    protected $validator;
    /**
     * 
     * @param ClientRepository $repository
     * @param ClientValidator $validator
     */
    
    public function __construct(ClientRepository $repository, ClientValidator $validator) {
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
