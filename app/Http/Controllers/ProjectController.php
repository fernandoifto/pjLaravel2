<?php

namespace pjLaravel\Http\Controllers;

use Illuminate\Http\Request;
use pjLaravel\Repositories\ProjectRepository;
use pjLaravel\Services\ProjectService;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    \Illuminate\Database\Eloquent\ModelNotFoundException,
    Illuminate\Database\QueryException,
    Exception;

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

    public function index() {
            return $this->repository->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
    }

    public function store(Request $request) {
        $this->service->create($request->all());
        return ['success'=>true, 'Projeto inserido com sucesso!'];
    }

    public function show($id) {
        try {
            if ($this->checkProjectPermissions($id) == false) {
                return ['error' => 'Acesso negado'];
            }
            return $this->repository->find($id);
        }catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto inexistente'];
        } catch (NotFoundHttpException $e) {
            return ['error' => true, 'Url inexistente'];
        }
    }

    public function update(Request $request, $id) {

        try {
            if ($this->checkProjectOwner($id) == false) {
                return ['error' => 'Acesso negado'];
            }
            $this->service->update($request->all(), $id);
            return ['success'=>true, 'Projeto alterado com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto inexistente'];
        } catch (NotFoundHttpException $e) {
            return ['error' => true, 'Url inexistente'];
        }
    }
    public function destroy($id) {
        try{
            if ($this->checkProjectOwner($id) == false) {
                return ['error' => 'Acesso negado'];
            }
            $this->repository->find($id)->delete();
            return ['success'=>true, 'Projeto excluido com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto inexistente'];
        } catch (NotFoundHttpException $e) {
            return ['error' => true, 'Url inexistente'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o projeto.'];
        }
    }
    
      public function members($id){
        try {

            $members = $this->repository->find($id)->members()->get();

            if (count($members)) {
                return $members;
            }
            return ['error'=>true, 'Projeto não tem membros.'];

        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto inexistente.'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Ocorreu algum erro.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao mostrar os membros.'];
        }

    }
    
    public function addMember($project_id, $member_id){
        try {
            return $this->service->addMember($project_id, $member_id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto inexistente.'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Ocorreu algum erro.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao inserir.'];
        }
    }

    public function removeMember($project_id, $member_id){
        try {
            return $this->service->removeMember($project_id, $member_id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto inexistente.'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Ocorreu algum erro.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao deletar.'];
        }
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
