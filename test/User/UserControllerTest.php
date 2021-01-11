<?php

namespace Kris3XIQ\User;

use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class UserControllerTest extends TestCase
{
    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Set DI
        $this->di = $di;
    }

    /**
     * Test the route "index".
     */
    public function testindexActionGet()
    {
        $session = $this->di->get("session");
        $controller = new UserController();
        $controller->setDI($this->di);

        $res = $controller->indexActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "login".
     */
    public function testloginAction()
    {
        $controller = new UserController();
        $controller->setDI($this->di);

        $res = $controller->loginAction();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "create".
     */
    public function testcreateAction()
    {
        $controller = new UserController();
        $controller->setDI($this->di);

        $res = $controller->createAction();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "update".
     */
    public function testupdateAction()
    {
        $session = $this->di->get("session");
        $controller = new UserController();
        $controller->setDI($this->di);

        $username = "TestUser";
        $res = $controller->updateAction($username);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "logout".
     */
    public function testlogoutAction()
    {
        $session = $this->di->get("session");
        $controller = new UserController();
        $controller->setDI($this->di);

        $res = $controller->logoutAction();
        $this->assertNull($res);
    }

    /**
     * Test the route "logout".
     */
    public function testpostsAction()
    {
        $session = $this->di->get("session");
        $controller = new UserController();
        $controller->setDI($this->di);

        $username = "TestUser";
        $res = $controller->postsAction($username);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the class User.
     */
    public function testuser()
    {
        $controller = new User();
        $controller->setDb($this->di->get("dbqb"));

        $controller->gravatarEmail("Test@Gmail.com");
        $controller->setPassword("SuperSecretPassword");
        $controller->verifyPassword("Test@Gmail.com", "SuperSecretPassword");

        $this->assertIsObject($controller);
    }
}
