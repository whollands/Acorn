<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$GLOBALS["MYSQL_CON"] = new mysqli(constant("MySQL_Server"), constant("MySQL_User"), constant("MySQL_Pass"), constant("MySQL_DB"));
// mysql connection

$GLOBALS["DateTime"] = date('Y-m-d H:i:s', $_SERVER["REQUEST_TIME"]);
// date time for mysql

$GLOBALS["ClientUserAgent"] = $_SERVER["HTTP_USER_AGENT"];
// get user agent, danger! needs filtering

$GLOBALS["ClientIP"] = $_SERVER["REMOTE_ADDR"];
// get ip, danger! needs filtering