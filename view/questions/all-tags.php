<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;
$check_dupes = [];
$user = isset($_SESSION["user"]);
// Create urls for navigation
$urlToCreate = url("questions/create");
?>


<?php if (!$tags) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>
<?php if (!$user) : ?>
    <h2 style="text-align: center;">Log in to view all the tags</h2>
<?php
    return;
endif;
?>
<div class="all-tags-wrapper">
    <div class="all-tags-title-wrapper">
        <h2>All tags</h2>
    </div>
    <div class="all-tags-container">
        <?php foreach ($tags as $tag) : 
            if (!in_array($tag->tag, $check_dupes, true)){
                array_push($check_dupes, $tag->tag);
            }
            ?>
        <?php endforeach; ?>
        <?php foreach($check_dupes as $create_tag) : ?>
            <div class="tag-button">
                <a href="<?= url("tags/tag/{$create_tag}"); ?>"><p><?= $create_tag ?></p></a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="tags-new-question-header">
        <a href="<?= $urlToCreate ?>">
            <div class="tags-header-button">
                Ask a new question
            </div>
        </a>
    </div>
</div>
