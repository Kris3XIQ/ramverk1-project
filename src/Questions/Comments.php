<?php

namespace Kris3XIQ\Questions;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Comments extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comments";

    /**
     * Columns in the table.
     *
     * @var integer $rowid primary key auto incremented.
     * @var string $answer_id id of the answer.
     * @var string $comment_user associate comment to user.
     * @var integer $comment_tags associate comment to a answer.
     * @var string $comment the actual comment.
     * @var integer $created datetime object, first created.
     * @var integer $updated datetime object, last time updated. 
     */
    public $rowid;
    public $answer_id;
    public $comment_user;
    public $comment_tags;
    public $comment;
    public $created;
    public $updated;
}
