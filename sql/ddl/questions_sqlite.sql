--
-- Creating a sample table.
--



--
-- Table Questions
--
DROP TABLE IF EXISTS Questions;
CREATE TABLE Questions (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "question_user" TEXT NOT NULL,
    "question_user_grav" TEXT,
    "question_tags" TEXT NOT NULL,
    "title" TEXT NOT NULL,
    "question" TEXT NOT NULL,
    "created" TIMESTAMP,
    "updated" DATETIME
);
