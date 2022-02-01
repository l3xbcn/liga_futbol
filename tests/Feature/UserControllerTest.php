<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

trait UserControllerTest
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function test_user_can_auth() {

        $user=User::find(1); //admin

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');        

        $response->assertStatus(200);
    }

}
