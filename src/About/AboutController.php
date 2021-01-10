<?php

namespace Kris3XIQ\About;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


/**
 * A sample controller to show how a controller class can be implemented.
 */
class AboutController implements ContainerInjectableInterface
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
        $data = 
"
This website was created as the final project of the course 'ramverk1' at BTH. The project is meant to somewhat
represent a shell of what stackoverflow represent. You might notice some similarities both visually and functionally.
The entire project is built on the framework anax with some modifications. A lot of the groundwork for the forms used
on the website have firstly been scaffolded, then slightly modified to fit the content of the website.<br><br>
<b>Some basic functionality of the website:</b><br>
Home, being exactly that, a frontpage for the website. I wanted to create something lightweight, but still fulfilling
the speccs of the project, hence the most recent posts and most active user.<br>
Questions, containing all the questions in the database. Click on a user to get all the posts by the user and click on a
tag to get all the questions with the same tag, pretty straight-forward!<br>
Tags, just like questions but for all the tags existing in the database.<br>
About, as you might have figured out is this little page.<br>
Once you're logged in you can access your own profilepage by clicking your username in the navbar. Logout by clicking
the 'Logout' link in the navbar.<br><br>
That's essentially it, enjoy your stay!<br><br>
";
        $page->add("about/index", [
            "data" => $data
        ]);

        return $page->render([
            "title" => "A index page",
        ]);
    }

}
