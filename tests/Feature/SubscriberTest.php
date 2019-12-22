<?php

namespace Tests\Feature;

use App\Subscriber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');
    }

    public function testGettingAllSubscribers()
    {
        $response = $this->json('GET', '/api/subscribers');

        $response->assertStatus(200)
            ->assertJsonCount(10);

    }

    public function testGettingExactSubscriber()
    {
        $response = $this->json('GET', 'api/subscribers/1');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'email',
                'name',
                'state',
                'created_at',
                'updated_at',
            ]);
    }

    public function testPostingSubscriber()
    {
        $response = $this->json(
            'POST',
            '/api/subscribers',
            [
                'email' => 'test@test.com',
                'name' => 'Rock',
                'state' => 'junk',
            ]
        );

        $response->assertStatus(201)
            ->assertJsonStructure([
                'email',
                'name',
                'state',
                'updated_at',
                'created_at',
                'id',
            ]);
    }

    public function testPostingSubscriberWithInvalidEmail()
    {
        $response = $this->json(
            'POST',
            '/api/subscribers',
            [
                'email' => 'test@testxnd.com',
                'name' => 'Rock',
                'state' => 'junk',
            ]
        );

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors',
            ]);
    }

    public function testUpdatingSubscriber()
    {
        $response = $this->json(
            'PUT',
            '/api/subscribers/1',
            [
                'email' => 'test@test.com',
                'name' => 'Rock',
                'state' => 'junk',
            ]
        );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'email',
                'name',
                'state',
                'updated_at',
                'created_at',
                'id',
            ]);
    }

    public function testDeletingSubscriber()
    {
        $response = $this->json('DELETE', '/api/subscribers/1');

        $response->assertStatus(204);

        $this->assertNull(Subscriber::find(1));
    }
}
