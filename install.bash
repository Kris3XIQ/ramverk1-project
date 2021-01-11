#!/usr/bin/env bash
#
# Installation file for the module
#
# Automatic bash script for easy installation.
# How to:
# Stand in the root directory of your installation
# and run:
# bash install.bash

touch data/db.sqlite
sqlite3 data/db.sqlite < sql/ddl/answers_sqlite.sql
sqlite3 data/db.sqlite < sql/ddl/comments_sqlite.sql
sqlite3 data/db.sqlite < sql/ddl/questions_sqlite.sql
sqlite3 data/db.sqlite < sql/ddl/tags_sqlite.sql
sqlite3 data/db.sqlite < sql/ddl/user_sqlite.sql
rsync -av extra/ActiveRecordModel.php vendor/anax/database-active-record/src/DatabaseActiveRecord/
rm -r extra
