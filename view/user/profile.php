<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$user = isset($user) ? $user : null;

// Create urls for navigation
$urlToView = url("user/update");

?><h1>Your profile information</h1>
<div class="wrapper-user-profile">
    <div class="left-container">
        <p>Username: <?= $user->username ?></p>
        <p>Email: <?= $user->email ?></p>
    </div>
    <div class="right-container">
        <img src=<?= $user->gravatar ?>>
    </div>
    <a href="<?= url("user/update/{$user->username}"); ?>"><button>Edit your profile</button></a>
</div>
