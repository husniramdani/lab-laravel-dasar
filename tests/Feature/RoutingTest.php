<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
  public function testBasicRouting(){
    $this->get("/profile")
      ->assertStatus(200)
      ->assertSeeText("This is profile page");
  }

  public function testRedirect(){
    $this->get("/youtube")
      ->assertRedirect("/profile");
  }

  public function testFallback(){
    $this->get("/empty")
    ->assertSeeText("404");
  }
}
