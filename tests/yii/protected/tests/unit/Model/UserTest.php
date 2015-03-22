<?php

use FlexUser\Model\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateUser()
    {
        $user = new User();
        $this->assertEquals(0, $user->createUser(array(1, 2, 3)));
    }
}
