<?php

namespace tests\unit\Action;

use FlexUser\Action\Login;

class LoginTest extends \PHPUnit_Framework_TestCase
{
    public $loginAction = null;

    public function setUp()
    {
        $this->loginAction = new Login();

        $this->loginAction->before = function ($email, $password) {

            if (empty($email)) {
                return 'Email cannot be blank.';
            }
            if (empty($password)) {
                return 'Password cannot be blank.';
            }
            return true;
        };
    }

    public function testBeforeAction()
    {
        $this->loginAction->run(null, null, function ($err, $data) {

            \PHPUnit_Framework_TestCase::assertEquals($err, 'Email cannot be blank.');
        });
        $this->loginAction->run('', null, function ($err, $data) {

            \PHPUnit_Framework_TestCase::assertEquals($err, 'Email cannot be blank.');
        });
        $this->loginAction->run('test1@example.com', null, function ($err, $data) {

            \PHPUnit_Framework_TestCase::assertEquals($err, 'Password cannot be blank.');
        });
        $this->loginAction->run('test1@example.com', '', function ($err, $data) {

            \PHPUnit_Framework_TestCase::assertEquals($err, 'Password cannot be blank.');
        });
        $this->loginAction->run('test1@example.com', 'pass1', function ($err, $data) {

            \PHPUnit_Framework_TestCase::assertEquals($err, null);
        });
    }
}
