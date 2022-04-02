<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AppointmentRepository implements CrudInterface
{
    /**
     * Authenticated User Instance.
     *
     * @var User
     */
    public User | null $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->user = Auth::guard()->user();
    }

    /**
     * Get All Clients.
     *
     * @return collections Array of Client Collection
     */
    public function getAll(): Paginator
    {
        return Appointment::orderBy('id', 'desc')
            ->paginate(8);
    }

    /**
     * Get Paginated Client Data.
     *
     * @param int $pageNo
     * @return collections Array of Client Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Appointment::orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get Searchable Client Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Client Collection
     */
    public function searchClient($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Appointment::where('nombre', 'like', '%' . $keyword . '%')
            ->orWhere('cedula', 'like', '%' . $keyword . '%')
            ->orWhere('fecha_nacimiento', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Create New Appointment.
     *
     * @param array $data
     * @return object Product Object
     */
    public function create(array $data): Appointment
    {
        $data['user_id'] = $this->user->id;
        return Appointment::create($data);
    }

    /**
     * Delete Appointment.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete($id): bool
    {
        $Appointment = Appointment::find($id);
        if (empty($Appointment)) {
            return false;
        }

        $Appointment->delete($Appointment);
        return true;
    }

    /**
     * Get Appointment Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID($id): Appointment|null
    {
        return Appointment::find($id);
    }

    /**
     * Get Appointment state By ID.
     *
     * @param int $id
     * @return void
     */
    public function getStateByID($id): bool
    {
        $Appointment = Appointment::find($id)->where('state_id', 1);
        if (empty($Appointment)) {
            return false;
        }
        return true;
    }

    /**
     * Update Appointment By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Appointment Object
     */
    public function update($id, array $data): Appointment|null
    {
        $Appointment = Appointment::find($id);
        // var_dump($Appointment->state_id);
        //   if ($Appointment->state_id == 1) {
        if (is_null($Appointment)) {
            return null;
        }

        // If everything is OK, then update.
        $Appointment->update($data);
        // } else {
        //    $no_aplica = null;
        //   return $no_aplica;
        // }
        // Finally return the updated Appointment.
        return $this->getByID($Appointment->id);
    }
}
