<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\User;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * Check if public profile api is accessible or not.
     *
     * @return void
     */
    public function test_can_access_public_client_api()
    {
        $response = $this->get('/api/clients/view/all');

        $response->assertStatus(200);
    }

    /**
     * Check if client list is private. only user can see his products.
     *
     * @return void
     */
    public function test_can_not_access_private_client_api()
    {
        $response = $this->get('/api/clients');

        $response->assertStatus(401);
    }

    /**
     * Test if client is creatable.
     *
     * @return void
     */
    public function test_can_create_client()
    {
        // Login the user first.
        Auth::login(User::where('email', 'admin@itdyaingenieria.com')->first());
        $clientRepository = new ClientRepository();

        // First count total number of products
        $totalClients = Client::get('id')->count();

        $client = $clientRepository->create([
            'nombre'            => 'Test Create Client DFYA',
            'cedula'            => 87100445,
            'fecha_nacimiento'  => '1979-05-17',
            'user_id'           => 1,
        ]);

        $this->assertDatabaseCount('clients', $totalClients + 1);

        // Delete the client as need to keep it in database for other tests
        $client = Client::where('cedula', 87100445)->where('nombre', 'Test Create Client DFYA')->first();
        $client->delete();
    }
}
