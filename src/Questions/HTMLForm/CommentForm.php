<?php

namespace Kris3XIQ\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Kris3XIQ\Questions\Questions;
use Kris3XIQ\Questions\Answers;
use Kris3XIQ\Questions\Tags;
use Kris3XIQ\Questions\Comments;
use \Kris3XIQ\TextFilter\MyTextFilter;

/**
 * Form to update an item.
 */
class CommentForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $answer = $this->getItemDetails($id);
        $this->form->create(
            [
                "answer_id" => __CLASS__,
            ],
            [
                "id" => [
                    "type" => "hidden",
                    "value" => $answer->rowid,
                ],

                "reply" => [
                    "type" => "textarea",
                    "label" => "",
                    "validation" => ["not_empty"],
                    "placeholder" => "Comment to this answer..",
                    // "value" => $questions->title,
                ],

                "tags" => [
                    "type" => "hidden",
                    "readonly" => "true",
                    "value" => $answer->answer_tags,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Post your comment",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     * 
     * @return Questions
     */
    public function getItemDetails($id) : object
    {
        $answers = new Answers();
        $answers->setDb($this->di->get("dbqb"));
        $answers->find("rowid", $id);
        return $answers;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {

        // Get values from the submitted form
        $answer_id     = $this->form->value("id");
        $comment_user  = $_SESSION["user"];
        $comment_tags  = $this->form->value("tags");
        $reply         = $this->form->value("reply");
    
        $comment = new Comments();
        $comment->setDb($this->di->get("dbqb"));
        $comment->answer_id = $answer_id;
        $comment->comment_user = $comment_user;
        $comment->comment_tags = $comment_tags;
        $comment->created = date("Y-m-d h:i:s a");
        // Filter the text before saving it
        $filter = new MyTextFilter();
        $filteredText = $filter->parse($reply, ["markdown"]);
        $comment->comment = $reply;
        $comment->comment = $filteredText;
        $comment->save();
        // $answers->findById("id", $this->form->value("id"));
        // $answer->id = $this->form->value("id");
        // $answer->answer_user = $_SESSION["user"];
        // $answer->answer_tags = $this->form->value("tags");
        // $answer->votes = 0;
        // $answer->answer = $this->form->value("answer");
        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("questions")->send();
        //$this->di->get("response")->redirect("questions/update/{$questions->id}");
    }



    /**
     * Callback what to do if the form was unsuccessfully submitted, this
     * happen when the submit callback method returns false or if validation
     * fails. This method can/should be implemented by the subclass for a
     * different behaviour.
     */
    public function callbackFail()
    {
        $this->di->get("response")->redirectSelf()->send();
    }
}
