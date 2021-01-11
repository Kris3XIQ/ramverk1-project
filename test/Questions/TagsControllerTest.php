<?php

namespace Kris3XIQ\Questions;

use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
// use Kris3XIQ\Questions\HTMLForm\CreateForm;
// use Kris3XIQ\Questions\HTMLForm\EditForm;
// use Kris3XIQ\Questions\HTMLForm\DeleteForm;
// use Kris3XIQ\Questions\HTMLForm\UpdateForm;
// use Kris3XIQ\Questions\HTMLForm\AnswerForm;
// use Kris3XIQ\Questions\HTMLForm\CommentForm;

/**
 * Test the SampleController.
 */
class TagsControllerTest extends TestCase
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
     * Test the route "index".
     */
    public function testindexActionGet()
    {
        $controller = new TagsController();
        $controller->setDI($this->di);

        $res = $controller->indexActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "tag".
     */
    public function testtagAction()
    {
        $controller = new TagsController();
        $controller->setDI($this->di);

        $res = $controller->tagAction("TestTag");
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
}
