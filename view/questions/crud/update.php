<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$item = isset($item) ? $item : null;

// Create urls for navigation
$urlToView = url("questions");



?><h1>Update a question</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">View all</a>
</p>
