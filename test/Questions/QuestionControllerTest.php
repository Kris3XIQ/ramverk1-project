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
class QuestionControllerTest extends TestCase
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
        $controller = new QuestionsController();
        $controller->setDI($this->di);

        $res = $controller->indexActionGet();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "create".
     */
    public function testcreateAction()
    {
        $controller = new QuestionsController();
        $controller->setDI($this->di);

        $res = $controller->createAction();
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "delete".
     */
    public function testdeleteAction()
    {
        $controller = new QuestionsController();
        $controller->setDI($this->di);

        $res = $controller->deleteAction(1);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "update".
     */
    public function testupdateAction()
    {
        $controller = new QuestionsController();
        $controller->setDI($this->di);

        $res = $controller->updateAction(1);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "question".
     */
    public function testquestionAction()
    {
        $controller = new QuestionsController();
        $controller->setDI($this->di);

        $res = $controller->questionAction(1);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }

    /**
     * Test the route "comment".
     */
    public function testcommentAction()
    {
        $controller = new QuestionsController();
        $controller->setDI($this->di);

        $res = $controller->commentAction(1);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }


}
