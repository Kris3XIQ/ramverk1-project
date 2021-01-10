<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;
$top_tags = isset($top_tags) ? $top_tags : null;

?>

<?php if (!$questions) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>
<div class="home-wrapper">
    <div class="home-content">
        <h3>Welcome to Kris3XIQ</h3>
    </div>
    <div class="home-latest-questions">
        <p>Latest questions</p>
    </div>
    <?php foreach ($questions as $question) :
        $tags = explode(",", $question->question_tags);
        ?>
        <div class="questions-wrapper">
            <div class="question-votes-wrapper">
                <a href="<?= url("user/posts/{$question->question_user}"); ?>"><img src=<?= $question->question_user_grav ?>></a>
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
    </div>
    <?php if (isset($top_tags)) : ?>
        <div class="home-all-tags-wrapper">
            <div class="home-common-tags">
                <p>Top three most common tags</p>
            </div>
            <div class="tag-container">
                <p>Our most popular tag that has been used <?= $top_tags[0]->cnt ?> times.</p>
                <div class="tag-button">
                    <a href="<?= url("tags/tag/{$top_tags[0]->tag}"); ?>"><p><?= $top_tags[0]->tag ?></p></a>
                </div>
            </div>
            <?php if(isset($top_tags[1])) : ?>
                <div class="tag-container">
                    <p>Our second popular tag that has been used <?= $top_tags[1]->cnt ?> times.</p>
                    <div class="tag-button">
                        <a href="<?= url("tags/tag/{$top_tags[1]->tag}"); ?>"><p><?= $top_tags[1]->tag ?></p></a>
                    </div>
                </div>
                <?php endif;?>
            <?php if(isset($top_tags[2])) : ?>
                <div class="tag-container">
                    <p>Our third popular tag that has been used <?= $top_tags[2]->cnt ?> times.</p>
                    <div class="tag-button">
                        <a href="<?= url("tags/tag/{$top_tags[2]->tag}"); ?>"><p><?= $top_tags[2]->tag ?></p></a>
                    </div>
                </div>
            <?php endif;?>
        </div>
    <?php endif;?>
</div>
