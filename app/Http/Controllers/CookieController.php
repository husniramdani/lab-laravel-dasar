<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
  public function createCookie(Request $request): Response
  {
    return response("Hello Cookie")
      ->cookie('user-id', 'husni', 100, "/") // 100 menit
      ->cookie('is-member', 'true', 100, '/');
  }

  public function getCookie(Request $request): JsonResponse
  {
    return response()
      ->json([
        'userId' => $request->cookie('user-id', 'guest'),
        'isMember' => $request->cookie('is-member', 'false'),
      ]);
  }

  public function clearCookie(Request $request): Response
  {
    return response('Clear Cookie')
      ->withoutCookie('user-id')
      ->withoutCookie('is-member');
  }
}
