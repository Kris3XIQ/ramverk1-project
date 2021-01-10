<?php

namespace Kris3XIQ\Questions;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Tags extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tags";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     * @var string $tag the name of the tag.
     * @var string $tag_user associate tag to user.
     * @var integer $tag_question_id associate tag to a question.
     * @var string $tag_question_title associate title to tag.
     * @var string $tag_question associate question to tag.
     * @var integer $created datetime object, first created.
     * @var integer $updated datetime object, last time updated. 
     */
    public $id;
    public $tag;
    public $tag_user;
    public $tag_question_id;
    public $tag_question_title;
    public $tag_question;
    public $created;
    public $updated;
}
