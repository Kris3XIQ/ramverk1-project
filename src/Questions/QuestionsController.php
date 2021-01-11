<?php

namespace Kris3XIQ\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Kris3XIQ\Questions\HTMLForm\CreateForm;
use Kris3XIQ\Questions\HTMLForm\EditForm;
use Kris3XIQ\Questions\HTMLForm\DeleteForm;
use Kris3XIQ\Questions\HTMLForm\UpdateForm;
use Kris3XIQ\Questions\HTMLForm\AnswerForm;
use Kris3XIQ\Questions\HTMLForm\CommentForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionsController implements ContainerInjectableInterface
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
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));

        $page->add("questions/view-all", [
            "questions" => array_reverse($questions->findAll()),
        ]);

        return $page->render([
            "title" => "All questions",
        ]);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di);
        $form->check();

        $page->add("questions/crud/create", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a item",
        ]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return object as a response object
     */
    public function deleteAction() : object
    {
        $page = $this->di->get("page");
        $form = new DeleteForm($this->di);
        $form->check();

        $page->add("questions/crud/delete", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Delete an item",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("questions/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }

    /**
     * Handler with view options for question
     *
     * @param int $id of the question
     *
     * @return object as a response object
     */
    public function questionAction(int $id) : object
    {

        $page = $this->di->get("page");
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $question = $questions->find("id", $id);
        $answers = new Answers();
        $answers->setDb($this->di->get("dbqb"));
        $form = new AnswerForm($this->di, $id);
        $form->check();
        $all_answers_to_question = $answers->findAllWhere("question_id = ?", $id);
        $all_answers_with_comments = [];
        foreach ($all_answers_to_question as $comment) {
            $comments = new Comments();
            $comments->setDb($this->di->get("dbqb"));
            $all_comments = $comments->findAllWhere("answer_id = ?", $comment->rowid);
            array_push($all_answers_with_comments, $all_comments);
        }

        $page->add("questions/view-question", [
            "question" => $question,
            "answers" => $answers->findAllWhere("question_id = ?", $id),
            "comments" => $all_answers_with_comments,
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }

    /**
     * Handler with view options for question
     *
     * @param int $id of the answer
     *
     * @return object as a response object
     */
    public function commentAction(int $id) : object
    {
        $page = $this->di->get("page");
        // $questions = new Questions();
        // $questions->setDb($this->di->get("dbqb"));
        // $question = $questions->find("id", $id);
        $answers = new Answers();
        $answers->setDb($this->di->get("dbqb"));
        $form = new CommentForm($this->di, $id);
        $form->check();
        // $page->add("questions/crud/view-all", [
        //     "questions" => $questions->findAll(),
        // ]);

        $page->add("questions/view-answer", [
            // "question" => $question,
            "answers" => $answers->findAllWhere("rowid = ?", $id),
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }
}
