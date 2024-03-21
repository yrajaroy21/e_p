<?php
include "../includes/config.php";
include "../includes/functions.php";

$ResponseArray 	= 	array();
$ErrorResponse  =    "";
$Action			=	stripslashes(trim($_REQUEST["action"]));
$HtmlContent    =    "";
if(isset($Action) && $Action == "login"){
    try {
        if(empty($_REQUEST['email']) || empty($_REQUEST['password'])) {
            $ResponseArray["status"] = "400";
            $ResponseArray["message"] = "Please fill out all the fields.";
        } else {
            $email = addslashes((trim($_REQUEST['email'])));
            $password = addslashes((trim($_REQUEST['password'])));

            $CheckUserQuery = "SELECT * FROM tbl_login WHERE email = '$email' AND password = '$password'";
            $CheckUserQueryResults = mysqli_query($conn,$CheckUserQuery);

            if (mysqli_num_rows($CheckUserQueryResults) > 0) {
                while($record = mysqli_fetch_assoc($CheckUserQueryResults)) {
                    $_SESSION["logged_in"] = true;
                    $_SESSION["uid"] = $record["id"];
                    $_SESSION["username"] = $record["username"];
                    $_SESSION["useremail"] = $record["email"];
                    $_SESSION["usertype"] = $record["type"];
                }
                $ResponseArray["status"] = "200";
                $ResponseArray["message"] = "Login Successful.";
            } else {
                $ResponseArray["status"] = "300";
                $ResponseArray["message"] = "Incorrect username or password.";
            }
        }
    } catch (Exception $ex) {
        $ResponseArray["status"] = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }

    // Send the JSON response only if status is not 200
    if ($ResponseArray["status"] !== "200") {
        echo json_encode($ResponseArray);
    }
}




else if(isset($Action) && $Action == "register"){

    try {
        $email	    = addslashes((trim($_REQUEST['regemail'])));
        $password	= addslashes((trim($_REQUEST['regPassword'])));
        $username	    = addslashes((trim($_REQUEST['regname'])));
        $phone	    = addslashes((trim($_REQUEST['regPhone_Number'])));

        $LoginArray = array();
        $LoginArray["email"]         = $email;
        $LoginArray["password"]      = $password;
        $LoginArray["username"]      = $username;
        $LoginArray["phone"]         = $phone;
        $LoginArray["type"]          = "Student";
        $LoginArray["status"]        = "Active";


        $columns = implode(", ",array_keys($LoginArray));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($LoginArray));
        $values  = implode("', '", $escaped_values);
        $AddNewUserQuery = "INSERT INTO tbl_login ($columns) VALUES ('$values')";
        $ExecuteAddNewUserQuery = mysqli_query($conn,$AddNewUserQuery) or die ("Error in query: $AddNewUserQuery. ".mysqli_error($conn));
        
        $ResponseArray["status"]  = "200";
        $ResponseArray["message"] = "Registration Successfull.";

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
   
}else if(isset($Action) && $Action == "admin"){

    try {

        $email		= addslashes((trim($_REQUEST['adminemail'])));
        $password	= addslashes((trim($_REQUEST['adminpassword'])));

        $CheckUserQuery = "SELECT * FROM tbl_login WHERE email = '$email' AND password = '$password'";
        $CheckUserQueryResults = mysqli_query($conn,$CheckUserQuery);

        if (mysqli_num_rows($CheckUserQueryResults) > 0) 
        {
            while($record = mysqli_fetch_assoc($CheckUserQueryResults)) 
            {
                
                $_SESSION["admin_logged_in"] = true;
                $_SESSION["aid"]       = $record["id"];
                $_SESSION["adminname"]  = $record["username"];
                $_SESSION["adminemail"] = $record["email"];
                $_SESSION["usertype"]  = $record["type"];

            }

            $ResponseArray["status"]  = "200";
            $ResponseArray["message"] = "Admin Login Successfull.";
        } else {
            $ResponseArray["status"]  = "300";
            $ResponseArray["message"] = "Incorrect username or password.";
        }

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
   
}else if(isset($Action) && $Action == "organizer"){

    try {

        $email		= addslashes((trim($_REQUEST['organizeremail'])));
        $password	= addslashes((trim($_REQUEST['organizerpassword'])));

        $CheckUserQuery = "SELECT * FROM tbl_login WHERE email = '$email' AND password = '$password'";
        $CheckUserQueryResults = mysqli_query($conn,$CheckUserQuery);

        if (mysqli_num_rows($CheckUserQueryResults) > 0) 
        {
            while($record = mysqli_fetch_assoc($CheckUserQueryResults)) 
            {
                if($record["status"] == "Reset"){
                    $ResponseArray["cstatus"]  = $record["status"];
                    $ResponseArray["qid"]  = $record["id"];
                    $ResponseArray["message"] = "You have been redirected to reset your password.";
                }else if($record["status"] == "Blocked"){
                    $ResponseArray["cstatus"]  = $record["status"];
                    $ResponseArray["message"] = "Your account has been blocked by admin. Please contact admin for more information.";
                }else{
                    $ResponseArray["cstatus"]  = $record["status"];
                    $_SESSION["organizer_logged_in"] = true;
                    $_SESSION["qid"]       = $record["id"];
                    $_SESSION["organizername"]  = $record["username"];
                    $_SESSION["organizeremail"] = $record["email"];
                    $_SESSION["usertype"]  = $record["type"];
                    $ResponseArray["message"] = "Organizer Login Successfull.";
                }
               

            }

            $ResponseArray["status"]  = "200";
        } else {
            $ResponseArray["status"]  = "300";
            $ResponseArray["message"] = "Incorrect username or password.";
        }

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
   
}else if(isset($Action) && $Action == "resetpassword"){

    try {

        $id		= addslashes((trim($_REQUEST['qid'])));
        $password	= addslashes((trim($_REQUEST['password'])));

        $Query = "UPDATE tbl_login SET password = '$password', status = 'Active' WHERE id = $id";
        $Results = mysqli_query($conn,$Query);

        $ResponseArray["status"]  = "200";
        $ResponseArray["message"] = "Password Updated.";

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
   
}else if(isset($Action) && $Action == "add_venue"){
    try {
        // Sanitize and retrieve form data
        $name       = addslashes((trim($_REQUEST['getVenueName'])));
        $location   = addslashes((trim($_REQUEST['getVenueLocation'])));
        $floor      = addslashes((trim($_REQUEST['getVenueFloor'])));
        $capacity   = addslashes((trim($_REQUEST['getVenueCapacity'])));
        $area       = addslashes((trim($_REQUEST['getVenueArea'])));
        
        // Check for empty fields
        if (empty($name) || empty($location) || empty($floor) || empty($capacity) || empty($area)) {
            // Handle error, return error response, or redirect back to the form with an error message
            $ResponseArray["status"] = "400";
            $ResponseArray["message"] = "All fields are required.";
            // Optionally, you can exit the script here to prevent further execution
            exit();
        }

        // Your image upload logic here
        
        // Upload image
        $uploadDirectory = '../uploads/';
        $uploadURL       = 'uploads/';
        $image_file_path = "";

        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $file_name = $_FILES["getVenueImage"]["name"];
        $file_tmp  = $_FILES["getVenueImage"]["tmp_name"];
        $ext       = pathinfo($file_name, PATHINFO_EXTENSION);

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif','PNG', 'jfif'])) {
            $newFileName = uniqid('book') . $file_name;
            $uploadPath = $uploadDirectory . $newFileName;

            if (move_uploaded_file($file_tmp, $uploadPath)) {
                $image_file_path = $uploadURL . $newFileName;
            }
        }


        // Prepare data for insertion into the database
        $VenueArray = array(
            "name"     => $name,
            "location" => $location,
            "floor"    => $floor,
            "capacity" => $capacity,
            "area"     => $area,
            "image"    => $image_file_path,
            "featured" => 'NO',
            "status"   => 'Available'
        );

        // Insert data into the database
        $columns = implode(", ", array_keys($VenueArray));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($VenueArray));
        $values = implode("', '", $escaped_values);
        $AddQuery = "INSERT INTO tbl_venue ($columns) VALUES ('$values')";
        $ExecuteQuery = mysqli_query($conn, $AddQuery) or die("Error in query: $AddQuery. " . mysqli_error($conn));

        // Provide success response
        $ResponseArray["status"] = "200";
        $ResponseArray["message"] = "Venue Added.";
    } catch (Exception $ex) {
        // Provide error response
        $ResponseArray["status"] = "500";
        $ResponseArray["message"] = $ex->getMessage();
    }
}else if(isset($Action) && $Action == "list_organizers"){
    try {

        $Query = "SELECT * FROM tbl_login WHERE type ='Staff'";
        $Results = mysqli_query($conn,$Query);

        $ListArray = array();

        if (mysqli_num_rows($Results) > 0) 
        {
            while($record = mysqli_fetch_assoc($Results)) 
            {
                $data = array();
                $data["id"]         = $record["id"];
                $data["bioid"]      = $record["bioid"];
                $data["username"]   = $record["username"];
                $data["email"]      = $record["email"];
                $data["status"]     = $record["status"];

                array_push($ResponseArray,$data);
    
            }
    
        }

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else if(isset($Action) && $Action == "add_event"){
    try {

        $getEventCategory	            = addslashes((trim($_REQUEST['getEventCategory'])));
        $getEventName	                = addslashes((trim($_REQUEST['getEventName'])));
        $getResourcePersonName	        = addslashes((trim($_REQUEST['getResourcePersonName'])));
        $getResourcePersonDesignation	= addslashes((trim($_REQUEST['getResourcePersonDesignation'])));
        $getChooseVenue	                = addslashes((trim($_REQUEST['getChooseVenue'])));
        $getStartDate	                = addslashes((trim($_REQUEST['getStartDate'])));
        $getStartTime	                = addslashes((trim($_REQUEST['getStartTime'])));
        $getEndDate	                    = addslashes((trim($_REQUEST['getEndDate'])));
        $getEndTime	                    = addslashes((trim($_REQUEST['getEndTime'])));
        $getOrganizer	                = addslashes((trim($_REQUEST['getOrganizer'])));
   
        $EventImagePath         = UploadImageFile("uploads", "getEventImage");
        $ResorcePersonImagePath = UploadImageFile("uploads", "getResourcePersonImage");

        $EventArray = array();
        $EventArray["category"]                 = $getEventCategory;
        $EventArray["title"]                    = $getEventName;
        $EventArray["image"]                    = $EventImagePath;
        $EventArray["resource_person_name"]     = $getResourcePersonName;
        $EventArray["resource_person_des"]      = $getResourcePersonDesignation;
        $EventArray["resource_person_image"]    = $ResorcePersonImagePath;
        $EventArray["event_venue"]              = $getChooseVenue;
        $EventArray["start_date"]               = date("Y-m-d", strtotime($getStartDate));
        $EventArray["start_time"]               = $getStartTime;
        $EventArray["end_date"]                 = date("Y-m-d", strtotime($getEndDate));
        $EventArray["end_time"]                 = $getEndTime;
        $EventArray["organizes_by"]             = $getOrganizer;
        $EventArray["created_on"]               = date("Y-m-d H:i:s");


        $columns = implode(", ",array_keys($EventArray));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($EventArray));
        $values  = implode("', '", $escaped_values);
        $AddQuery = "INSERT INTO tbl_events ($columns) VALUES ('$values')";
        $ExecuteQuery = mysqli_query($conn,$AddQuery) or die ("Error in query: $AddQuery. ".mysqli_error($conn));
        
        
        $ScheduleEventArray = array();
    
        $ScheduleEventArray["event"]                    = mysqli_insert_id($conn);
        $ScheduleEventArray["venue"]                    = $getChooseVenue;
        $ScheduleEventArray["start_date"]               = date("Y-m-d", strtotime($getStartDate));
        $ScheduleEventArray["start_time"]               = $getStartTime;
        $ScheduleEventArray["end_date"]                 = date("Y-m-d", strtotime($getEndDate));
        $ScheduleEventArray["end_time"]                 = $getEndTime;
        $ScheduleEventArray["organizer"]                = $getOrganizer;


        $start      = strtotime($getStartTime);
        $end        = strtotime($getEndTime);
        $difference = round(abs($end - $start) / 3600,2);
        
        if($difference >= 7)
        {
            $ScheduleEventArray["status"]                = '1';
        }
        
        // ScheduleEvent($conn, $ScheduleEventArray);

        $ResponseArray["status"]  = "200";
        $ResponseArray["message"] = "Event Added.";

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else if(isset($Action) && $Action == "event_schedules"){
    try {
        $type = "";
        $value = "";

        if (isset($_REQUEST['type'])) {
            $type      = addslashes((trim($_REQUEST['type'])));
        }

        if (isset($_REQUEST['value'])) {
            $value     = addslashes((trim($_REQUEST['value'])));
        }

        $getVenue  = addslashes((trim($_REQUEST['venue'])));
        $ListArray = array();
        
        $CheckVenue      = "";
        $GetVenueResults = "";

        if($type == "start_time"){
            $CheckVenue = "SELECT * FROM tbl_schedule WHERE venue = '$getVenue' AND date(start_date) = '$value' ";
            $GetVenueResults = mysqli_query($conn,$CheckVenue);
        }else if($type == "end_time"){
            $CheckVenue = "SELECT * FROM tbl_schedule WHERE venue = '$getVenue' AND date(end_date) = '$value' ";
            $GetVenueResults = mysqli_query($conn,$CheckVenue);
        }else if($type == "end_date"){
            $CheckVenue = "SELECT * FROM tbl_schedule WHERE venue = '$getVenue'";
            $GetVenueResults = mysqli_query($conn,$CheckVenue);
        }else{
            $CheckVenue = "SELECT * FROM tbl_schedule WHERE venue = '$getVenue'";
            $GetVenueResults = mysqli_query($conn,$CheckVenue);
        }
        

        if (mysqli_num_rows($GetVenueResults) > 0) 
        {   
            $ResponseArray["status"]  = "200";

            while($record = mysqli_fetch_assoc($GetVenueResults)) 
            {
                $DataArray = array();

                $DataArray["event"]       = $record["event"];
                $DataArray["venue"]       = $record["venue"];
                $DataArray["start_date"]  = $record["start_date"];
                $DataArray["start_time"]  = date("H:i", strtotime($record["start_time"]));
                $DataArray["end_date"]    = $record["end_date"];
                $DataArray["end_time"]    = date("H:i", strtotime($record["end_time"]));
                $DataArray["organizer"]   = $record["organizer"];
                $DataArray["status"]      = $record["status"];

                array_push($ListArray, $DataArray);

            }

            $ResponseArray["data"]  = $ListArray;

        }else{
            $ResponseArray["status"]  = "300";

        }


    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
    }
}else if(isset($Action) && $Action == "edit_organizers"){
    try {
        $id	            = addslashes((trim($_REQUEST['id'])));
        $status	            = addslashes((trim($_REQUEST['status'])));

        $Query = "UPDATE tbl_login SET status = '$status' WHERE id = '$id'";
        $Results = mysqli_query($conn,$Query);
       
        
        $ResponseArray["status"]  = "200";
        $ResponseArray["message"] = "Details Updated.";

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else if(isset($Action) && $Action == "add_organizers"){
    try {
        $bioid	            = addslashes((trim($_REQUEST['bioid'])));
        $username	        = addslashes((trim($_REQUEST['username'])));
        $email	            = addslashes((trim($_REQUEST['email'])));

        $LoginArray = array();
        $LoginArray["bioid"]         = $bioid;
        $LoginArray["username"]      = $username;
        $LoginArray["email"]         = $email;
        $LoginArray["type"]          = "Staff";
        $LoginArray["status"]        = "Reset";

        $columns = implode(", ",array_keys($LoginArray));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($LoginArray));
        $values  = implode("', '", $escaped_values);
        $AddNewUserQuery = "INSERT INTO tbl_login ($columns) VALUES ('$values')";
        $ExecuteAddNewUserQuery = mysqli_query($conn,$AddNewUserQuery) or die ("Error in query: $AddNewUserQuery. ".mysqli_error($conn));
        
        
        $ResponseArray["status"]  = "200";
        $ResponseArray["message"] = "Details Updated.";

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
    }
}else if(isset($Action) && $Action == "list_request"){
    try {

        $Query = "SELECT * FROM tbl_events WHERE status IN ('Requested', 'OnProgress', 'Denied', 'OnHold', 'Approved')";
        $Results = mysqli_query($conn,$Query);

        $ListArray = array();

        if (mysqli_num_rows($Results) > 0) 
        {
            while($record = mysqli_fetch_assoc($Results)) 
            {
                $data = array();
                $data["id"]                        = $record["id"];
                $data["title"]                     = $record["title"];
                $data["resource_person_name"]      = $record["resource_person_name"];
                $data["resource_person_des"]       = $record["resource_person_des"];
                $data["start_date"]                = $record["start_date"];
                $data["start_time"]                = $record["start_time"];
                $data["end_date"]                  = $record["end_date"];
                $data["end_time"]                  = $record["end_time"];
                $data["status"]                    = $record["status"];

                $GetVenueQuery = "SELECT * FROM tbl_venue WHERE id ='".$record["event_venue"]."'";
                $VenueResults = mysqli_query($conn,$GetVenueQuery);
                if (mysqli_num_rows($VenueResults) > 0) 
                {
                    while($venue = mysqli_fetch_assoc($VenueResults)) 
                    {
                        $data["venue"]        = $venue["name"];
                    }
                }

                $GetCategoryQuery = "SELECT * FROM tbl_event_category WHERE id ='".$record["category"]."'";
                $CategoryResults = mysqli_query($conn,$GetCategoryQuery);
                if (mysqli_num_rows($CategoryResults) > 0) 
                {
                    while($category = mysqli_fetch_assoc($CategoryResults)) 
                    {
                        $data["category"]        = $category["category_name"];
                    }

                }

                $GetStaffQuery = "SELECT * FROM tbl_login WHERE id ='".$record["organizes_by"]."'";
                $StaffResults = mysqli_query($conn,$GetStaffQuery);
                if (mysqli_num_rows($StaffResults) > 0) 
                {
                    while($staff = mysqli_fetch_assoc($StaffResults)) 
                    {
                        $data["organizer"]        = $staff["username"];
                    }

                }
                
                array_push($ResponseArray,$data);
    
            }
    
        }

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else if(isset($Action) && $Action == "edit_request"){
    try {
        $id	            = addslashes((trim($_REQUEST['id'])));
        $status	        = addslashes((trim($_REQUEST['status'])));

        $Query = "UPDATE tbl_events SET status = '$status' WHERE id = '$id'";
        $Results = mysqli_query($conn,$Query);
       
        if($status == "Approved"){


            $ScheduleEventArray = array();
    
            $GetEventQuery = "SELECT * FROM tbl_events WHERE id ='$id'";
            $EventResults = mysqli_query($conn,$GetEventQuery);
            if (mysqli_num_rows($EventResults) > 0) 
            {
                while($event = mysqli_fetch_assoc($EventResults)) 
                {
                    $ScheduleEventArray["event"]                    = $event["id"];
                    $ScheduleEventArray["venue"]                    = $event["event_venue"];
                    $ScheduleEventArray["start_date"]               = date("Y-m-d", strtotime($event["start_date"]));
                    $ScheduleEventArray["start_time"]               = date("H:i", strtotime($event["start_time"]));
                    $ScheduleEventArray["end_date"]                 = date("Y-m-d", strtotime($event["end_date"]));
                    $ScheduleEventArray["end_time"]                 = date("H:i", strtotime($event["end_time"]));
                    $ScheduleEventArray["organizer"]                = $event["organizes_by"];

                    $start      = strtotime($event["start_time"]);
                    $end        = strtotime($event["end_time"]);
                    $difference = round(abs($end - $start) / 3600,2);
                    
                    if($difference >= 7)
                    {
                        $ScheduleEventArray["status"]                = '1';
                    }

                    
        
                }
            }
    
           

            ScheduleEvent($conn, $ScheduleEventArray);

        }
        
        $ResponseArray["status"]  = "200";
        $ResponseArray["message"] = "Request Updated.";

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else if(isset($Action) && $Action == "list_history"){
    try {
        $id	            = addslashes((trim($_REQUEST['staff'])));

        $Query = "SELECT * FROM tbl_events WHERE organizes_by ='$id'";
        $Results = mysqli_query($conn,$Query);

        $ListArray = array();

        if (mysqli_num_rows($Results) > 0) 
        {
            while($record = mysqli_fetch_assoc($Results)) 
            {
                $data = array();
                $data["id"]                        = $record["id"];
                $data["title"]                     = $record["title"];
                $data["resource_person_name"]      = $record["resource_person_name"];
                $data["resource_person_des"]       = $record["resource_person_des"];
                $data["start_date"]                = $record["start_date"];
                $data["start_time"]                = $record["start_time"];
                $data["end_date"]                  = $record["end_date"];
                $data["end_time"]                  = $record["end_time"];
                $data["status"]                    = $record["status"];
                $data["live"]                      = $record["live"];

                $GetVenueQuery = "SELECT * FROM tbl_venue WHERE id ='".$record["event_venue"]."'";
                $VenueResults = mysqli_query($conn,$GetVenueQuery);
                if (mysqli_num_rows($VenueResults) > 0) 
                {
                    while($venue = mysqli_fetch_assoc($VenueResults)) 
                    {
                        $data["venue"]        = $venue["name"];
                    }
                }

                $GetCategoryQuery = "SELECT * FROM tbl_event_category WHERE id ='".$record["category"]."'";
                $CategoryResults = mysqli_query($conn,$GetCategoryQuery);
                if (mysqli_num_rows($CategoryResults) > 0) 
                {
                    while($category = mysqli_fetch_assoc($CategoryResults)) 
                    {
                        $data["category"]        = $category["category_name"];
                    }

                }
                
                array_push($ResponseArray,$data);
    
            }
    
        }

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else if(isset($Action) && $Action == "event_register"){

    try {
        $eid	    = addslashes((trim($_REQUEST['eid'])));
        $uid    	= addslashes((trim($_REQUEST['uid'])));

        $ERArray = array();
        $ERArray["student"]         = $uid;
        $ERArray["event"]           = $eid;
        $ERArray["created_on"]      = date("Y-m-d H:i:s");


        $columns = implode(", ",array_keys($ERArray));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($ERArray));
        $values  = implode("', '", $escaped_values);
        $Query = "INSERT INTO tbl_register ($columns) VALUES ('$values')";
        $Execute = mysqli_query($conn,$Query) or die ("Error in query: $Query. ".mysqli_error($conn));
        
        $ResponseArray["status"]  = "200";
        $ResponseArray["message"] = "Thankyou for registering.";

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
    }
   
}else if(isset($Action) && $Action == "live_requests"){
    try {
        $id	            = addslashes((trim($_REQUEST['id'])));
        $live	            = addslashes((trim($_REQUEST['live'])));

        if(getApprovalStatus($conn, $id))
        {
            $Query = "UPDATE tbl_events SET live = '$live' WHERE id = '$id'";
            $Results = mysqli_query($conn,$Query);

            $ResponseArray["status"]  = "200";
            $ResponseArray["message"] = "Request Updated.";
        }else{
            $ResponseArray["status"]  = "300";
            $ResponseArray["message"] = "Event is not approved, Please contact admin for more info.";
        }
      
       
       
        
     

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else if(isset($Action) && $Action == "update_profile"){
    try {
        $id	            = addslashes((trim($_REQUEST['id'])));
        $username	    = addslashes((trim($_REQUEST['profile_username'])));
        $email	        = addslashes((trim($_REQUEST['profile_email'])));
        $phone	        = addslashes((trim($_REQUEST['profile_phone'])));

        $Query = "UPDATE tbl_login SET username = '$username', email = '$email', phone = '$phone' WHERE id = '$id'";
        $Results = mysqli_query($conn,$Query);

       

        $ResponseArray["status"]  = "200";
        $ResponseArray["message"] = "Profile Updated.";
        
     

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else if(isset($Action) && $Action == "list_registrations"){
    try {

        $eid	    = addslashes((trim($_REQUEST['eid'])));
 

        $Query = "SELECT tbl_login.* FROM tbl_login INNER JOIN tbl_register ON tbl_register.event = '$eid' WHERE tbl_login.type = 'Student'";
        $Results = mysqli_query($conn,$Query);

        $ListArray = array();

        if (mysqli_num_rows($Results) > 0) 
        {
            while($record = mysqli_fetch_assoc($Results)) 
            {
                $data = array();
                $data["id"]                        = $record["id"];
                $data["username"]                     = $record["username"];
                $data["email"]      = $record["email"];
                $data["phone"]       = $record["phone"];
                
                
                array_push($ResponseArray,$data);
    
            }
    
        }

    } catch (Exception $ex) {
        $ResponseArray["status"]  = "500";
        $ResponseArray["message"] = $ex->getMessage();
        // echo $ex->getMessage();
    }
}else{
    $ResponseArray["status"]  = "404";
    $ResponseArray["message"] = "Invalid Action.";
}

$Response	=	json_encode($ResponseArray, true);

echo $Response;
exit;
?>