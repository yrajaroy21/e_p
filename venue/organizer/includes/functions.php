<?php

function getAllVenues($conn){
    $GetAuthors = "SELECT * FROM tbl_venue";
    $Results    = mysqli_query($conn,$GetAuthors);
    $ListArray = array();

    if (mysqli_num_rows($Results) > 0) 
    {
        while($record = mysqli_fetch_assoc($Results)) 
        {
            $data = array();
            $data["id"]         = $record["id"];
            $data["name"]       = $record["name"];
            $data["location"]   = $record["location"];
            $data["floor"]      = $record["floor"];
            $data["capacity"]   = $record["capacity"];
            $data["area"]       = $record["area"];
            $data["image"]      = $record["image"];
            $data["featured"]   = $record["featured"];
            $data["status"]     = $record["status"];

            array_push($ListArray,$data);

        }

    }

    return $ListArray;
}

function getAllEventCategories($conn){
    $GetAuthors = "SELECT * FROM tbl_event_category";
    $Results    = mysqli_query($conn,$GetAuthors);
    $ListArray = array();

    if (mysqli_num_rows($Results) > 0) 
    {
        while($record = mysqli_fetch_assoc($Results)) 
        {
            $data = array();
            $data["id"]         = $record["id"];
            $data["name"]       = $record["category_name"];

            array_push($ListArray,$data);

        }

    }

    return $ListArray;
}

function getMyEvents($conn, $staff){
    $GetEvents = "SELECT * FROM tbl_events WHERE status = 'Approved' AND live IN ('Open', 'Closed') AND organizes_by = '$staff'";
    $Results    = mysqli_query($conn,$GetEvents);
    $ListArray = array();

    if (mysqli_num_rows($Results) > 0) 
    {
        while($record = mysqli_fetch_assoc($Results)) 
        {
            $data = array();
            $data["id"]         = $record["id"];
            $data["title"]      = $record["title"];

            array_push($ListArray,$data);

        }

    }

    return $ListArray;
}
?>