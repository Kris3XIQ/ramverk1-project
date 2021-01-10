<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$item = isset($item) ? $item : null;

// Create urls for navigation
$urlToView = url("user/profile");

?><h1>Update account information</h1>

<?= $form ?>

</div>
