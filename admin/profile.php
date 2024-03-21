<?php 
include("includes/header.php"); 
include("includes/functions.php"); 

$Profile = getYourProfile($conn, $_SESSION["uid"]);
?>


  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
          <div class="section-heading" style="width:100%;">
            
          </div>
          <form class="contact-form" id="userprofile" style="margin-left:0px !important;" action="" method="post">
          <input type="hidden" name="action" value="update_profile">
          <input type="hidden" name="id" value="<?php echo $Profile["id"] ?>">
            <div class="row">
            <div class="col-lg-12">
                <fieldset>
                    <img for="profile_image" src="<?php echo $Profile["image"]; ?>" alt="Avatar" style="vertical-align: middle;width: 50px;height: 180px;border-radius: 50%;text-align: center;display: block;margin-left: auto;margin-right: auto;width: 50%;">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Username</label>
                  <input type="text" name="profile_username" id="profile_username" placeholder="Username" value="<?php echo $Profile["username"]; ?>" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Email Address</label>
                  <input type="text" id="profile_email" name="profile_email"  placeholder="Email" value="<?php echo $Profile["email"]; ?>">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Phone Number</label>
                  <input type="text" id="profile_phone" name="profile_phone"  placeholder="Phone Number" value="<?php echo $Profile["phone"]; ?>">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset style="text-align: center;">
                  <button type="button" id="bt_update_profile" class="orange-button">Update Profile</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-4">
        </div>
        
      </div>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>
 