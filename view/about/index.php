<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
// $user = isset($user) ? $user : null;

// Create urls for navigation
$urlToView = url("https://github.com/Kris3XIQ/ramverk1-project");

?><h1>About the website</h1>
<div>
    <div>
        <p><?= $data ?></p>
        <p>You can find my GitHub repo for the project <a href="https://github.com/Kris3XIQ/ramverk1-project" target=_blank>here</a>
    </div>
</div>
