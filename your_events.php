<?php 
include("includes/header.php"); 
include("includes/functions.php"); 


$EventsList = getYourEvents($conn, $_SESSION["uid"]);

?>

  <div class="properties section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>Your Events</h6>
            <!-- <h2>We Provide The Best Events You Like</h2> -->
          </div>
        </div>
      </div>
      <div class="row">
          <?php        
              foreach ($EventsList as $value) 
              {
                  echo '<div class="col-lg-4 col-md-6">
                  <div class="item">
                    <a  href="event_details.php?id='.$value["id"].'"><img style="height: 220px;" src="'.$value["image"].'" alt=""></a>
                    
                    <h6>'.getAvailableSeats($conn,$value["id"]).' Seats</h6>
                    <h4><a  href="event_details.php?id='.$value["id"].'">'.$value["title"].'</a></h4>
                    <ul>
                      <li>Venue: <span>'.$value["name"].'</span></li>
                      <li>Location: <span>'.$value["location"].'</span></li>
                      <li>Organizer: <span>'.$value["username"].'</span></li>
                      <li>From: <span>'.$value["from"].'</span></li>
                      <li>To: <span>'.$value["to"].'</span></li>
                    </ul>
                    

                    <div class="main-button">';

                    if($value["live"] == 'Open')
                    {
                      if(getUserRegisteredEvents($conn, $_SESSION["uid"],$value["id"]))
                      {
                          echo '<a href="event_details.php?id='.$value["id"].'">Thankyou for registering</a>';
                      }else{
                          echo '<a href="event_details.php?id='.$value["id"].'">Register</a>';

                      }
                    }else{
                      echo '<a href="#">Coming Soon</a>';
                    }
                      
                    echo '</div></div></div>';
              }
          ?>
        
       
      </div>
    </div>
  </div>

  

<?php include("includes/footer.php"); ?>