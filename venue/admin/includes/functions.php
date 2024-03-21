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
?>