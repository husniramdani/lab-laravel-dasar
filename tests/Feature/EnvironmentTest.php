<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
  public function testGetEnv()
  {
    $youtube = env('YOUTUBE');
    self::assertEquals('spindyzel', $youtube);
  }
  public function testDefaultValut()
  {
    // just another approach
    $author = Env::get('AUTHOR', 'Husni');
    self::assertEquals('Husni', $author);
  }
}
