<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/config/database.php");

include("acorn/config/general.php");

include("acorn/global/functions.php");

include("acorn/global/SuperGlobals.php");

session_start();

if ($GLOBALS["MYSQL_CON"]->connect_error) {
    die("Failed to connect to MySQL");
}


$PathInfo = ParsePath();

switch($PathInfo['call_parts'][0]) 
{
	case 'login': include 'acorn/pages/auth/login.php'; break;
	case 'logout': include 'acorn/pages/auth/logout.php'; break;
	
	case 'account':
	
	Check_Auth_User();
  	// Check to see if user is logged in
  	// before dispatching pages
	
	switch($PathInfo['call_parts'][1])
  	{
  		case "": header("Location: " . constant("ROOT_URL") . "account/profile"); exit;
		break;
		
		case "password":
			include 'acorn/pages/account/password.php';
		break;
		
		case "profile":
			include 'acorn/pages/account/profile.php';
		break;
		
		case "sessions":
			include 'acorn/pages/account/sessions.php';
		break;
		
		case "notifications":
			include 'acorn/pages/account/notifications.php';
		break;
		
		case "two_factor":
		
				switch($PathInfo['call_parts'][2])
  				{
  				case "":
					include 'acorn/pages/account/two_factor/view_all.php';
				break;
		
				case "add":
					include 'acorn/pages/account/two_factor/add.php';
				break;
				
				default: include 'acorn/pages/errors/404.php'; break;
				}
			
		break;
		
		default: include 'acorn/pages/errors/404.php'; break;
	}
	break;

  	case 'dashboard':
  		
  		Check_Auth_User();
  		// Check to see if user is logged in
  		// before dispatching pages
  		
  		switch($PathInfo['call_parts'][1])
  		{
  			case "":
  				header("Location: " . constant("ROOT_URL") . "dashboard/bookings");
  			break;
  			case "bookings": 
  			// begin case
  				switch($PathInfo['call_parts'][2])
  				{
  				case "": include "acorn/pages/dashboard/bookings/view_all.php"; break;
  				case "view": include "acorn/pages/dashboard/bookings/view.php"; break;
  				case "delete": include "acorn/pages/dashboard/bookings/confirm_delete.php"; break;
  				case "do_delete": include "acorn/pages/dashboard/bookings/do_delete.php"; break;
  				default: include 'acorn/pages/errors/404.php';
  				}
  			break;
  			// end case
  		
  			case "calendar": 
  			// begin case
  				switch($PathInfo['call_parts'][2])
  				{
  				case "": include "acorn/pages/dashboard/calendar/calendar.php"; break;
  				case "list": include "acorn/pages/dashboard/calendar/view_all.php"; break;
  				case "view": include "acorn/pages/dashboard/calendar/view.php"; break;
  				case "add": include "acorn/pages/dashboard/calendar/add.php"; break;
  				case "delete": include "acorn/pages/dashboard/calendar/confirm_delete.php"; break;
  				case "do_delete": include "acorn/pages/dashboard/calendar/do_delete.php"; break;
  				default: include 'acorn/pages/errors/404.php';
  				}
  			break;
  			// end case
  			
  			case "clients": 
  			// begin case
  				switch($PathInfo['call_parts'][2])
  				{
  				case "": include "acorn/pages/dashboard/clients/view_all.php"; break;
  				case "view": include "acorn/pages/dashboard/clients/view.php"; break;
  				case "add": include "acorn/pages/dashboard/clients/add.php"; break;
  				case "search": include "acorn/pages/dashboard/clients/search.php"; break;
  				case "vcard": include "acorn/pages/dashboard/clients/export_vcard.php"; break;
  				case "delete": include "acorn/pages/dashboard/clients/confirm_delete.php"; break;
  				case "do_delete": include "acorn/pages/dashboard/clients/do_delete.php"; break;
  				default: include 'acorn/pages/errors/404.php';
  				}
  			break;
  			// end case
  			
  			case "services": 
  			// begin case
  				switch($PathInfo['call_parts'][2])
  				{
  				case "": include "acorn/pages/dashboard/services/view_all.php"; break;
  				case "view": include "acorn/pages/dashboard/services/view.php"; break;
  				case "edit": include "acorn/pages/dashboard/services/edit.php"; break;
  				case "add": include "acorn/pages/dashboard/services/add.php"; break;
  				case "delete": include "acorn/pages/dashboard/services/confirm_delete.php"; break;
  				case "do_delete": include "acorn/pages/dashboard/services/do_delete.php"; break;
  				default: include 'acorn/pages/errors/404.php';
  				}
  			break;
  			// end case
  			
  			
  			default: include 'acorn/pages/errors/404.php';
  		
  		}
  		
	break;
    
  case 'system':
  
  		Check_Auth_User();
  		// Check to see if user is logged in
  		// before dispatching pages
  		
  		switch($PathInfo['call_parts'][1])
  		{
  
  		case "users": 
  		// begin case
  			switch($PathInfo['call_parts'][2])
  			{
  			case "": include "acorn/pages/system/users/view_all.php"; break;
  			case "view": include "acorn/pages/system/users/view.php"; break;
  			case "add": include "acorn/pages/system/users/add.php"; break;
  			case "search": include "acorn/pages/system/users/search.php"; break;
  			case "delete": include "acorn/pages/system/users/confirm_delete.php"; break;
  			case "do_delete": include "acorn/pages/system/users/do_delete.php"; break;
  			default: include 'acorn/pages/errors/404.php';
  			}
  		break;
  		// end case
  		
  		case "backup": 
  		// begin case
  			switch($PathInfo['call_parts'][2])
  			{
  			case "": include "acorn/pages/system/backup/backup.php"; break;
  			case "do_backup": include "acorn/pages/system/backup/do_backup.php"; break;
  			case "do_restore": include "acorn/pages/system/backup/do_restore.php"; break;
  			default: include 'acorn/pages/errors/404.php';
  			}
  		break;
  		// end case
  		
  		case "email": include "acorn/pages/system/email/email.php"; break;
  		case "embed": include "acorn/pages/system/embed/embed.php"; break;
  		case "settings": include "acorn/pages/system/settings/edit.php"; break;
  		
  		default: include 'acorn/pages/errors/404.php';
  		}
  
  break;
  
  case "book":
  	include "acorn/pages/book/book.php";
  break;
  
  case "": header("Location: " . constant("ROOT_URL") . "book/"); exit; break;
  
  default: include 'acorn/pages/errors/404.php';
}