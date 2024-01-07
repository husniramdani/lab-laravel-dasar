<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
  public function testInput(){
    $this->get('/input/hello?name=Husni')
      ->assertSeeText('Hello Husni');

    $this->post('/input/hello', [
      'name'=> 'Husni',
    ])->assertSeeText('Hello Husni');
  }

  public function testNestedInput(){
    $this->post('/input/hello/first', [
      'name' => [
        "first" => "Husni",
        "last" => "Ramdani",
      ]
    ])->assertSeeText('Hello Husni');
  }

  public function testInputAll(){
    $this->post('/input/hello/input', [
      'name' => [
        "first" => "Husni",
        "last" => "Ramdani",
      ]
    ])->assertSeeText('name')
      ->assertSeeText('first')
      ->assertSeeText('last')
      ->assertSeeText('Husni')
      ->assertSeeText('Ramdani');
  }

  public function testArrayInput(){
     $this->post('/input/hello/array', [
      'products' => [
        [
          "name" => "Apple Mac",
          "price" => 300
        ],
        [
          "name"=> "Samsung wow",
          "price" => 100
        ]
      ]
    ])->assertSeeText('Apple Mac')
      ->assertSeeText('Samsung wow');
  }

  public function testInputType(){
    $this->post('/input/type', [
      'name' => 'Budi',
      'married' => 'true',
      'birth_date' => '1998-10-10'
    ])->assertSeeText('Budi')->assertSeeText('true')->assertSeeText('1998-10-10');
  }

  public function testFilterOnly(){
    $this->post('/input/filter/only', [
      'name' => [
        'first' => 'Husni',
        'middle' => 'Oke',
        'last' => 'Ramdani'
      ]
    ])->assertSeeText('Husni')->assertSeeText('Ramdani')->assertDontSeeText('Oke');
  }

  public function testFilterExcept(){
    $this->post('/input/filter/except', [
      "username" => 'husni',
      "password" => "rahasia",
      "admin" => "true"
    ])->assertSeeText("husni")->assertSeeText('rahasia')
      ->assertDontSeeText('admin');
  }

  public function testFilterMerge(){
    $this->post('/input/filter/merge', [
      "admin" => "true",
    // false karena admin di merge menjadi false
    ])->assertSeeText('admin')->assertSeeText("false");
  }
}
