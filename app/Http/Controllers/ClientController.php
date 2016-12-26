<?php

namespace pjLaravel\Http\Controllers;

use Illuminate\Http\Request;
use pjLaravel\Repositories\ClientRepository;
use pjLaravel\Services\ClientService;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    \Illuminate\Database\Eloquent\ModelNotFoundException,
    Illuminate\Database\QueryException,
    Exception;

class ClientController extends Controller
{   
    private $repository;
    private $service;
            
    /**
     * 
     * @param ClientRepository $repository
     * @param ClientService $service
     */
     
    public function __construct(ClientRepository $repository, ClientService $service) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return ['success'=>true, 'Cliente inserido com sucesso!'];
    }

    public function show($id)
    {
        try{
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Cliente inexistente'];
        } catch (NotFoundHttpException $e) {
            return ['error' => true, 'Cliente inexistente'];
        }
    }

    public function update(Request $request, $id)
    {
        try{
            return $this->service->update($request->all(), $id);
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Cliente inexistente'];
        } catch (NotFoundHttpException $e) {
            return ['error' => true, 'Url inexistente'];
        }
    }

    public function destroy($id)
    {
        try{
            $this->repository->find($id)->delete();
            return ['success'=>true, 'Cliente excluido com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Cliente inexistente'];
        } catch (NotFoundHttpException $e) {
            return ['error' => true, 'Url inexistente'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Cliente não pode ser apagado pois existe projeto vinculado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o cliente.'];
        }
        
    }
}
