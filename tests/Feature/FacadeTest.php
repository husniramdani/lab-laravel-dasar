<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
  public function testConfig(){
    $firstName1 = config("contoh.author.first");
    $firstName2 = Config::get("contoh.author.first");

    self::assertEquals($firstName1, $firstName2);

    // var_dump(Config::all());
  }

  public function testConfigDependency(){
    $config = $this->app->make('config');
    $firstName3 = $config->get('contoh.author.first');

    $firstName1 = config("contoh.author.first");
    $firstName2 = Config::get("contoh.author.first");

    self::assertEquals($firstName3, $firstName1);
    self::assertEquals($firstName3, $firstName2);

    // var_dump($config->all());
  }

  public function testConfigMock(){
    Config::shouldReceive('get')
      ->with('contoh.author.first')
      ->andReturn('Husni Keren');

    $firstName = Config::get('contoh.author.first');
    self::assertEquals('Husni Keren', $firstName);
  }
}
