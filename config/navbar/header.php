<?php

/**
 * Supply the basis for the navbar as an array.
 */
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
} else {
    $user = null;
}

if (!$user) {
    return [
        // Use for styling the menu
        "wrapper" => null,
        "class" => "my-navbar rm-default rm-desktop",
     
        // Here comes the menu items
        "items" => [
            [
                "text" => "Home",
                "url" => "",
                "title" => "Homepage",
            ],
            [
                "text" => "Questions",
                "url" => "questions",
                "title" => "All questions",
            ],
            [
                "text" => "Tags",
                "url" => "tags",
                "title" => "All tags",
            ],
            [
                "text" => "About",
                "url" => "about",
                "title" => "About this webpage",
            ],
            [
                "text" => "Login",
                "url" => "user/login",
                "title" => "Login"
            ]
        ],
    ];
} else {
    return [
        // Use for styling the menu
        "wrapper" => null,
        "class" => "my-navbar rm-default rm-desktop",
     
        // Here comes the menu items
        "items" => [
            [
                "text" => "Home",
                "url" => "",
                "title" => "Homepage",
            ],
            [
                "text" => "Questions",
                "url" => "questions",
                "title" => "All questions",
            ],
            [
                "text" => "Tags",
                "url" => "tags",
                "title" => "All tags",
            ],
            [
                "text" => "About",
                "url" => "about",
                "title" => "About this webpage",
            ],
            [
                "text" => "Logout",
                "url" => "user/logout",
                "title" => "Logout"
            ],
            [
                "text" => $user,
                "url" => "user",
                "title" => "Profile page"
            ],
        ],
    ];
}

