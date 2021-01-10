--
-- Table Answers
--
DROP TABLE IF EXISTS Answers;
CREATE TABLE Answers (
    "rowid" INTEGER PRIMARY KEY,
    "question_id" INTEGER,
    "answer_user" TEXT NOT NULL,
    "answer_tags" TEXT NOT NULL,
    "votes" INTEGER NOT NULL,
    "answer" TEXT NOT NULL,
    "created" TIMESTAMP,
    "updated" DATETIME
    -- FOREIGN KEY (id) REFERENCES Questions (id)
    --     ON DELETE CASCADE ON UPDATE NO ACTION
);
