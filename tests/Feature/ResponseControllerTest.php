<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
  public function testResponse()
  {
    $this->get('/response/hello')
      ->assertStatus(200)
      ->assertSeeText('Hello Response');
  }

  public function testHeader()
  {
    $this->get('/response/header')
    ->assertStatus(200)
    ->assertSeeText('Husni')->assertSeeText('Ramdani')
    ->assertHeader('Content-Type', 'application/json')
    ->assertHeader('Author', 'spindyzel')
    ->assertHeader('App', 'Belajar Laravel');
  }

  public function testView()
  {
    $this->get('/response/type/view')
      ->assertSeeText('Hello Husni');
  }

  public function testJson()
  {
    $this->get('/response/type/json')
      ->assertJson([
        'firstName' => 'Husni',
        'lastName' => 'Ramdani'
      ]);
  }

  public function testFile()
  {
    $this->get('/response/type/file')
     ->assertHeader('Content-Type','image/jpeg');
  }

  public function testDownload()
  {
    $this->get('/response/type/download')
      ->assertDownload('profile.jpg');
  }
}
