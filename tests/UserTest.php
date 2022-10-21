<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{

    /*
    On vient tester l'entity User avec trois fonctions :
        testIsTrue()
        testIsFalse()
        testIsEmpty()
    */
    public function testIsTrue()
    {
        $user = new User();

        $user->setEmail('true@test.com')
             ->setPassword('password');

        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getPassword() === 'password');
    }

    public function testIsFalse()
    {
        $user = new User();

        $user->setEmail('true@test.com')
             ->setPassword('password');

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
    }

    // public function testIsEmpty()
    // {
    //     $user = new User();

    //     $this->assertEmpty($user->getEmail());
    //     $this->assertEmpty($user->getPassword());
    // }
}
