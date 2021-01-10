<?php

namespace Kris3XIQ\Questions;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Answers extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Answers";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     * @var string $title describing the topic of the question.
     * @var string $question describing the actual question.
     * @var integer $created datetime object, date of creation.
     * @var integer $updated datetime object, last time updated. 
     */
    public $rowid;
    public $question_id;
    public $answer_user;
    public $answer_tags;
    public $votes;
    public $answer;
    public $created;
    public $updated;
}
