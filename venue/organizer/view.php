<?php 
include("includes/header.php"); 
include("includes/functions.php"); 


$EventList = getMyEvents($conn, $_SESSION["qid"]);


?>


  <div class="properties section">
    <div class="container">
      <div class="row" >
        <div class="col">
            <fieldset>
                <label for="email">Select Event</label>
                <select name="setMyEvent" id="setMyEvent" class="form-control" style="margin-bottom: 20px;width: 250px;">
                <option value="0">Select Event</option>
                <?php
                    foreach ($EventList as $value) {
                        echo '<option value="'.$value['id'].'">'.$value["title"].'</option>';
                    }
                ?>
                </select>
            </fieldset>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="dataTable table table-striped" id="OrganizerTable">

        </table>
      </div>
    </div>
  </div>

 
<script type="text/javascript" src="../assets/js/jquery-1.12.4.min.js"></script>

<script>
    var ViewTable;
    var LiveOptions = { "Premier" : "Premier", "Open" : "Open", "Closed":"Closed" };

    var columnDefs = [
        {
        data: "id",
        title: "Auto Generated ID",
        type: "readonly"
        },
        {
        data: "username",
        title: "Student Name",
        type: "readonly"
        },
        {
        data: "email",
        title: "Student Email",
        type: "readonly"
        },
        {
        data: "phone",
        title: "Student Phone No",
        type: "readonly"
        },
        
    ];

    $(document).ready(function() { 
        ViewTable = $('#OrganizerTable').DataTable({
            "sPaginationType": "full_numbers",
            ajax: {
                url : '../api/common.php?action=list_registrations&eid='+<?php echo $_GET['view'] ?>,
                dataSrc : ''
            },
            columns: columnDefs,
            dom: 'Bfrtip',        
            select: 'single',
            responsive: true,
            altEditor: true,     
            buttons: [
                {
                    text: 'Refresh',
                    name: 'refresh'      // do not change name
                }
            ],
         
        });
    });

    
    $('#setMyEvent').on('change', function() {
        location.href = "?view=" + this.value;

        // ViewTable.ajax.url("../api/common.php?action=list_registrations&eid="+this.value).load();
    });

</script>

  

<?php include("includes/footer.php"); ?>