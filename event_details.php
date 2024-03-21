<?php 
include("includes/header.php"); 
include("includes/functions.php"); 

$EventQuery = "SELECT tbl_events.*, tbl_event_category.category_name, tbl_venue.name, tbl_venue.location, tbl_login.username FROM tbl_events INNER JOIN tbl_event_category ON tbl_events.category = tbl_event_category.id INNER JOIN tbl_venue ON tbl_events.event_venue = tbl_venue.id INNER JOIN tbl_login ON tbl_events.organizes_by = tbl_login.id WHERE tbl_events.id = '" .$_GET["id"]."'";

$Results    = mysqli_query($conn,$EventQuery);
$EventArray = array();

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
        $data["resource_person_image"]          = $record["resource_person_image"];
        $data["resource_person_name"]          = $record["resource_person_name"];
        $data["resource_person_des"]          = $record["resource_person_des"];
        array_push($EventArray,$data);

    }

}

 
foreach ($EventArray as $value) 
{
    echo ' <div class="single-property ">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="main-image">
            <img src="'.$value["image"].'" style="height: 645px;" alt="">
          </div>
          <div class="main-content">
            <span class="category">'.$value["category_name"].'</span>
            <h4>'.$value["title"].'</h4>
          </div> 
        </div>
        <div class="col-lg-4">
          <div class="info-table">
            <ul>
              <li>
              <h5 style="color:#f35525;margin-bottom:10px;">Resource Person</h5>

                <img src="'.$value["resource_person_image"].'" alt="" style="max-width: 52px;">
                <h4>'.$value["resource_person_name"].'<br><span>'.$value["resource_person_des"].'</span></h4>
              </li>
              <li>
                <h5 style="color:#f35525;margin-bottom:10px;"><a href="#"  style="color:#f35525;cursor:text;">
                <i class="fa fa-map-marker"></i> Location</a></h5>

                <h4>'.$value["name"].'<br><span>'.$value["location"].'</span></h4>
              </li>
              <li>
                <h5 style="color:#f35525;margin-bottom:10px;"><a href="#"  style="color:#f35525;cursor:text;">
                <i class="fa fa-user"></i> Contact</a></h5>
                <h4>'.$value["username"].'<br><span>Event Organizer</span></h4>
              </li>
              <li>
              <h5 style="color:#f35525;margin-bottom:10px;"><a href="#"  style="color:#f35525;cursor:text;">
              <i class="fa fa-ticket"></i> Book Now</a></h5>
                <h4>'.getAvailableSeats($conn,$_GET["id"]).'<br><span>Seats Available</span></h4>
              </li>
              <li style="text-align: center;">';
                
                if($value["live"] == 'Open')
                {
                    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true)
                    { 
                        if(getUserRegisteredEvents($conn, $_SESSION["uid"],$_GET["id"]))
                        {
                            echo ' <div class="icon-button" ><a href="javascript:void(0)" style="cursor:text;"><i class="fa fa-calendar"></i> Thankyou for registering</a></div>';
                        }else{
                            echo ' <div class="icon-button" id="bt_event_register" data-eid="'.$_GET["id"].'" data-uid="'.$_SESSION["uid"].'"><a href="javascript:void(0)" ><i class="fa fa-calendar"></i> Register</a></div>';
                        }
                    }else{
                        echo '<div class="icon-button"><a href="login.php"><i class="fa fa-calendar"></i> Login to register</a></div>';
                    } 
                }else if($value["live"] == 'Close'){
                    echo '<a href="javascript:void(0)">Event Not Available</a>';
                }else{
                    echo '<a href="javascript:void(0)">Coming Soon</a>';
                }

            echo '</li></ul></div></div></div></div></div>';
    }
    
 include("includes/footer.php");
 
 ?>