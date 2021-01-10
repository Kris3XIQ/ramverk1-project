<?php

namespace Kris3XIQ\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Kris3XIQ\Questions\Questions;
use Kris3XIQ\Questions\Tags;
use \Kris3XIQ\TextFilter\MyTextFilter;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Ask your question",
            ],
            [
                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "placeholder" => "Your title.."
                ],
                        
                "question" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                    "placeholder" => "Ask your question.."
                ],

                "tags" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "placeholder" => "Tags.."
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Ask",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $questions->title  = $this->form->value("title");
        // Filter the text before saving it
        $filter = new MyTextFilter();
        $text = $this->form->value("question");
        $filteredText = $filter->parse($text, ["nl2br","markdown"]);
        $question_ids = $questions->findAll("id");
        $last_id = end($question_ids);
        var_dump($last_id);
        if ($last_id) {
            $set_id = $last_id->id + 1;
        } else {
            $set_id = 1;
        }
        // $answer->answer = $reply;
        //$answer->answer = $filteredText;
        // $questions->question = $this->form->value("question");
        $questions->question = $filteredText;
        $questions->question_user = $_SESSION["user"];
        $questions->question_user_grav = $_SESSION["grav"];
        $questions->created = date("Y-m-d h:i:s a");
        $tags = explode(",", $this->form->value("tags"));
        foreach ($tags as $tagg) {
            $tag = new Tags();
            $tag->setDb($this->di->get("dbqb"));
            $tag->tag = $tagg;
            $tag->tag_user = $_SESSION["user"];
            // $tag->tag_question_id = $last_id->id + 1;
            $tag->tag_question_id = $set_id;
            $tag->tag_question_title = $this->form->value("title");
            $tag->tag_question = $this->form->value("question");
            $tag->created = date("Y-m-d h:i:s a");
            $tag->save();
        }
        $questions->question_tags = $this->form->value("tags");
        $questions->save();
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
    }



    // /**
    //  * Callback what to do if the form was unsuccessfully submitted, this
    //  * happen when the submit callback method returns false or if validation
    //  * fails. This method can/should be implemented by the subclass for a
    //  * different behaviour.
    //  */
    // public function callbackFail()
    // {
    //     $this->di->get("response")->redirectSelf()->send();
    // }
}
