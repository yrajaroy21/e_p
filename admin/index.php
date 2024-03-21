<?php 
include("includes/header.php"); 
include("includes/functions.php"); 

$VenuesList = getAllVenues($conn);
?>

  <!-- <div class="fun-facts" style="margin-top:25px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
            <div class="row">
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="7" data-speed="1000"></h2>
                   <p class="count-text ">Venues<br>Booked</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="2750" data-speed="1000"></h2>
                  <p class="count-text ">Students<br>Registered</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="24" data-speed="1000"></h2>
                  <p class="count-text ">Total<br>Request</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <style>
   
    body {
    font-family: 'Poppins', sans-serif;
    background-color: #E0FFFF; /* Light Blue background color */
    color: #333333;
  }

  /* Change color to deep blue on hover for the .item class */
  .item {
    background-color: #E0FFFF; /* Light Blue color */
    transition: background-color 0.3s ease; /* Smooth transition */
  }

  .item:hover {
    background-color: #9B59B6; /* Deep Blue color on hover */
    color: #FFFFFF; /* Text color on hover */
  }

  .orange-button {
        background-color: orange; /* Orange button color */
        color: purple; /* Change text color to purple */
    }

    /* Change orange button text color to purple on hover */
    .orange-button:hover {
        color: #9B59B6; /* Purple text color on hover */
    }
</style>
    </style>

  <div class="properties section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>Venues</h6>
          </div>
        </div>
      </div>
      <div class="row">
          <?php                                
              foreach ($VenuesList as $value) {
                  echo ' <div class="col-lg-4 col-md-6"> <div class="item">
                  <a href="property-details.html"><img style="height:240px;" src="../'.$value['image'].'" alt=""></a>
                  <span class="category">'.$value['status'].'</span>
                  <h4><a href="#">'.$value['name'].'</a></h4>
                  <ul>
                    <li>Location: <span>'.$value['location'].'</span></li>
                    <li>Capacity: <span>'.$value['capacity'].' Seats </span></li>
                    <li>Area: <span>'.$value['area'].'</span></li>
                    <li>Floor: <span>'.$value['floor'].'</span></li>
                    <li>Featured: <span>'.$value['featured'].'</span></li>
                  </ul>
                </div>
              </div>';
              }
          ?>
      </div>
    </div>
  </div>
<div id="addVenue">
  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <form class="contact-form" id="AddVenue" style="margin-left:0px !important;" method="post" >
            <input type="hidden" name="action" value="add_venue">
            <div class="section-heading">
              <h6>| Add Venue</h6>
            </div>
            <div class="col-lg-12">
              
                <div class="row">
                  <div class="col">
                    <fieldset>
                      <label for="email">Venue Name</label>
                      <input type="text" name="getVenueName" id="getVenueName" placeholder="Venue Name" required="">
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="email">Venue Location</label>
                      <input type="text" name="getVenueLocation" id="getVenueLocation" placeholder="Venue Location" required="">
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="email">Venue Capacity</label>
                      <input type="number" name="getVenueCapacity" id="getVenueCapacity" placeholder="Venue Capacity" required="">
                    </fieldset>
                  </div>                  
                </div>
            </div>
            <div class="col-lg-12">              
                <div class="row">
                  
                  <div class="col">
                    <fieldset>
                      <label for="email">Venue Floor</label>
                      <input type="number" name="getVenueFloor" id="getVenueFloor" placeholder="Venue Floor" required="">
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="email">Area (In m2)</label>
                      <input type="number" name="getVenueArea" id="getVenueArea" placeholder="Area" required="">
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="email">Venue Image</label>
                      <input class="form-control" type="file" id="getVenueImage" name="getVenueImage" style="padding-top:11px;">
                    </fieldset>
                  </div>
                
                </div>
            </div>      
            <div class="col-lg-4">       
              <div class="row">
                <div class="col">
                  <fieldset>
                    <button type="button" id="bt_add_venue" class="orange-button">Add Venue</button>
                  </fieldset>
                </div>
                
              </div>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>
<?php include("includes/footer.php"); ?>
<script>
  document.getElementById('bt_add_venue').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get form inputs
    var venueName = document.getElementById('getVenueName').value;
    var venueLocation = document.getElementById('getVenueLocation').value;
    var venueCapacity = document.getElementById('getVenueCapacity').value;
    var venueFloor = document.getElementById('getVenueFloor').value;
    var venueArea = document.getElementById('getVenueArea').value;
    var venueImage = document.getElementById('getVenueImage').value;

    // Perform basic validation
    if (venueName.trim() === '' || venueLocation.trim() === '' || venueCapacity.trim() === '' || venueFloor.trim() === '' || venueArea.trim() === '' || venueImage.trim() === '') {
      alert('Please fill in all fields.');
      return;
    }

    // If all fields are filled, submit the form
    document.getElementById('AddVenue').submit();
  });
</script>