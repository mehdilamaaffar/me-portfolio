<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_see_home_page()
    {
        $this->get('/home')
            ->assertStatus(200);
    }

    /** @test */
    function user_can_see_categories_page()
    {
        $this->get('/categories')
            ->assertStatus(200);
    }

    /** @test */
    function user_can_see_category_with_thier_photos()
    {
        $category = factory('App\Gallery')->states('testing')->create();

        $this->get('/gallery/' . $category->name_slug)
            ->assertStatus(200);
    }

    /** @test */
    function user_can_see_contact_page()
    {
        $this->get('/contact')
            ->assertStatus(200);
    }

    /** @test */
    function user_can_see_single_photo()
    {
        $photo = factory('App\Photo')->create();

        $this->get('/photo/' . $photo->id)
            ->assertSee($photo->gallery->name)
            ->assertSee(url($photo->file_path))
            ->assertStatus(200);
    }
}
