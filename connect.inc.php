<?php
	define("MYSQLDB_HOST", '127.0.0.1');
	define("MYSQLDB_USER", 'root');
	define("MYSQLDB_PASS", '');
	define("MYSQLDB", 'UrlShortener');
	if(!mysql_connect(MYSQLDB_HOST,MYSQLDB_USER,MYSQLDB_PASS) || !mysql_select_db(MYSQLDB)){
		die(mysql_error());
	}
?>
