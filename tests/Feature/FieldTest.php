<?php

namespace Tests\Feature;

use App\Field;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;
use Tests\TestCase;

class FieldTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');
    }

    public function testGettingAllFields()
    {
        $response = $this->json('GET', '/api/fields');

        $response->assertStatus(200)
            ->assertJsonCount(20);
    }

    public function testGettingExactField()
    {
        $response = $this->json('GET', 'api/fields/1');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'title',
                'type',
                'subscriber_id',
                'created_at',
                'updated_at',
            ]);
    }

    public function testPostingSubscribersField()
    {
        $response = $this->json(
            'POST',
            '/api/subscribers/1/fields',
            [
                'title' => 'field',
                'type' => 'string',
            ]
        );

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'title',
                'type',
                'subscriber_id',
                'created_at',
                'updated_at',
            ]);
    }

    public function testPostingSubscribersFieldWithMissingTitle()
    {
        $response = $this->json(
            'POST',
            '/api/subscribers/1/fields',
            [
                'type' => 'string',
            ]
        );

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors',
            ]);
    }

    public function testUpdatingField()
    {
        $response = $this->json(
            'PUT',
            '/api/fields/1',
            [
                'title' => 'field updated',
                'type' => 'number',
            ]
        );

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'title',
                'type',
                'subscriber_id',
                'created_at',
                'updated_at',
            ]);
    }

    public function testDeletingField()
    {
        $response = $this->json('DELETE', '/api/fields/1');

        $response->assertStatus(204);

        $this->assertNull(Field::find(1));
    }
}
