<?php 
include("includes/header.php"); 
include("includes/functions.php"); 

$VenuesList = getAllVenues($conn);
?>


  <div class="properties section">
    <div class="container">
      <div class="row" >
        <table cellpadding="0" cellspacing="0" border="0" class="dataTable table table-striped" id="OrganizerTable">

        </table>
      </div>
    </div>
  </div>
<style>
    tr,td,th{
        color:#fff;
    }
    tr .odd{
        color:#fff;
    }
    tr .even{
        color:#fff;
    }
    .table-striped>tbody>tr:nth-of-type(odd)>* {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color: #ffffff;
}
.dt-buttons{
    color:#ffff;
}
label{
color:#fff;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #fff !important;
    border: 1px solid transparent;
    background: transparent;
    box-shadow: none;
}
.dataTables_wrapper .dataTables_info{
    color:#fff;
}
</style>
 
<script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>

<script>
    var reserveTable;
    var LiveOptions = { "Premier" : "Premier", "Open" : "Open", "Closed":"Closed" };

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
        title: "Starting  Date",
        type: "readonly"
        },
        {
        data: "start_time",
        title: "Start Time",
        type: "readonly"
        },
        {
        data: "end_date",
        title: "Ending Date",
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
        type: "readonly"
        },
        {
        data: "live",
        title: "Live",
        type: "select",
        options: LiveOptions,
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
                url : '../api/common.php?action=list_history&staff='+<?php echo $_SESSION["qid"];?>,
                dataSrc : ''
            },
            columns: columnDefs,
            dom: 'Bfrtip',        
            select: 'single',
            responsive: true,
            altEditor: true,     
            buttons: [
           
                {
                    extend: 'selected', // Bind to Selected row
                    text: 'Edit',
                    name: 'edit'        // do not change name
                },
                {
                    text: 'Refresh',
                    name: 'refresh'      // do not change name
                }
            ],
            onEditRow: function(datatable, rowdata, success, error) {

                $.ajax({
                    url: "../api/common.php",
                    type: "POST",
                    data: {
                                action: "live_requests", 
                                id: rowdata.id, 
                                live: rowdata.live, 
                        },
                    success: function(data) {
                        var details = JSON.parse(data);

                        if (details["status"] == "200") {
                            alert(details["message"]);
                            window.location.replace("history.php");
                               
                        } else {
                            alert(details["message"]);
                            window.location.replace("history.php");
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