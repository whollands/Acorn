<?php defined("ACORN_EXECUTE") or die("Access Denied.");

function CheckFailedAttempts($user_id, $mysqli) {
    // Get timestamp of current time 
    
    if ($stmt = $mysqli->prepare("SELECT UserID, DateTime FROM UserLoginAttempts WHERE UserID=?")) {
        $stmt->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}