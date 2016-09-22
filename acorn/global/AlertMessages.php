<?php

/* ----------------------------------
    Pre-Configured Bootstrap
    Alert Messages
---------------------------------- */

function SuccessMessage($message)
{
	$html = "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
	$html .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
	$html .= "<i class=\"fa fa-check\"></i>&nbsp;&nbsp;&nbsp;" . $message . "</div>";
	return $html;
}

function WarningMessage($message)
{
	$html = "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">";
	$html .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
	$html .= "<i class=\"fa fa-check\"></i>&nbsp;&nbsp;&nbsp;" . $message . "</div>";
	return $html;
}

function DangerMessage($message)
{
	$html = "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">";
	$html .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
	$html .= "<i class=\"fa fa-times\"></i>&nbsp;&nbsp;&nbsp;" . $message . "</div>";
	return $html;
}

function InfoMessage($message)
{
	$html = "<div class=\"alert alert-info alert-dismissible\" role=\"alert\">";
	$html .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
	$html .= "<i class=\"fa fa-info\"></i>&nbsp;&nbsp;&nbsp;" . $message . "</div>";
	return $html;
}