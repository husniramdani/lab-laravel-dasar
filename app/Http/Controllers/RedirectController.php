<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
  public function redirectTo(): string
  {
    return "Redirect To";
  }

  public function redirectFrom(): RedirectResponse
  {
    return redirect('/redirect/to');
  }

  public function redirectHello(string $name): string
  {
    return "Hello $name";
  }

  public function redirectName(): RedirectResponse
  {
    return redirect()->route('redirect-hello', ['name'=> 'guest']);
  }

  public function redirectAction(): RedirectResponse
  {
    return redirect()->action([RedirectController::class,'redirectHello'], ['name' => 'guest']);
  }

  public function redirectAway(): RedirectResponse
  {
    return redirect()->away('https://spindyzel.com');
  }
}
