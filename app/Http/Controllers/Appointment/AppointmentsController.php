<?php

namespace App\Http\Controllers\Appointment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;

use App\Repositories\AppointmentRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class AppointmentsController extends Controller
{
    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     * Appointment Repository class.
     *
     * @var AppointmentRepository
     */
    public $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * @OA\GET(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Get Appointment List",
     *     description="Get Appointment List as Array",
     *     @OA\Response(response=200,description="Get Appointment List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->appointmentRepository->getAll();
            return $this->responseSuccess($data, 'Appointment List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\POST(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Create New Appointment",
     *     description="Create New Appointment",
     *     operationId="store2",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="asunto", type="string", example="Desarrollo de Modulo 1"),
     *              @OA\Property(property="fecha_hora", type="string", example="2022-05-06 14:05:00"),
     *              @OA\Property(property="state_id", type="integer", example=1,description="1. Programada 2. Realizada 3. Cancelada 4. No Asistida"  ),
     *              @OA\Property(property="client_id", type="integer", example="1"),
     *          ),
     *      ),
     *      @OA\Response(response=200, description="Create New Appointment" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(AppointmentRequest $request): JsonResponse
    {
        try {
            $appointment = $this->appointmentRepository->create($request->all());
            return $this->responseSuccess($appointment, 'New Appointment Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\PUT(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Update Appointment",
     *     description="Update Appointment. Only can update appointment in state PROGRAMADA",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="asunto", type="string", example="Desarrollo de Modulo 1"),
     *              @OA\Property(property="fecha_hora", type="string", example="2022-05-06 14:05:00"),
     *              @OA\Property(property="state_id", type="integer", example=2,description="1. Programada 2. Realizada 3. Cancelada 4. No Asistida"  ),
     *              @OA\Property(property="client_id", type="integer", example="1"),
     *          ),
     *      ),
     *     operationId="update2",
     *     @OA\Response( response=200, description="Update Client" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(AppointmentRequest $request, $id): JsonResponse
    {
        try {
            $state_programada   = $this->appointmentRepository->getStateByID($id);
            //var_dump($state_programada);
            $appointment        = $this->appointmentRepository->update($id, $request->all());
           
            if ($state_programada)
            return $this->responseError(null, 'Change of State, Appointment Not Program, ', Response::HTTP_NOT_FOUND);
            
            if (is_null($appointment))
                return $this->responseError(null, 'Appointment Not Found', Response::HTTP_NOT_FOUND);
           

            return $this->responseSuccess($appointment, 'Appointment Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //Ing Diego Fernando Yamá Andrade
}
