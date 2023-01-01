<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users_index_page_status()
    {
        $response = $this->get('/user/index');
        $response->assertOk();
    }
    public function test_users_new_resource_is_created()
    {
        $response = $this->post('/user/store');
        $response->assertRedirect("/user/index");

    }

    public function test_users_existing_user_is_updated()
    {
        $user=User::all()->last();
        $user->name="UPDATED".$user->name;
        $user->email="email".$user->email;
        $data=$user->toArray();
        $response = $this->put('/user/'.$user->id,$data);
        $response->assertRedirect("/user");
    }

    public function test_users_latest_user_is_deleted()
    {
        $user=User::all()->last();
        $id=$user->id;
        $response = $this->delete('/user/'.$user->id);
        $response->assertOk();
        $response->assertJson(["message"=>"done","id"=>$id]);
        $this->assertDeleted($user);
    }


}
