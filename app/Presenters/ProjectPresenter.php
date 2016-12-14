<?php

namespace pjLaravel\Presenters;
use Prettus\Repository\Presenter\FractalPresenter;
use pjLaravel\Transformers\ProjectTransformer; 

class ProjectPresenter extends FractalPresenter{
    
    public function getTransformer() {
        return new ProjectTransformer();
    }
    
}
