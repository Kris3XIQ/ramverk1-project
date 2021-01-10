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
     * @var $data description
     */
    //private $data;



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }



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



    // /**
    //  * Handler with form to create a new item.
    //  *
    //  * @return object as a response object
    //  */
    // public function createAction() : object
    // {
    //     $page = $this->di->get("page");
    //     $form = new CreateForm($this->di);
    //     $form->check();

    //     $page->add("questions/crud/create", [
    //         "form" => $form->getHTML(),
    //     ]);

    //     return $page->render([
    //         "title" => "Create a item",
    //     ]);
    // }



    // /**
    //  * Handler with form to delete an item.
    //  *
    //  * @return object as a response object
    //  */
    // public function deleteAction() : object
    // {
    //     $page = $this->di->get("page");
    //     $form = new DeleteForm($this->di);
    //     $form->check();

    //     $page->add("questions/crud/delete", [
    //         "form" => $form->getHTML(),
    //     ]);

    //     return $page->render([
    //         "title" => "Delete an item",
    //     ]);
    // }

    // /**
    //  * Handler with form to update an item.
    //  *
    //  * @param int $id the id to update.
    //  *
    //  * @return object as a response object
    //  */
    // public function updateAction(int $id) : object
    // {
    //     $page = $this->di->get("page");
    //     $form = new UpdateForm($this->di, $id);
    //     $form->check();
    //     var_dump($form);

    //     $page->add("questions/crud/update", [
    //         "form" => $form->getHTML(),
    //     ]);

    //     return $page->render([
    //         "title" => "Update an item",
    //     ]);
    // }
}
