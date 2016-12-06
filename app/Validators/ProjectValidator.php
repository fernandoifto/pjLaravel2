<?php

namespace pjLaravel\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator{
    
    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required',
        'description' => 'required',
        'progress' => 'required|integer',
        'status' => 'required|integer',
        'due_date' => 'required|date'
    ];
    
}
