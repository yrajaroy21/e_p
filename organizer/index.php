<?php 
include("includes/header.php"); 
include("includes/functions.php"); 
$VenuesList = getAllVenues($conn);
$EventCategories = getAllEventCategories($conn);

?>



  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <form class="contact-form" id="AddEvent" style="margin-left:0px !important;" enctype="multipart/form-data" method="POST" >
            <input type="hidden" name="action" value="add_event">
            <input type="hidden" name="getOrganizer" value="<?php echo $_SESSION["qid"]; ?>">

            <div class="section-heading">
              <h6>| Book Event</h6>
            </div>
            <div class="col-lg-12">
                <div class="row">
                <div class="col">
                    <fieldset>
                      <label for="email">Event Category</label>
                      <select name="getEventCategory" id="getEventCategory" class="form-control">
                        <option value="0">Select Event Category</option>
                        <?php
                                foreach ($EventCategories as $value) 
                                {
                                    echo '<option value="'.$value['id'].'">'.$value["name"].'</option>';
                                }
                            ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="email">Event Name</label>
                      <input type="text" name="getEventName" id="getEventName" placeholder="Event Name" required="">
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="email">Brochure/Invitation</label>
                      <input class="form-control" type="file" id="getEventImage" name="getEventImage" style="padding-top:11px;">
                    </fieldset>
                  </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                <div class="col">
                    <fieldset>
                      <label for="email">Resource Person Name</label>
                      <input type="text" name="getResourcePersonName" id="getResourcePersonName" placeholder="Resource person name" required="">
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="email">Resource Person Designation</label>
                      <input type="text" name="getResourcePersonDesignation" id="getResourcePersonDesignation" placeholder="Resource Person Designation" required="">
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="email">Resource Person Image</label>
                      <input class="form-control" type="file" id="getResourcePersonImage" name="getResourcePersonImage" style="padding-top:11px;">
                    </fieldset>
                  </div>
                
                </div>
            </div>  
              
              <div class="col-lg-12">
                <div class="row">
                  <div class="col">
                    <fieldset>
                      <label for="email">Choose Venue</label>
                      <select name="getChooseVenue" id="getChooseVenue" class="form-control">
                        <option value="0">Select Venue</option>
                        <?php
                            foreach ($VenuesList as $value) {
                                echo '<option value="'.$value['id'].'">'.$value["name"].'</option>';
                            }
                        ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="getStartDate">Start Date</label>
                      <input type="text" name="getStartDate" id="getStartDate" placeholder="Start Date" autocomplete="off" required="" readonly>
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="getStartTime">Start Time</label>
                      <input type="text" name="getStartTime" id="getStartTime" placeholder="Start Time" autocomplete="off" required="" readonly>
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="getEndDate">End Date</label>
                      <input type="text" name="getEndDate" id="getEndDate" placeholder="End Date" autocomplete="off" required="" readonly>
                    </fieldset>
                  </div>
                  <div class="col">
                    <fieldset>
                      <label for="getEndTime">End Time</label>
                      <input type="text" name="getEndTime" id="getEndTime" placeholder="End Time" autocomplete="off" required="" readonly>
                    </fieldset>
                  </div>
                </div>
              </div>
            
                   
            <div class="col-lg-4">       
              <div class="row">
                <div class="col">
                  <fieldset>
                    <button type="button" id="bt_add_events" class="orange-button" >Book</button>
                  </fieldset>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>


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
    
<?php include("includes/footer.php"); ?>