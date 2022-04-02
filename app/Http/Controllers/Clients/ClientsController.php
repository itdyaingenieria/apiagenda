<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;

use App\Repositories\ClientRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @OA\Info(
 *     description="LikeU API Documentation - Prueba CRUD Laravel",
 *     version="1.1.0",
 *     title="Prueba Tecnica CRUD Laravel API Documentation - Para LIKEU",
 *     @OA\Contact(
 *         email="diegoyamaa@gmail.com"
 *     ),
 *     @OA\License(
 *         name="GPL2",
 *         url="https://itdyaingenieria.com"
 *     )
 * )
 */

class ClientsController extends Controller
{
    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     * Client Repository class.
     *
     * @var ClientRepository
     */
    public $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->clientRepository = $clientRepository;
    }

    /**
     * @OA\GET(
     *     path="/api/clients",
     *     tags={"Clients"},
     *     summary="Get Client List",
     *     description="Get Client List as Array",
     *     operationId="index",
     *     @OA\Response(response=200,description="Get Client List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->clientRepository->getAll();
            return $this->responseSuccess($data, 'Client List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\GET(
     *     path="/api/clients/view/all",
     *     tags={"Clients"},
     *     summary="All Clients - Publicly Accessible",
     *     description="All Clients - Publicly Accessible",
     *     operationId="indexAll",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="All Clients - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function indexAll(Request $request): JsonResponse
    {
        try {
            $data = $this->clientRepository->getPaginatedData($request->perPage);
            return $this->responseSuccess($data, 'Client List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\GET(
     *     path="/api/clients/view/search",
     *     tags={"Clients"},
     *     summary="All Clients - Publicly Accessible",
     *     description="All Clients - Publicly Accessible",
     *     operationId="search",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="search", description="search, eg; Test", example="Test", in="query", @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="All Clients - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $data = $this->clientRepository->searchClient($request->search, $request->perPage);
            return $this->responseSuccess($data, 'Client List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\POST(
     *     path="/api/clients",
     *     tags={"Clients"},
     *     summary="Create New Client",
     *     description="Create New Client",
     *     operationId="store",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="nombre", type="string", example="Client Name 1"),
     *              @OA\Property(property="cedula", type="integer", example=27255425),
     *              @OA\Property(property="fecha_nacimiento", type="date", example="1979-10-31"),
     *              @OA\Property(property="user_id", type="integer", example=1),
     *          ),
     *      ),
     *      @OA\Response(response=200, description="Create New Client" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(ClientRequest $request): JsonResponse
    {
        try {
            $client = $this->clientRepository->create($request->all());
            return $this->responseSuccess($client, 'New Client Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\GET(
     *     path="/api/clients/{id}",
     *     tags={"Clients"},
     *     summary="Show Client Details",
     *     description="Show Client Details",
     *     operationId="show",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Client Details" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->clientRepository->getByID($id);
            if (is_null($data)) {
                return $this->responseError(null, 'Client Not Found', Response::HTTP_NOT_FOUND);
            }

            return $this->responseSuccess($data, 'Client Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\PUT(
     *     path="/api/clients/{id}",
     *     tags={"Clients"},
     *     summary="Update Client",
     *     description="Update Client",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="nombre", type="string", example="Client 1"),
     *              @OA\Property(property="cedula", type="integer", example=1085412541),
     *              @OA\Property(property="fecha_nacimiento", type="date", example="2022-12-24"),
     *              @OA\Property(property="user_id", type="integer", example=1),
     *          ),
     *      ),
     *     operationId="update",
     *     @OA\Response( response=200, description="Update Client" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(ClientRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->clientRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Client Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Client Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\DELETE(
     *     path="/api/clients/{id}",
     *     tags={"Clients"},
     *     summary="Delete Client",
     *     description="Delete Client",
     *     operationId="destroy",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response( response=200, description="Delete Client" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $client =  $this->clientRepository->getByID($id);
            if (empty($client)) {
                return $this->responseError(null, 'Client Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->clientRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the Client.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($client, 'Client Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
