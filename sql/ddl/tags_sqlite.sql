--
-- Tags
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "tag" TEXT NOT NULL,
    "tag_user" TEXT NOT NULL,
    "tag_question_id" TEXT NOT NULL,
    "tag_question_title" TEXT NOT NULL,
    "tag_question" TEXT NOT NULL,
    "created" TIMESTAMP,
    "updated" DATETIME
);
