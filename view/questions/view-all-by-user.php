<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;
$answers = isset($answers) ? $answers : null;
$comments = isset($comments) ? $comments : null;
$user = isset($_SESSION["user"]);

// Create urls for navigation
$urlToCreate = url("questions/create");

?>
<?php if (!$user) : ?>
    <h2 style="text-align: center;">Log in to view all the questions</h2>
<?php
    return;
endif;
?>

<div class="questions-header">
    <a href="<?= $urlToCreate ?>">
        <div class="questions-header-button">
        Ask question
        </div>
    </a>
</div>

<?php foreach ($questions as $question) :
    $tags = explode(",", $question->question_tags);
    ?>
    <div class="questions-wrapper">
        <div class="question-votes-wrapper">
            <p> Question </p>
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
<?php foreach ($answers as $answer) :
    $tags = explode(",", $answer->answer_tags);
    ?>
    <div class="questions-wrapper">
        <div class="question-votes-wrapper">
            <p> Answer </p>
        </div>
        <div class="question-title-wrapper">
            <a href="<?= url("questions/question/{$answer->question_id}"); ?>"> <h4><?= $answer->answer ?></h4></a>
            <div class="tags-wrapper">
                <?php foreach ($tags as $tag) : ?>
                    <div class="tag-button">
                        <a href="<?= url("tags/tag/{$tag}"); ?>"><p><?= $tag ?></p></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="question-user-wrapper">
            <p>Answered by: <a href="<?= url("user/posts/{$answer->answer_user}"); ?>"><?= $answer->answer_user ?></p></a>
        </div>
    </div>
<?php endforeach; ?>
<?php foreach ($comments as $comment) :
    $tags = explode(",", $comment->comment_tags);
    ?>
    <div class="questions-wrapper">
        <div class="question-votes-wrapper">
            <p> Comment </p>
        </div>
        <div class="question-title-wrapper">
            <a href="<?= url("questions/question/{$comment->question_id}"); ?>"> <h4><?= $comment->comment ?></h4></a>
            <div class="tags-wrapper">
                <?php foreach ($tags as $tag) : ?>
                    <div class="tag-button">
                        <a href="<?= url("tags/tag/{$tag}"); ?>"><p><?= $tag ?></p></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="question-user-wrapper">
            <p>Asked by: <a href="<?= url("user/posts/{$comment->comment_user}"); ?>"><?= $comment->comment_user ?></p></a>
        </div>
    </div>
<?php endforeach; ?>
