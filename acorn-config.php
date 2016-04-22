<?php defined("ACORN_EXECUTE") or die("Access Denied.");

date_default_timezone_set("UTC");
// set your timezone, see list of supported timezones:
// http://php.net/manual/en/timezones.php

define("CURRENCY_SYMBOL", "£");
// define your currency symbol

define("MASTER_SALT", "917878fdc64c0ad8eb0a47b3ba118dc8");
// generate a random md5 string unique for hashing your passwords
// use http://bit.ly/randomMD5

/*-------------------------------/*
       URLs and REDIRECTION
/*------------------------------*/

define("ROOT_URL", "/");
// Root url for css, javascript and image files.
// e.g. http://example.com/ would be /
// e.g. http://example.com/acorn/ would be /acorn/

define("HIDE_INDEX", true);
// hide /index.php/ from urls
// if set to true you must configure BASE_URL below and create a .htaccess file
// see https://github.com/whollands/Acorn/wiki/Setting-up-.htaccess

define("BASE_URL", "/");
// BASE is used for urls. change to /index.php/ if setting above is false
// e.g. http://example.com/ would be /index.php/
// e.g. http://example.com/acorn/ would be /acorn/index.php/

define("DOMAIN", "http://hollands123.com";
// define domain of the site.
// DO NOT leave a trailing forward slash at the end
// Acceptable: http://example.com
// NOT Acceptable: http://example.com/

/*-------------------------------/*
   MYSQL DATABASE CONFIGURATION
/*------------------------------*/

define("MySQL_User", "User123");
// mysql username

define("MySQL_Pass", "Pass123");
// mysql password

define("MySQL_DB", "DB123");
// mysql database name, usually your username

define("MySQL_Server", "mysql.example.com");
// mysql server address, usually "localhost"

define("DB_BACKUP_URL", "/public_html/acorn-backup/");
// base path from server, to directory where backups will be stored
