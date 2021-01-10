<?php

namespace Kris3XIQ\Home;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Kris3XIQ\Questions\HTMLForm\CreateForm;
use Kris3XIQ\Questions\HTMLForm\EditForm;
use Kris3XIQ\Questions\HTMLForm\DeleteForm;
use Kris3XIQ\Questions\HTMLForm\UpdateForm;
use Kris3XIQ\Questions\HTMLForm\AnswerForm;
use Kris3XIQ\Questions\HTMLForm\CommentForm;
use Kris3XIQ\Questions\Questions;
use Kris3XIQ\Questions\Tags;
use Anax\DatabaseQueryBuilder\DatabaseQueryBuilder;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class HomeController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        //Grab top three questions
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $all_questions = $questions->findAll();
        $top_three = array_slice($all_questions, -3, 3, true);
        //Grab top three tags
        $tags = new Tags();
        $tags->setDb($this->di->get("dbqb"));
        $top_three_tags = $tags->topThreeTags();

        $page->add("home/index", [
            "questions" => array_reverse($top_three),
            "top_tags" => $top_three_tags
        ]);

        return $page->render([
            "title" => "A index page",
        ]);
    }
}
