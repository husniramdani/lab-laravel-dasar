<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
  public function testUrlCurrent()
  {
    $this->get('/url/current?name=Husni')
      ->assertSeeText('/url/current?name=Husni');
  }

  public function testNamed()
  {
    $this->get('/redirect/named')
      ->assertSeeText('/redirect/name/Husni');
  }

  public function testAction()
  {
    $this->get('/url/action')
      ->assertSeeText('/form');
  }
}
