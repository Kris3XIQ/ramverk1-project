<?php

namespace Kris3XIQ\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Kris3XIQ\Questions\HTMLForm\CreateForm;
use Kris3XIQ\Questions\HTMLForm\EditForm;
use Kris3XIQ\Questions\HTMLForm\DeleteForm;
use Kris3XIQ\Questions\HTMLForm\UpdateForm;
use Kris3XIQ\Questions\HTMLForm\AnswerForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagsController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $tags = new Tags();
        $tags->setDb($this->di->get("dbqb"));

        $page->add("questions/all-tags", [
            "tags" => $tags->findAll(),
        ]);

        return $page->render([
            "title" => "All questions",
        ]);
    }

    /**
     * Handler with view options for question
     *
     * @param string $id of the question
     *
     * @return object as a response object
     */
    public function tagAction(string $tag) : object
    {
        $page = $this->di->get("page");
        $tags = new Tags();
        $tags->setDb($this->di->get("dbqb"));
        $questions_with_tag = $tags->findAllWhere("tag = ?", $tag);
        $all_questions_with_tags = [];
        foreach ($questions_with_tag as $tag) {
            $questions = new Questions();
            $questions->setDb($this->di->get("dbqb"));
            $all_tags_for_question = $questions->find("id", $tag->tag_question_id);
            array_push($all_questions_with_tags, $all_tags_for_question);
        }

        $page->add("questions/tags", [
            "tags" => $questions_with_tag,
            "questions" => $all_questions_with_tags,
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }
}
