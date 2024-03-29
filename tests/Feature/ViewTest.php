<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
  public function testView(){
    $this->get('/hello')
    ->assertSeeText('Hello Husni');

    $this->get('/hello-again')
    ->assertSeeText('Hello again Husni');
  }

  public function testViewNested(){
    $this->get('/hello-world')
    ->assertSeeText('World Husni');
  }

  public function testViewTemplate(){
    $this->view('hello', ['name' => 'Husni'])
    ->assertSeeText('Hello Husni');

    $this->view('hello.world', ['name' => 'Husni'])
    ->assertSeeText('World Husni');
  }
}
