<?php 
include("includes/header.php"); 
include("includes/functions.php"); 

$VenuesList = getAllVenues($conn);
?>
<style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #E0FFFF; /* Light Blue background color */
      color: #333333;
    }
    </style>

  <div class="properties section">
    <div class="container">
      <div class="row" >
        <table cellpadding="0" cellspacing="0" border="0" class="dataTable table table-striped" id="EventRequestTable">

        </table>
      </div>
    </div>
  </div>
<script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>
<script>
    var reserveTable;
    var RequestOptions = { "OnHold" : "OnHold", "OnProgress" : "OnProgress", "Denied":"Denied", "Approved":"Approved" };

    var columnDefs = [
        {
        data: "id",
        title: "ID",
        type: "readonly"
        },
        {
        data: "category",
        title: "Category",
        type: "readonly"
        },
        {
        data: "venue",
        title: "Venue",
        type: "readonly"
        },
        {
        data: "title",
        title: "Event Title",
        type: "readonly"
        },
        {
        data: "resource_person_name",
        title: "Guest Name",
        type: "readonly"
        },
        {
        data: "resource_person_des",
        title: "Guest Designation",
        type: "readonly"
        },
        {
        data: "start_date",
        title: "Starting Date",
        type: "readonly"
        },
        {
        data: "start_time",
        title: "Start Time",
        type: "readonly"
        },
        {
        data: "end_date",
        title: "Ending  Date",
        type: "readonly"
        },
        {
        data: "end_time",
        title: "End Time",
        type: "readonly"
        },
        
        {
        data: "status",
        title: "Status",
        type: "select",
        options: RequestOptions,
            select2 : { width: "100%"},
            render : function (data, type, row, meta) {
                if (data == null || row == null || row.status == null) return null;
                return data;
        }
    }
    ];
    $(document).ready(function() { 
        myTable = $('#EventRequestTable').DataTable({
            "sPaginationType": "full_numbers",
            ajax: {
                url : '../api/common.php?action=list_request',
                dataSrc : ''
            },
            columns: columnDefs,
            dom: 'Bfrtip',        
            select: 'single',
            responsive: true,
            altEditor: true,     
            buttons: [
                {
                    extend: 'selected', 
                    text: 'Edit',
                    name: 'edit'        
                },
                {
                    text: 'Refresh',
                    name: 'refresh'      
                }
            ],
            onEditRow: function(datatable, rowdata, success, error) {

                $.ajax({
                    url: "../api/common.php",
                    type: "POST",
                    data: {
                                action: "edit_request", 
                                id: rowdata.id, 
                                status: rowdata.status, 
                        },
                    success: function(data) {
                        var details = JSON.parse(data);

                        if (details["status"] == "200") {

                            alert(details["message"]);
                            window.location.replace("request.php");

                        } else {
                            alert(details["message"]);
                            window.location.replace("index.php");
                        }
                    },
                    error: function() {
                        alert("E4: Add Favourite Error.");
                        return false;
                    }
                });
            }
        });
    });

    
    // $('#dt-model').modal('toggle')
    // $('.dt-model').removeClass('show');

</script>

  

<?php include("includes/footer.php"); ?>
header("Location: request.php");
exit;
