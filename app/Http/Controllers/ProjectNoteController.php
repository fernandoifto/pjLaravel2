<?php

namespace pjLaravel\Http\Controllers;

use Illuminate\Http\Request;
use pjLaravel\Repositories\ProjectNoteRepository;
use pjLaravel\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{   
    private $repository;
    private $service;
            
    /**
     * 
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteService $service
     */
     
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service) {
        $this->repository = $repository;
        $this->service = $service;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //return ProjectNote::all();
        return $this->repository->findWhere(['project_id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
        //return $this->repository->create($request->all());
        //return ProjectNote::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $noteId)
    {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
        //return ProjectNote::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $noteId)
    {
        /*$client = ProjectNote::find($id);
        $client->update($request->all(),$id);
        return $client;*/
        //return $this->repository->update($request->all(), $id);
        return $this->service->update($request->all(), $noteId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        //ProjectNote::find($id)->delete();
        $this->repository->find($noteId)->delete();
    }
}
