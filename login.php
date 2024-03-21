<?php include("includes/header.php"); ?>

<style>
  footer p {
    text-align: right;
    line-height: 100px;
    color: #fff;
    font-size: 16px;
    font-weight: 400;
    /* margin: 0; */
    margin-right: 62px;
}
</style>

<div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>LOGIN</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>| Login</h6>
          </div>
          <form class="contact-form" id="login" style="margin-left:0px !important;" action="" method="post">
          <input type="hidden" name="action" value="login">
            <div class="row">
              
              <div class="col-lg-12">
                <fieldset>
                  <label for="email">Email Address</label>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Password</label>
                  <input type="password" name="password" id="password" placeholder="password" >
                </fieldset>
              </div>
              
              <div class="col-lg-12">
                <fieldset>
                  <button type="button" id="bt_login" class="orange-button">Login</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>| Register (Only for Student)</h6>
          </div>
          <form class="contact-form" id="register" style="margin-left:0px !important;" action=""  method="post">
          <input type="hidden" name="action" value="register">
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  <label for="name">Full Name</label>
                  <input type="name" name="regname" id="regname" placeholder="Your Name..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="email">Email Address</label>
                  <input type="text" name="regemail" id="regemail" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="Phone Number">Phone Number</label>
                  <input type="text" name="regPhone_Number" id="regPhone_Number"  placeholder="Your Phone..." required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="Create Password">Password</label>
                  <input type="password" name="regPassword" id="regPassword" placeholder="Password">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="Confirm Password">Confirm Password</label>
                  <input type="password" name="regConfirm_Password" id="regConfirm_Password" placeholder="Confirm Password">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="button" id="bt_register" class="orange-button">Register</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>