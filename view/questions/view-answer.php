<?php

namespace Anax\View;
use \Kris3XIQ\TextFilter\MyTextFilter;

// Include essentials
// require __DIR__ . "/../../src/TextFilter/config.php";
// include("../src/TextFilter/MyTextFilter.php");

// Gather incoming variables and use default values if not set
$question = isset($question) ? $question : null;
$answers = isset($answers) ? $answers : null;
$user = isset($_SESSION["user"]);
?>
<?php if (!$user) : ?>
    <h2 style="text-align: center;">Log in to view the answer</h2>
<?php
    return;
endif;
?>

<div class="question-answer-wrapper">
    <div class="question-question-title-wrapper">
        <div class="question-question-details-wrapper">
            <!-- <p>Asked: <?= $question->created ?></p>
            <p>Replies: <?= count($answers); ?></p>
            <p>Asked by: <?= $question->question_user ?></p> -->
        </div>
    </div>
    <?php foreach ($answers as $answer) : 
        $tags = explode(",", $answer->answer_tags);
    ?>
        <div class="question-answer-answer-wrapper">
            <p><?= $answer->answer ?></p>
            <div class="question-answer-details-wrapper">
                <div class="comment-wrapper">
                    <a href="<?= url("questions/question/{$answer->question_id}"); ?>"><p>Back to question</p></a>
                </div>
                <?php foreach ($tags as $tag) : ?>
                    <div class="tag-button">
                        <a href="<?= url("tags/tag/{$tag}"); ?>"><p><?= $tag ?></p></a>
                    </div>
                <?php endforeach; ?>
                <div class="question-answer-details">
                    <p id="question-answered-by">Answered by: <?= $answer->answer_user ?></p>
                    <p id="question-answered-at">Replied: <?= $answer->created ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="question-answer-textarea">
        <h4>Your comment</h4>
        <?= $form ?>
    </div>
</div>
