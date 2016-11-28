<?php

namespace pjLaravel\Repositories;
use Prettus\Repository\Eloquent\BaseRepository;
use pjLaravel\Entities\Client;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository{
    
    public function model() {
        return Client::class;
    }
    
}
