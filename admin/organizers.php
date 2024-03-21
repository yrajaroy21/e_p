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
        <table cellpadding="0" cellspacing="0" border="0" class="dataTable table table-striped" id="OrganizerTable">

        </table>
      </div>
    </div>
  </div>

 
<script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>

<script>
    var reserveTable;
    var StatusOptions = { "Reset" : "Reset", "Active" : "Active", "Blocked":"Blocked" };

    var columnDefs = [
        {
        data: "id",
        title: "Auto Generated ID",
        type: "readonly"
        },
        {
        data: "bioid",
        title: "Bio ID",

        },
        {
        data: "username",
        title: "Organizer Name",
        

        },
        {
        data: "email",
        title: "Organizer Email",

        },
        {
        data: "status",
        title: "Status",
        type: "select",
        options: StatusOptions,
            select2 : { width: "100%"},
            render : function (data, type, row, meta) {
                if (data == null || row == null || row.status == null) return null;
                return data;
        }
    }
    ];

    $(document).ready(function() { 
        myTable = $('#OrganizerTable').DataTable({
            "sPaginationType": "full_numbers",
            ajax: {
                url : '../api/common.php?action=list_organizers',
                dataSrc : ''
            },
            columns: columnDefs,
            dom: 'Bfrtip',        
            select: 'single',
            responsive: true,
            altEditor: true,     
            buttons: [
                {
                    text: 'Add',
                    name: 'add'      
                },
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
            onAddRow: function(datatable, rowdata, success, error) {
                $.ajax({
                    url: "../api/common.php",
                    type: "POST",
                    data: {
                                action: "add_organizers", 
                                bioid: rowdata.bioid, 
                                username: rowdata.username, 
                                email: rowdata.email, 
                        },
                    success: function(data) {
                        var details = JSON.parse(data);

                        if (details["status"] == "200") {

                            alert(details["message"]);
                            window.location.replace("organizers.php");

                        } else {
                            alert(details["message"]);
                            window.location.replace("index.php");
                        }
                    },
                    error: function() {
                        alert("E4: Error.");
                        return false;
                    }
                });
            },
            // onDeleteRow: function(datatable, rowdata, success, error) {
            //     console.log(rowdata);
            //     $.ajax({
            //         // a tipycal url would be /{id} with type='DELETE'
            //         url: '../api/api.php?action=book_requests',
            //         type: 'GET',
            //         data: rowdata,
            //         success: success,
            //         error: error
            //     });
            // },
            onEditRow: function(datatable, rowdata, success, error) {

                $.ajax({
                    url: "../api/common.php",
                    type: "POST",
                    data: {
                                action: "edit_organizers", 
                                id: rowdata.id, 
                                status: rowdata.status, 
                        },
                    success: function(data) {
                        var details = JSON.parse(data);

                        if (details["status"] == "200") {

                            alert(details["message"]);
                            window.location.replace("organizers.php");

                        } else {
                            alert(details["message"]);
                            window.location.replace("index.php");
                        }
                    },
                    error: function() {
                        alert("E4: Error.");
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