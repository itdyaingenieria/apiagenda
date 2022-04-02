<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ClientRepository implements CrudInterface
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
        return Client::orderBy('id', 'desc')
            ->paginate(7);
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
        return Client::orderBy('id', 'desc')
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

        return Client::where('nombre', 'like', '%' . $keyword . '%')
            ->orWhere('cedula', 'like', '%' . $keyword . '%')
            ->orWhere('fecha_nacimiento', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Create New Client.
     *
     * @param array $data
     * @return object Client Object
     */
    public function create(array $data): Client
    {
        $data['user_id'] = $this->user->id;

        return Client::create($data);
    }

    /**
     * Delete Client.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete($id): bool
    {
        $client = Client::find($id);
        if (empty($client)) {
            return false;
        }

        $client->delete($client);
        return true;
    }

    /**
     * Get Client Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID($id): Client|null
    {
        return Client::find($id);
    }

    /**
     * Update Client By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Client Object
     */
    public function update($id, array $data): Client|null
    {
        $client = Client::find($id);
   
        if (is_null($client)) {
            return null;
        }

        // If everything is OK, then update.
        $client->update($data);

        // Finally return the updated client.
        return $this->getByID($client->id);
    }
}
