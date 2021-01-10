<?php

namespace Kris3XIQ\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Kris3XIQ\User\HTMLForm\CreateUserForm;
use Kris3XIQ\User\HTMLForm\UserLoginForm;
use Kris3XIQ\User\HTMLForm\UserUpdateForm;
use Kris3XIQ\Questions\Questions;
use Kris3XIQ\Questions\Answers;
use Kris3XIQ\Questions\Comments;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
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
        $username = $_SESSION["user"];
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("username", $username);

        $page->add("user/profile", [
            "user" => $user
        ]);

        return $page->render([
            "title" => "A index page",
        ]);
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $form = new UserLoginForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A login page",
        ]);
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A create user page",
        ]);
    }

    /**
     *  Profile Page
     * 
     * @return object response object.
     */
    public function profileAction() : object
    {
        $page = $this->di->get("page");
        if (isset($_SESSION["user"])) {
            $old_user = $_SESSION["user"];
            $updated_user = new UserUpdateForm();
            $updated_user->setDb($this->di->get("dbqb"));
            $updated_user-find("username", $old_user);

        };
        $user->setDb($this->di->get("dbqb"));
        
        $page->add("user/profile");

        return $page->render([
            "title" => "Your profile page"
        ]);
    }

    /**
     *  Update profile page
     * 
     * @param string $username the user to update.
     * 
     * @return object response object.
     */
    public function updateAction(string $username) : object
    {
        $page = $this->di->get("page");
        $form = new UserUpdateForm($this->di, $username);
        $form->check();

        $page->add("user/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update profile"
        ]);
    }

    /**
     * Description.
     *
     * @return void
     */
    public function logoutAction() : void
    {
        $this->di->session->delete("user");
        $this->di->get("response")->redirect("")->send();
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function postsAction(string $username) : object
    {
        $page = $this->di->get("page");
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $all_questions = $questions->findAllWhere("question_user = ?", $username);
        $answers = new Answers();
        $answers->setDb($this->di->get("dbqb"));
        $all_answers = $answers->findAllWhere("answer_user = ?", $username);
        $comments = new Comments();
        $comments->setDb($this->di->get("dbqb"));
        $all_comments = $comments->findAllWhere("comment_user = ?", $username);

        $page->add("questions/view-all-by-user", [
            "questions" => $all_questions,
            "answers" => $all_answers,
            "comments" => $all_comments,
        ]);

        return $page->render([
            "title" => "A index page",
        ]);
    }
}
