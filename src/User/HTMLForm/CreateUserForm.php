<?php

namespace Kris3XIQ\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Kris3XIQ\User\User;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
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
                "legend" => "Create user",
            ],
            [
                "username" => [
                    "type"        => "text",
                ],

                "email" => [
                    "type"        => "text",
                ],
        
                "password" => [
                    "type"        => "password",
                ],
        
                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],
        
                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $username      = $this->form->value("username");
        $email         = $this->form->value("email");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");

        // Check password matches
        if ($password !== $passwordAgain ) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $check = $user->find("username", $username);
        // Check if $username is taken already or not.
        if (isset($check->username)) {
            // If yes, then let the user know and prompt a rename.
            $this->form->addOutput("A user with that username already exist!");
            return false;
        } else {
            // If no, save the new user to the database.
            $user->username = $username;
            $user->setPassword($password);
            $user->email = $email;
            $gravatar = $user->gravatarEmail($email);
            $this->di->get("session")->set("grav", $gravatar);
            $user->gravatar = $gravatar;
            $user->save();
        }

        // Login the newly created account and redirect to homepage.
        $this->di->get("session")->set("user", $username);
        $this->di->get("session")->set("grav", $gravatar);
        $this->di->get("response")->redirect("")->send();
    }
}
