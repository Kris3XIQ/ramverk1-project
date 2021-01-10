<?php

namespace Kris3XIQ\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Kris3XIQ\User\User;

/**
 * Example of FormModel implementation.
 */
class UserUpdateForm extends FormModel
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
        $user_name = $_SESSION["user"];
        $user = $this->getItemDetails($user_name);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update user information",
            ],
            [
                "id" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->id,
                ],

                "username" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->username,
                ],

                "email" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->email,
                ],

                "password" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    //"value" => $user->password,
                    "placeholder" => "New password"
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }

    /**
     * Get details on the user to load
     *
     * @param integer $id get details on user with id
     * 
     * @return User
     */
    public function getItemDetails($user_name) : object
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("username", $user_name);
        return $user;
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return void return response
     */
    public function callbackSubmit() : void
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $this->form->value("id"));
        $user->username = $this->form->value("username");
        $user->email = $this->form->value("email");
        $gravatar = $user->gravatarEmail($this->form->value("email"));
        $user->gravatar = $gravatar;
        // $user->password = $this->form->value("password");
        $user->setPassword($this->form->value("password"));
        $user->save();
        $username = $this->form->value("username");
        // Update the username for the session
        $this->di->get("session")->set("user", $username);
        $this->di->get("session")->set("grav", $gravatar);
        $this->di->get("response")->redirect("user")->send();
        // return true;
    }

    // /**
    //  * Callback what to do if the form was successfully submitted, this
    //  * happen when the submit callback method returns true. This method
    //  * can/should be implemented by the subclass for a different behaviour.
    //  */
    // public function callbackSuccess()
    // {
    //     $this->di->get("response")->redirect("questions")->send();
    //     //$this->di->get("response")->redirect("questions/update/{$questions->id}");
    // }

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
