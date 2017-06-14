<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $user = new \App\Models\User(array('name' => 'Admin'));
        $this->be($user);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/home');

        $response->assertSee("companies");

        $response->assertStatus(200);
    }
}
