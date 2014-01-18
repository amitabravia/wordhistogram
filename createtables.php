<?php
require('autoload.php');
$dbh=(new NewCon('wordogram'))->getCon();
$sth=$dbh->exec("create table if not exists histogram (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		keyword STRING (200),
frequency INTEGER(20),
UNIQUE (keyword));");


?>
