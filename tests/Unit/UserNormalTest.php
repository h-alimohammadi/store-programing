<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserNormalTest extends TestCase
{
    protected $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->make([
            'active' => 1
        ]);
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->user->delete();
    }

    /**
     * @test
     */
    public function send_data_for_register()
    {
        $response = $this->post('/register' , $this->user->toArray());
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /**
     * @test
     */
    public function a_user_can_view_user_panel()
    {
        $response =$this->actingAs($this->user)
                        ->get('/user/panel');
        $response->assertSee('پنل کاربری');
    }

    /**
     * @test
     */
    public function a_user_can_view_user_panel_history_page()
    {
        $this->be($this->user);
        $response = $this->get('/user/panel/history');
        $response->assertSee('مقدار پرداخت');
    }
}
