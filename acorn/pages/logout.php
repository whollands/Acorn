<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$_SESSION["ACORN_LOGIN"] = false;

session_destroy();

header("Location: login");
exit;