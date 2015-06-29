<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$ClientID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT * FROM Clients WHERE ClientID='$ClientID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	

if($Result->num_rows >= 1)
{

$row = $Result->fetch_assoc();	

header('Content-Type: text/x-vcard');  
header('Content-Disposition: inline; filename= "'.$row["Name"].'.vcf"');
header('Content-Description: File Transfer');


$BothNames = explode(" ",$row["Name"], 1);
	
?>BEGIN:VCARD\n
VERSION:3.0\n
N:<?php echo $row["Name"]; ?>\n
FN:<?php echo $row["Name"]; ?>\n
TEL;HOME;VOICE:<?php echo str_replace(" ", "-", $row["Phone"]); ?>\n
EMAIL;PREF;INTERNET:<?php echo $row["Email"]; ?>\n
NOTE:<?php echo $row["Notes"]; ?>\n
REV:20080424T195243Z\n
END:VCARD<?php

}
else
{

echo "Error: Client does not exist!";

}