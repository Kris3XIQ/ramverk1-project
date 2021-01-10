<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;
$questions= isset($questions) ? $questions : null;
$user = isset($_SESSION["user"]);
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
<h2 style="text-align: center;">Questions tagged [<?= $tags[0]->tag ?>]</h2>
<?php foreach ($questions as $question) :
    $tags = explode(",", $question->question_tags);
    ?>
    <div class="questions-wrapper">
        <div class="question-votes-wrapper">
        <div class="question-votes-wrapper">
            <a href="<?= url("user/posts/{$question->question_user}"); ?>"><img src=<?= $question->question_user_grav ?> style="max-width: none;"></a>
        </div>
        </div>
        <div class="question-title-wrapper">
            <a href="<?= url("questions/question/{$question->id}"); ?>"> <h4><?= $question->title ?></h4></a>
            <div class="tags-wrapper">
                <?php foreach ($tags as $tag) : ?>
                    <div class="tag-button">
                        <a href="<?= url("tags/tag/{$tag}"); ?>"><p><?= $tag ?></p></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="question-user-wrapper">
            <p>Asked by: <a href="<?= url("user/posts/{$question->question_user}"); ?>"><?= $question->question_user ?></p></a>
        </div>
    </div>
<?php endforeach; ?>
