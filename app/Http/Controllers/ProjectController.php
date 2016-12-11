<?php

namespace pjLaravel\Http\Controllers;

use Illuminate\Http\Request;
use pjLaravel\Repositories\ProjectRepository;
use pjLaravel\Services\ProjectService;

class ProjectController extends Controller {

    private $repository;
    private $service;

    /**
     * 
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
    public function __construct(ProjectRepository $repository, ProjectService $service) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //return Project::all();

        return $this->repository->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return $this->service->create($request->all());
        //return $this->repository->create($request->all());
        //return Project::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if ($this->checkProjectPermissions($id) == false) {
            return ['error' => 'Acess Forbidden'];
        }
        return $this->repository->find($id);
        //return Project::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        /* $client = Project::find($id);
          $client->update($request->all(),$id);
          return $client; */
        //return $this->repository->update($request->all(), $id);
        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Acess Forbidden'];
        }
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //Project::find($id)->delete();
        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Acess Forbidden'];
        }
        $this->repository->find($id)->delete();
    }

    private function checkProjectOwner($projectId) {

        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId) {

        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectId) {

        if ($this->checkProjectMember($projectId) || $this->checkProjectOwner($projectId)) {
            return true;
        }
        return false;
    }

}
