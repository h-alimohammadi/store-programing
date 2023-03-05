<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadArticleTest extends TestCase
{
    protected $article;

    protected function setUp()
    {
        parent::setUp();
        $this->article = factory(Article::class)->create([
            'user_id' => 5
        ]);
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->article->delete();
    }

    /**
     * @test
     */
    public function a_user_can_view_home_page()
    {
        $this->get('/')
            ->assertSee($this->article->title);
    }

    /**
     * @test
     */
    public function a_user_can_view_single_article()
    {
        $response = $this->get($this->article->path());
        $response->assertStatus(200);
        $response->assertSee($this->article->title);
    }


}
