<?php

function getAllVenuetime($conn){
    $GetAuthors = "SELECT * FROM add_event";
    $Results    = mysqli_query($conn,$GetAuthors);
    $ListArray = array();

    if (mysqli_num_rows($Results) > 0) 
    {
        while($record = mysqli_fetch_assoc($Results)) 
        {
            $data = array();
            $data["id"]         = $record["id"];
            $data["StartDate"]  = $record["StartDate"];
            $data["EndDate"]   = $record["EndDate"];
            $data["StartTime"]      = $record["StartTime"];
            $data["EndTime"]      = $record["EndTime"];
            

            array_push($ListArray,$data);

        }

    }

    return $ListArray;
}
?>