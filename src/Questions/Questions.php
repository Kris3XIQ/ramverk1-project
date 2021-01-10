<?php

namespace Kris3XIQ\Questions;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Questions extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Questions";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     * @var string $question_user the user creating the question.
     * @var string $question_user_grav the users grav image.
     * @var string $question_tags the tags belonging to the question.
     * @var string $title the title of the question.
     * @var string $question the actual question.
     * @var integer $created datetime object, created. 
     * @var integer $updated datetime object, last time updated. 
     */
    public $id;
    public $question_user;
    public $question_user_grav;
    public $question_tags;
    public $title;
    public $question;
    public $created;
    public $updated;
}
