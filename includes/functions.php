<?php
function UploadImageFile($folder,$image){
    try 
    {
        $uploadDirectory = "../$folder/";
        $uploadURL       = $folder.'/';
        $image_file_path = "";

        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $file_ext  =    pathinfo($_FILES["$image"]['name'], PATHINFO_EXTENSION);
        $file_name = $_FILES["$image"]["name"];
        $file_tmp  = $_FILES["$image"]["tmp_name"];
        $ext       = pathinfo($file_name, PATHINFO_EXTENSION);

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif','PNG', 'jfif'])) {
            $newFileName = date("YmdHis") . "." . $file_ext;
            $uploadPath = $uploadDirectory . $newFileName;


            if (move_uploaded_file($file_tmp, $uploadPath)) {
                $image_file_path= $uploadURL . $newFileName;
            }
        }

        return $image_file_path;

    } catch (Exception $ex) {
        return "Upload Error : ".$ex->getMessage();
    }
}

function ScheduleEvent($conn,$EventDetails){
    try 
    {
        $columns = implode(", ",array_keys($EventDetails));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($EventDetails));
        $values  = implode("', '", $escaped_values);
        $AddQuery = "INSERT INTO tbl_schedule ($columns) VALUES ('$values')";
        $ExecuteQuery = mysqli_query($conn,$AddQuery) or die ("Error in query: $AddQuery. ".mysqli_error($conn));
        return "Event Scheduled.";

    } catch (Exception $ex) {
        return "Error : ".$ex->getMessage();
    }
}

function getUserRegisteredEvents($conn, $user, $event){
    $GetQuery = "SELECT * FROM tbl_register WHERE student = '$user' AND event = '$event'";
    $Results = mysqli_query($conn, $GetQuery);

    if (mysqli_num_rows($Results) > 0) {
        return true;
    } else {
        return false;
    }
}

function getAllEvents($conn){
    $GetEvents = "SELECT tbl_events.*, tbl_event_category.category_name, tbl_venue.name, tbl_venue.location, tbl_login.username FROM tbl_events INNER JOIN tbl_event_category ON tbl_events.category = tbl_event_category.id INNER JOIN tbl_venue ON tbl_events.event_venue = tbl_venue.id INNER JOIN tbl_login ON tbl_events.organizes_by = tbl_login.id WHERE tbl_events.live = 'Open' AND tbl_events.start_date > CURDATE()";

    $Results    = mysqli_query($conn,$GetEvents);
    $ListArray = array();

    if (mysqli_num_rows($Results) > 0) 
    {
        while($record = mysqli_fetch_assoc($Results)) 
        {
            $data = array();
            $data["id"]            = $record["id"];
            $data["category_name"] = $record["category_name"];
            $data["title"]         = $record["title"];
            $data["username"]      = $record["username"];
            $data["name"]          = $record["name"];
            $data["image"]         = $record["image"];
            $data["location"]      = $record["location"];
            $data["from"]          = date(" j F Y, h:i A", strtotime($record["start_date"]." ".$record["start_time"]));
            $data["to"]            = date(" j F Y, h:i A", strtotime($record["end_date"]." ".$record["end_time"]));

            $data["live"]          = $record["live"];

            array_push($ListArray,$data);

        }

    }

    return $ListArray;
}

function getYourEvents($conn, $uid){
    $GetEvents = "SELECT tbl_events.*, tbl_event_category.category_name, tbl_venue.name, tbl_venue.location, tbl_login.username FROM tbl_events INNER JOIN tbl_event_category ON tbl_events.category = tbl_event_category.id INNER JOIN tbl_venue ON tbl_events.event_venue = tbl_venue.id INNER JOIN tbl_login ON tbl_events.organizes_by = tbl_login.id INNER JOIN tbl_register ON tbl_events.id = tbl_register.event WHERE tbl_register.student ='".$uid."'";

    $Results    = mysqli_query($conn,$GetEvents);
    $ListArray = array();

    if (mysqli_num_rows($Results) > 0) 
    {
        while($record = mysqli_fetch_assoc($Results)) 
        {
            $data = array();
            $data["id"]            = $record["id"];
            $data["category_name"] = $record["category_name"];
            $data["title"]         = $record["title"];
            $data["username"]      = $record["username"];
            $data["name"]          = $record["name"];
            $data["image"]         = $record["image"];
            $data["location"]      = $record["location"];
            $data["from"]          = date(" j F Y, h:i A", strtotime($record["start_date"]." ".$record["start_time"]));
            $data["to"]            = date(" j F Y, h:i A", strtotime($record["end_date"]." ".$record["end_time"]));

            $data["live"]          = $record["live"];

            array_push($ListArray,$data);

        }

    }

    return $ListArray;
}

function getApprovalStatus($conn, $event){
    $GetQuery = "SELECT * FROM tbl_events WHERE status = 'Approved' AND id = '$event'";
    $Results = mysqli_query($conn, $GetQuery);

    if (mysqli_num_rows($Results) > 0) {
        return true;
    } else {
        return false;
    }
}

function getAvailableSeats($conn, $event){
    $RegTotal = 0;
    $RegCap   = 0;

    $GetRegisterCount = "SELECT COUNT(*) AS total FROM tbl_register WHERE tbl_register.event = '".$event."'";
    $TResults = mysqli_query($conn,$GetRegisterCount);
    if (mysqli_num_rows($TResults) > 0) 
    {
        while($data = mysqli_fetch_assoc($TResults)) 
        {
            $RegTotal       = $data["total"];
        }
    }

    $GetRegisterCapacity = "SELECT tbl_venue.capacity  FROM tbl_events
    INNER JOIN tbl_venue ON tbl_events.event_venue = tbl_venue.id 
    WHERE tbl_events.id = '".$event."'";
    $CResults = mysqli_query($conn,$GetRegisterCapacity);
    if (mysqli_num_rows($CResults) > 0) 
    {
        while($data = mysqli_fetch_assoc($CResults)) 
        {
            $RegCap       = $data["capacity"];
        }
    }

    if($RegTotal){
        return $RegCap - $RegTotal;
    }else{
        return $RegCap;
    }
    
}

function getYourProfile($conn, $uid){
    $GetEvents = "SELECT * FROM tbl_login WHERE id ='".$uid."'";

    $Results    = mysqli_query($conn,$GetEvents);
    $ListArray = array();

    if (mysqli_num_rows($Results) > 0) 
    {
        while($record = mysqli_fetch_assoc($Results)) 
        {
            $data = array();
            $data["id"]            = $record["id"];
            $data["username"]      = $record["username"];
            $data["bioid"]         = $record["bioid"];
            $data["email"]         = $record["email"];
            $data["image"]         = $record["image"];
            $data["phone"]         = $record["phone"];
            return $data;
        }

    }

}
?>