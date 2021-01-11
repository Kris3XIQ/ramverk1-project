<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",
 
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
