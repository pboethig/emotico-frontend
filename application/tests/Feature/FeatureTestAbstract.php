<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeatureTestAbstract extends TestCase
{

    use WithoutMiddleware;

    /**
     * @var \App\Models\User
     */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = \App\Models\User::where('name','Admin')->first();
    }


    public function testUser()
    {
        $this->assertGreaterThan(0, $this->user->id);
    }

}
