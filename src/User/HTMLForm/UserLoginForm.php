<?php

namespace Kris3XIQ\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Kris3XIQ\User\User;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
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
                "legend" => "User Login"
            ],
            [
                "username" => [
                    "type"        => "text",
                ],
                        
                "password" => [
                    "type"        => "password",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],
                "create" => [
                    "type" => "submit",
                    "value" => "Create new account",
                    "callback" => [$this, "callbackCreateAccount"]
                ]
            ]
        );
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean false if something went wrong, redirect if successful.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $username      = $this->form->value("username");
        $password      = $this->form->value("password");

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->verifyPassword($username, $password);
        $account = $user->find("username", $username);
        $gravatar = $account->gravatar;

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("User or password did not match.");
            return false;
        }

        // Login account and redirect to homepage.
        $this->di->get("session")->set("user", $username);
        $this->di->get("session")->set("grav", $gravatar);
        $this->di->get("response")->redirect("")->send();
    }

    /**
     * Callback for create-button which should redirect the user
     * to the create an account page.
     *
     * @return void
     */
    public function callbackCreateAccount()
    {
        // Redirect the user to user/create.
        $this->di->get("response")->redirect("user/create")->send();
    }
}
