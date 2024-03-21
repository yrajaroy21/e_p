$("#bt_login").click(function(){
     login();
 });
 
 function login(){
 
     if(!isEmail($("#email").val())){
         alert("Please enter correct email.")
         return false;
    }
 
    if(!$("#password").val()){
         alert("Please enter password.")
         return false;
    }
 
    var data_frm = new FormData($("form#login")[0]);
    $.ajax({
         url: "api/common.php",
         type: "POST",
         data: data_frm,
         processData: false,
         contentType: false,
         success: function(data) {
              var details = JSON.parse(data);
 
              if (details["status"] == "200") {
                     alert( details["message"]);
                
                   window.location.replace("index.php");
              } else {
                 alert( details["message"]);
 
              }
         },
         error: function() {
              alert("E3: Login Error.");
              return false;
         }
    });
 
 }
 
 function isEmail(email) {
     var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
     return regex.test(email);
 }
 
 $("#bt_register").click(function(){
     signup();
 });
 
 function signup(){
     var data_frm = new FormData($("form#register")[0]);
     $.ajax({
          url: "api/common.php",
          type: "POST",
          data: data_frm,
          processData: false,
          contentType: false,
          success: function(data) {
             var details = JSON.parse(data);
 
             if (details["status"] == "200") {
                   alert(details["message"]);
                   window.location.replace("login.php");
 
             } else {
                  alert(details["message"]);
             }
          },
          error: function() {
               alert("E1: Signup Error.");
               return false;
          }
     });
 }
 
 
 
 $("#bt_adminlogin").click(function(){
      adminlogin();
  });
 
 function adminlogin(){
 
      var data_frm = new FormData($("form#adminlogin")[0]);
      $.ajax({
           url: "../api/common.php",
           type: "POST",
           data: data_frm,
           processData: false,
           contentType: false,
           success: function(data) {
                var details = JSON.parse(data);
 
                if (details["status"] == "200") {
                          alert(details["message"]);
                          window.location.replace("index.php");
 
                } else {
                     alert(details["message"]);
                }
           },
           error: function() {
                alert("E2: Login Error.");
                return false;
           }
      });
 
 }
 
 $("#bt_add_venue").click(function(){
      addVenue();
  });
 
  function addVenue(){
      var data_frm = new FormData($("form#AddVenue")[0]);
      $.ajax({
           url: "../api/common.php",
           type: "POST",
           data: data_frm,
           processData: false,
           contentType: false,
           success: function(data) {
                var details = JSON.parse(data);
  
                if (details["status"] == "200") {
                      alert(details["message"]);
                      window.location.replace("index.php");
  
                } else {
                     alert(details["message"]);
                }
           },
           error: function() {
                alert("E2: Login Error.");
                return false;
           }
      });
  }
 
  $("#bt_organizerlogin").click(function(){
      organizerlogin();
  });
 
 function organizerlogin(){
 
      var data_frm = new FormData($("form#organizerlogin")[0]);
      $.ajax({
           url: "../api/common.php",
           type: "POST",
           data: data_frm,
           processData: false,
           contentType: false,
           success: function(data) {
                var details = JSON.parse(data);
 
                if (details["status"] == "200") {
 
                     if(details["cstatus"] == "Reset")
                     {
                          var qid = details["qid"];
                          alert(details["message"]);
                          window.location.replace("reset.php?qid="+qid);
                     }else{
                          alert(details["message"]);
                          window.location.replace("index.php");
                     }
                          
 
                } else {
                     alert(details["message"]);
                }
           },
           error: function() {
                alert("E2: Login Error.");
                return false;
           }
      });
 
 }
 
 $("#bt_reset").click(function(){
      reset();
  });
 
  function reset(){
      var data_frm = new FormData($("form#resetpassword")[0]);
      $.ajax({
           url: "../api/common.php",
           type: "POST",
           data: data_frm,
           processData: false,
           contentType: false,
           success: function(data) {
                var details = JSON.parse(data);
 
                if (details["status"] == "200") {
 
                     if(details["cstatus"] == "Reset")
                     {
                          var qid = details["qid"];
                          alert(details["message"]);
                          window.location.replace("reset.php?qid="+qid);
                     }else{
                          alert(details["message"]);
                          window.location.replace("index.php");
                     }
                          
 
                } else {
                     alert(details["message"]);
                }
           },
           error: function() {
                alert("E2: Login Error.");
                return false;
           }
      });
  }
 
 var date = new Date();
 date.setDate(date.getDate() + 30);
 var setStartDate = date.toISOString().split('T')[0];
 
 var blockDates = [];
 var StartTimeAlloted = ["08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"];
 var StartTimeArray = [];
 var EndTimeAlloted = ["09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00","17:00"];
 var EndTimeArray = [];
 var SelectedVenue = "";
 
  
  
  $("#bt_add_events").click(function(){
      addevent();
  });
 
  function addevent(){
 
      if(!$("#getEventCategory").val()){
           alert("Please select Event Category.")
           return false;
      }
 
      if(!$("#getEventName").val()){
           alert("Please enter event name.")
           return false;
      }
 
      if(!$("#getEventName").val()){
           alert("Please enter event name.")
           return false;
      }
 
      if(!$("#getResourcePersonName").val()){
           alert("Please enter resource person name.")
           return false;
      }
 
      if(!$("#getResourcePersonDesignation").val()){
           alert("Please enter resource person designation.")
           return false;
      }
 
      if(!$("#getChooseVenue").val()){
           alert("Please select venue.")
           return false;
      }
 
      if(!$("#getStartDate").val()){
           alert("Please select start date.")
           return false;
      }
 
      if(!$("#getStartTime").val()){
           alert("Please select start time.")
           return false;
      }
 
      if(!$("#getEndDate").val()){
           alert("Please select end date.")
           return false;
      }
 
      if(!$("#getEndTime").val()){
           alert("Please select end time.")
           return false;
      }
 
      let event_image = $("#getEventImage")[0].files.length;
      if (event_image == 0) {
           alert("Please upload event image.")
           return false;
      }
 
      let person_image = $("#getResourcePersonImage")[0].files.length;
      if (person_image == 0) {
           alert("Please upload resource person image.")
           return false;
      }
 
      var data_frm = new FormData($("form#AddEvent")[0]);
      $.ajax({
           url: "../api/common.php",
           type: "POST",
           data: data_frm,
           processData: false,
           contentType: false,
           success: function(data) {
                var details = JSON.parse(data);
 
                if (details["status"] == "200") {
 
                     alert(details["message"]);
                     window.location.replace("history.php");
 
                } else {
                     alert(details["message"]);
                }
           },
           error: function() {
                alert("E2: Login Error.");
                return false;
           }
      });
 
 }
 
 $('#getChooseVenue').on('change', function() {
      SelectedVenue = this.value;
      
      $.ajax({
           url: "../api/common.php",
           type: "POST",
           data: {
                     action: "event_schedules", 
                     venue: this.value, 
                },
           success: function(data) {
                var details = JSON.parse(data);
                $('#getStartDate').datetimepicker('destroy');
                $('#getStartTime').datetimepicker('destroy');
                $('#getEndDate').datetimepicker('destroy');
                $('#getEndTime').datetimepicker('destroy');
 
                $('#getStartDate').val("");
                $('#getStartTime').val("");
                $('#getEndDate').val("");
                $('#getEndTime').val("");
 
                $('#getStartDate').attr("placeholder", "Start Date");
                $('#getStartTime').attr("placeholder", "Start Time");
                $('#getEndDate').attr("placeholder", "End Date");
                $('#getEndTime').attr("placeholder", "End Time");
 
 
                $('#getStartDate').datetimepicker({
                     ownerDocument: document,
                     contentWindow: window,
                     startDate: setStartDate,
                     minDate: setStartDate,
                     format:'d-m-Y',
                     formatDate:'Y-m-d',
                     timepicker:false,
                     initTime:false,
                     onSelectDate:function (e) 
                     {
                          $.ajax({
                               url: "../api/common.php",
                               type: "POST",
                               data: {
                                         action: "event_schedules", 
                                         type: "start_time",
                                         value: e,
                                         venue: SelectedVenue, 
                                    },
                               success: function(data) {
                                    var details = JSON.parse(data);
                                    $('#getStartTime').datetimepicker('destroy');
                     
                                    $('#getStartTime').datetimepicker({
                                         ownerDocument: document,
                                         contentWindow: window,
                                         format:'H:i',
                                         formatTime:'H:i',
                                         timepicker:true,
                                         datepicker:false,
                                         minTime:'08:00',
                                         maxTime:'17:00',    
                                         onSelectTime:function (e) {
                                              
                                              $.ajax({
                                                   url: "../api/common.php",
                                                   type: "POST",
                                                   data: {
                                                             action: "event_schedules", 
                                                             type: "end_date",
                                                             value: e,
                                                             venue: SelectedVenue, 
                                                        },
                                                   success: function(data) {
                                                        var details = JSON.parse(data);
                                                        $('#getEndDate').datetimepicker('destroy');
                                         
                                                        $('#getEndDate').datetimepicker({
                                                             ownerDocument: document,
                                                             contentWindow: window,
                                                             startDate: setStartDate,
                                                             minDate: setStartDate,
                                                             format:'d-m-Y',
                                                             formatDate:'Y-m-d',
                                                             timepicker:false,  
                                                             onSelectDate:function (e) {
                                                                 
                                                                  $.ajax({
                                                                       url: "../api/common.php",
                                                                       type: "POST",
                                                                       data: {
                                                                                 action: "event_schedules", 
                                                                                 type: "end_time",
                                                                                 value: e,
                                                                                 venue: SelectedVenue, 
                                                                            },
                                                                       success: function(data) {
                                                                            var details = JSON.parse(data);
                                                                            $('#getEndTime').datetimepicker('destroy');
                                                             
                                                                            $('#getEndTime').datetimepicker({
                                                                                 ownerDocument: document,
                                                                                 contentWindow: window,
                                                                                 format:'H:i',
                                                                                 formatTime:'H:i',
                                                                                 timepicker:true,
                                                                                 datepicker:false,
                                                                                 minTime:'09:00',
                                                                                 maxTime:'18:00', 
                                                                                 onSelectTime:function (e) {
                                                                                       
                                                                                 },
                                                                                 onShow:function (e) {
                                                                                     
                                                                                 },
                                                                             });
                                                                             
                                                                            if (details["status"] == "200") {
                                                             
                                                                                 details["data"].forEach(function(obj) 
                                                                                 { 
                                                                                      EndTimeArray.push(obj.start_time);
                                                                                      EndTimeArray.push(obj.end_time);
                                                                                 });
                                                        
                                                                                 // EndTimeArray.forEach(element => {
                                                                                 //      const index = EndTimeAlloted.indexOf(element);
                                                                                 //      EndTimeAlloted.splice(index, 1);
                                                                                 // });
                                                        
                                                                                 var start_index_val_1 = EndTimeAlloted.indexOf(StartTimeArray[0]);
                                                                                 var end_index_val_1 = EndTimeAlloted.indexOf(StartTimeArray[1]);
                                                        
                                                                                 for (var i = start_index_val_1; i <= end_index_val_1; i++)
                                                                                      EndTimeAlloted.splice(i,1);
 
                                                                                 var jsonArg4 = new Object();
                                                                                 jsonArg4.allowTimes = EndTimeAlloted;
                                                                                 var jsonArrayEndTime = JSON.parse(JSON.stringify(jsonArg4));
                                                        
                                                                                 $('#getEndTime').datetimepicker('setOptions', jsonArrayEndTime);
                                                        
                                                                            }else{
                                                                                
                                                                            }
                                                                       },                  
                                                                       error: function() {
                                                                            alert("Error.");
                                                                            return false;
                                                                       }
                                                                  });
                                                             },
                                                             onShow:function (e) {
                                                                  $('#getEndTime').datetimepicker('destroy');
                                                             },
                                                         });
                                                         
                                                        if (details["status"] == "200") {
                                                             blockDates = [];
                                                             details["data"].forEach(function(obj) 
                                                             { 
                                                                  if(obj.status == "1")
                                                                  {                              
                                                                       blockDates.push(obj.end_date);
                                                                  }
                                                             });
                                         
                                                             var jsonArg3 = new Object();
                                                             jsonArg3.disabledDates = blockDates;
                                                             var jsonArrayEndDate = JSON.parse(JSON.stringify(jsonArg3));
                                         
                                                             $('#getEndDate').datetimepicker('setOptions', jsonArrayEndDate );
                                    
                                                        }else{
                                                            
                                                        }
                                                   },                  
                                                   error: function() {
                                                        alert("Error.");
                                                        return false;
                                                   }
                                              });
                                         },
                                         onShow:function (e) {
                                              $('#getEndDate').datetimepicker('destroy');
                                              $('#getEndTime').datetimepicker('destroy');
 
                                              $('#getEndDate').val("");
                                              $('#getEndTime').val("");
 
                                              $('#getEndDate').attr("placeholder", "End Date");
                                              $('#getEndTime').attr("placeholder", "End Time");
                                         },
                                     });
                                     
                                    if (details["status"] == "200") {
                     
                                         details["data"].forEach(function(obj) 
                                         { 
                                               StartTimeArray.push(obj.start_time);
                                               StartTimeArray.push(obj.end_time);
                                         });
                
                                         // StartTimeArray.forEach(element => {
                                         //      const index = StartTimeAlloted.indexOf(element);
                                         //      StartTimeAlloted.splice(index, 1);
                                         // });
 
                                         var start_index_val = StartTimeAlloted.indexOf(StartTimeArray[0]);
                                         var end_index_val = StartTimeAlloted.indexOf(StartTimeArray[1]);
                
                                         for (var i = start_index_val; i <= end_index_val; i++)
                                              StartTimeAlloted.splice(i,1);
 
                                         var jsonArg2 = new Object();
                                         jsonArg2.allowTimes = StartTimeAlloted;
                                         var jsonArrayStartTime = JSON.parse(JSON.stringify(jsonArg2));
                
                                         $('#getStartTime').datetimepicker('setOptions', jsonArrayStartTime);
                
                                    }else{
                                        
                                    }
                               },                  
                               error: function() {
                                    alert("Error.");
                                    return false;
                               }
                          });
                     },
                     onShow:function (e) {
                          $('#getStartTime').datetimepicker('destroy');
                          $('#getEndDate').datetimepicker('destroy');
                          $('#getEndTime').datetimepicker('destroy');
 
                          $('#getStartTime').val("");
                          $('#getEndDate').val("");
                          $('#getEndTime').val("");
 
                          $('#getStartTime').attr("placeholder", "Start Time");
                          $('#getEndDate').attr("placeholder", "End Date");
                          $('#getEndTime').attr("placeholder", "End Time");
                     },
                     onClose:function (e) {
                     },
                 });
 
                if (details["status"] == "200") 
                {
                     blockDates = [];
                     details["data"].forEach(function(obj) 
                     { 
                          if(obj.status == "1")
                          {                              
                               blockDates.push(obj.start_date);
                          }
                     });
 
                     var jsonArg1 = new Object();
                     jsonArg1.disabledDates = blockDates;
                     var jsonArrayStartDate = JSON.parse(JSON.stringify(jsonArg1));
 
                     $('#getStartDate').datetimepicker('setOptions', jsonArrayStartDate );
                }else{
                    
                }
           },
           error: function() {
                alert("Error.");
                return false;
           }
      });
 });
 
 $("#bt_event_register").click(function(){
      eventregister();
  });
 
 function eventregister(){
 
      var event_id = $("#bt_event_register").data("eid");
      var user_id = $("#bt_event_register").data("uid");
 
      $.ajax({
           url: "api/common.php",
           type: "POST",
           data: {
                     action: "event_register", 
                     eid: event_id,
                     uid: user_id, 
                },
           success: function(data) {
                var details = JSON.parse(data);
 
                if (details["status"] == "200") 
                {
                     alert(details["message"]);
                     window.location.replace("your_events.php");
                }else{
                     alert(details["message"]);
                     window.location.replace("index.php");
                }
           },                  
           error: function() {
                alert("Error.");
                return false;
           }
      });
 }
 
 $("#bt_update_profile").click(function(){
      update_profile();
  });
 
 function update_profile(){
      if(!$("#profile_username").val()){
           alert("Please enter username.")
           return false;
      }
 
      if(!$("#profile_email").val()){
           alert("Please enter email.")
           return false;
      }
 
      if(!$("#profile_phone").val()){
           alert("Please enter phone number.")
           return false;
      }
 
      var data_frm = new FormData($("form#userprofile")[0]);
      $.ajax({
           url: "api/common.php",
           type: "POST",
           data: data_frm,
           processData: false,
           contentType: false,
           success: function(data) {
                var details = JSON.parse(data);
 
                if (details["status"] == "200") {
 
                     alert(details["message"]);
                     window.location.replace("profile.php");
 
                } else {
                     alert(details["message"]);
                }
           },
           error: function() {
                alert("E2: Login Error.");
                return false;
           }
      });
 }
 

