<?php

namespace Anax\View;
use \Kris3XIQ\TextFilter\MyTextFilter;

// Include essentials
require __DIR__ . "/../../src/TextFilter/config.php";
// include("../src/TextFilter/MyTextFilter.php");
// include("/../../src/TextFilter/MyTextFilter.php");

// Gather incoming variables and use default values if not set
$question = isset($question) ? $question : null;
$answers = isset($answers) ? $answers : null;
$tags = explode(",", $question->question_tags);
if (isset($comments)) {
    if (count($comments) > 0) {
        $comments = $comments[0];
    }
} else {
    $comments = $comments;
}
$user = isset($_SESSION["user"]);
?>


<?php if (!$question) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>
<?php if (!$user) : ?>
    <h2 style="text-align: center;">Log in to view the question</h2>
<?php
    return;
endif;
?>
<div class="question-answer-wrapper">
    <div class="question-question-title-wrapper">
        <h2 style="text-align: center;"><?= $question->title ?></h2>
        <div class="question-question-details-wrapper">
            <p>Asked: <?= $question->created ?></p>
            <p>Replies: <?= count($answers); ?></p>
            <p>Asked by: <a href="<?= url("user/posts/{$question->question_user}"); ?>"><?= $question->question_user?></a></p>
        </div>
    </div>
    <div class="question-question-textarea">
        <?= $question->question ?>
    </div>
    <?php foreach ($tags as $tag) : ?>
        <div class="tag-button">
            <a href="<?= url("tags/tag/{$tag}"); ?>"><p><?= $tag ?></p></a>
        </div>
    <?php endforeach; ?>
    </div>
    <?php foreach ($answers as $answer) : 
        $tags = explode(",", $answer->answer_tags);
    ?>
    <div class="question-all-wrapper">
        <div class="question-answer-answer-wrapper">
            <p><?= $answer->answer ?></p>
            <div class="details-wrapper">
                <div class="question-answer-tags-wrapper">
                    <?php foreach ($tags as $tag) : ?>
                        <div class="tag-button">
                            <a href="<?= url("tags/tag/{$tag}"); ?>"><p><?= $tag ?></p></a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="question-answer-details-wrapper">
                    <!-- <p id="question-answered-by">Answered by: <?= $answer->answer_user ?></p> -->
                    <p id="question-answered-by">Answered by: <a href="<?= url("user/posts/{$answer->answer_user}"); ?>"><?= $answer->answer_user?></a></p>
                    <p id="question-answered-at">Replied: <?= $answer->created ?></p>
                </div>
            </div>
        </div>
        <div class="question-comment-wrapper">
        <?php foreach ($comments as $comment) : ?>
            <?php if ($comment->answer_id == $answer->rowid) : ?>
                <div class="question-comment-content-wrapper">
                    <div class="question-comment-content">
                        <?= $comment->comment ?>
                    </div>
                    <div class="question-comment-details">
                        <!-- <p id="question-comment-by-user">Commented by: <?= $comment->comment_user ?></p> -->
                        <p id="question-comment-by-user">Commented by: <a href="<?= url("user/posts/{$comment->comment_user}"); ?>"><?= $comment->comment_user ?></a></p>
                        <p id="question-comment-at-time">At: <?= $comment->created ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
        <div class="comment-wrapper">
            <a href="<?= url("questions/comment/{$answer->rowid}"); ?>"><p>Add comment</p></a>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="question-answer-textarea">
        <h4>Your answer</h4>
        <?= $form ?>
    </div>
</div>
