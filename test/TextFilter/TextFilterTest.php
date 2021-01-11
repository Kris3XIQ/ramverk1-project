<?php

namespace Kris3XIQ\TextFilter;

use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class MyTextFilterTest extends TestCase
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
     * Filter for bbcode
     */
    public function testparsebbcode()
    {
        $filter = new MyTextFilter();
    
        $res = $filter->parse("Text", ["bbcode"]);
        $this->assertIsString($res);
    }

    /**
     * Filter for links
     */
    public function testparselink()
    {
        $controller = new MyTextFilter();

        $res = $controller->parse("Text", ["link"]);
        $this->assertIsString($res);
    }

    /**
     * Filter for markdown
     */
    public function testparsemarkdown()
    {
        $controller = new MyTextFilter();

        $res = $controller->parse("Text", ["markdown"]);
        $this->assertIsString($res);
    }

    /**
     * Filter for nl2br
     */
    public function testparsenl2br()
    {
        $controller = new MyTextFilter();

        $res = $controller->parse("Text", ["nl2br"]);
        $this->assertIsString($res);
    }
}
