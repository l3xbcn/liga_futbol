<?php

namespace Tests\Feature;

trait UserControllerTest
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function test_user_can_auth() {
        $response = $this->post(route('login'), [
            'email' => 'admin@localhost',
            'password' => 'admin'
        ]);

        $response->assertRedirect(route('home'));
    }

}
