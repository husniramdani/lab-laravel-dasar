<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
  public function testCreateCookie()
  {
    $this->get('/cookie/set')
      ->assertSeeText('Hello Cookie')
      ->assertCookie('user-id','husni')
      ->assertCookie('is-member','true');
  }

  public function testGetCookie()
  {
    $this->withCookie('user-id','husni')
      ->withCookie('is-member','true')
      ->get('/cookie/get')
      ->assertJson([
        'userId'=> 'husni',
        'isMember'=> 'true',
      ]);
  }

  public function testClearCookie()
  {
    $this->get('/cookie/clear')
      ->assertSeeText('Clear Cookie')
      ->assertCookieExpired('user-id')
      ->assertCookieExpired('is-member');
  }
}
