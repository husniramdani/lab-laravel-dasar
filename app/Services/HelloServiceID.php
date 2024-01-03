<?php

namespace App\Services;

class HelloServiceID implements HelloService {
  public function hello(string $name) : string {
    return "Halo $name";
  }
}
