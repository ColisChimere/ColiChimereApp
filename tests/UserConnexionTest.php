<?php

namespace App\Tests;

use App\Entity\UserConnexion;
use PHPUnit\Framework\TestCase;

class UserConnexionTest extends TestCase
{
    public function testIsValid(): void
    {
        $ucTest1 = new UserConnexion();
        $dt = new \DateTime();
        $dt->modify('-20 second');
        $ucTest1->setDateCreation($dt);
        $ucTest1->setLifeTime(500);
        $this->assertTrue($ucTest1->isValid());
        $dt->modify("-1 hour");
        $ucTest1->setDateCreation($dt);
        $this->assertFalse($ucTest1->isValid());
    }
}
