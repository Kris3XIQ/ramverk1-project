<?php

namespace Kris3XIQ\User\HTMLForm;

use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use Kris3XIQ\User\User;
use Anax\HTMLForm\FormModel;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class UserLoginFormTest extends TestCase
{
    protected $di;

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
     * If something failed with the callback
     */
    public function testcallbackSubmitFail()
    {
        $form = new UserLoginForm($this->di);
        $form->check();

        $res = $form->callbackSubmit();
        $this->assertFalse($res);
    }
}
