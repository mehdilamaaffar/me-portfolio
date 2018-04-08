<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryAdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_unautenticated_user_cant_see_admin_panel()
    {
        $this->get('/admin')
            ->assertRedirect('/login');
    }

    /** @test */
    function an_autenticated_user_can_see_admin_panel()
    {
        $this->actingAs(factory('App\User')->create());

        $this->get('/admin')
            ->assertStatus(200);
    }

    /** @test */
    function an_unautenticated_user_can_post_new_gallery()
    {
        $gallery = factory('App\Gallery')->raw();

        $this->post('/admin/gallery', $gallery)
            ->assertRedirect('/login');
    }

    /** @test */
    function an_autenticated_user_can_post_new_gallery()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user);

        $gallery = factory('App\Gallery')->raw();

        $this->post('/admin/gallery', $gallery)
            ->assertRedirect('/')
            ->assertStatus(302);
    }
}
