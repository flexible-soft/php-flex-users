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
    }

    /**
     * @expectedException \FlexBase\BoomUnauthorizedException
     * @expectedExceptionCode 401
     */
    public function testFindUserNotFound()
    {
        $this->loginAction->run('nouser@example.com', '123456', function ($err, $data) {

            if (!empty($err) && $err instanceof \Exception) {
                throw $err;
            }
        });
    }

    /**
     * @expectedException \FlexBase\BoomUnauthorizedException
     * @expectedExceptionCode 401
     */
    public function testComparePasswordNotMatch()
    {
        $this->loginAction->run('test1@example.com', '123sdasdGA%@&#TGS', function ($err, $data) {

            if (!empty($err) && $err instanceof \Exception) {
                throw $err;
            }
        });
    }

    public function testLoginSuccess()
    {
        $this->loginAction->encryptionAlgorithm = function ($password) {

            return $password;
        };

        $this->loginAction->run('test1@example.com', 'pass1', function ($err, $data) {

            \PHPUnit_Framework_TestCase::assertEquals($err, null);
            \PHPUnit_Framework_TestCase::assertEquals($data['user']->email, 'test1@example.com');
        });
    }

    public function testAfterAction()
    {
        $this->loginAction->after = function ($data) {

            \PHPUnit_Framework_TestCase::assertEquals($data['user']->email, 'test1@example.com');
        };

        $this->loginAction->encryptionAlgorithm = function ($password) {

            return $password;
        };

        $this->loginAction->run('test1@example.com', 'pass1', function ($err, $data) {

            \PHPUnit_Framework_TestCase::assertEquals($err, null);
        });
    }
}
