<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceID;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
  public function testDependency(){
    // $foo = new Foo();
    $foo1 = $this->app->make(Foo::class); // new Foo()
    $foo2 = $this->app->make(Foo::class); // new Foo()

    self::assertEquals("Foo", $foo1->foo());
    self::assertEquals("Foo", $foo2->foo());
    self::assertNotSame($foo1, $foo2);
  }

  public function testBind(){
    // tidak bisa karena butuh parameter (__construct)
    // $person = $this->app->make(Person::class); // new Person()
    // self::assertNotNull($person);

    // function closure dibawah akan selalu dipanggil
    // ketika kita memanggil make Person
    $this->app->bind(Person::class, function($app){
      return new Person("Husni", "Ramdani");
    });

    $person1 = $this->app->make(Person::class); // closure() // new Person("Husni", "Ramdani");
    $person2 = $this->app->make(Person::class); // closure() // new Person("Husni", "Ramdani");

    self::assertEquals("Husni", $person1->firstName);
    self::assertEquals("Husni", $person2->firstName);
    // binding menghasilkan 2 object yg berbeda
    self::assertNotSame($person1, $person2);
  }

  public function testSingleton(){
    $this->app->singleton(Person::class, function($app){
      return new Person("Husni","Ramdani");
    });

    $person1 = $this->app->make(Person::class); // new Person("Husni", "Ramdani") if not exists
    $person2 = $this->app->make(Person::class); // return existing

    self::assertEquals("Husni", $person1->firstName);
    self::assertEquals("Husni", $person2->firstName);
    // singleton menghasilkan 1 object yang sama
    // dan tidak memakan memori yang banyak
    self::assertSame($person1, $person2);
  }

  public function testInstance(){
    $person = new Person("Husni", "Ramdani");
    $this->app->instance(Person::class, $person);

    $person1 = $this->app->make(Person::class); // $person
    $person2 = $this->app->make(Person::class); // $person
    $person3 = $this->app->make(Person::class); // $person

    self::assertEquals("Husni", $person1->firstName);
    self::assertEquals("Husni", $person2->firstName);

    // akan berisi object dependency yg sudah didefine diawal yaitu person
    self::assertSame($person1, $person2);
  }

  public function testDependencyInjection(){
    $this->app->singleton(Foo::class, function($app){
      return new Foo();
    });

    $foo = $this->app->make(Foo::class);
    $bar1 = $this->app->make(Bar::class);
    $bar2 = $this->app->make(Bar::class);

    self::assertSame($foo, $bar1->foo);
    self::assertNotSame($bar1, $bar2);
  }

  public function testDependencyInjectionClosure(){
    $this->app->singleton(Foo::class, function($app){
      return new Foo();
    });
    // mneggunakan app sebagai service container
    $this->app->singleton(Bar::class, function($app){
      $foo = $app->make(Foo::class);
      return new Bar($foo);
    });

    $foo = $this->app->make(Foo::class);
    $bar1 = $this->app->make(Bar::class);
    $bar2 = $this->app->make(Bar::class);

    self::assertSame($foo, $bar1->foo);
    self::assertSame($bar1, $bar2);
  }

  public function testInterfaceToClass(){
    $this->app->singleton(HelloService::class, HelloServiceID::class);


    $helloService = $this->app->make(HelloService::class);
    self::assertEquals("Halo Husni", $helloService->hello("Husni"));
  }
}
