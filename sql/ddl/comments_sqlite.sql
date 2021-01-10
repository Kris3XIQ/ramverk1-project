--
-- Table Comments
--
DROP TABLE IF EXISTS Comments;
CREATE TABLE Comments (
    "rowid" INTEGER PRIMARY KEY,
    "answer_id" INTEGER,
    "comment_user" TEXT NOT NULL,
    "comment_tags" TEXT NOT NULL,
    "comment" TEXT NOT NULL,
    "created" TIMESTAMP,
    "updated" DATETIME
);
