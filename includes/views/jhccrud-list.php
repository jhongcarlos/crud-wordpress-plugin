<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style type="text/css">
    #branches {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#branches td, #branches th {
  border: 1px solid #ddd;
  padding: 8px;
}

#branches tr:nth-child(even){background-color: #f2f2f2;}

#branches tr:hover {background-color: #ddd;}

#branches th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #780001;
  color: white;
}
.column {
  float: left;
  width: 48%;
  padding: 10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.f-input {
  width: 100%;
  padding: 10px 18px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.submit_button {
  width: 50%;
  /*color: white;*/
  padding: 10px 16px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.submit_button:hover{
    background: #780001;
    color: white;
}

</style>
<div class="wrap">
    <h2>Manage Branches</h2><br>
    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">
    </form>

<div class="row">
    <div class="column">
        <h2>Add new Branch</h2>
        <form method="post">
            <input type="text" required="" name="branch" placeholder="branch" class="f-input"><br>
            <input type="text" required="" name="branch_address" placeholder="address" class="f-input"><br>
            <input type="text" required="" name="branch_hour" placeholder="hour" class="f-input"><br>
            <button name="submit" class="submit_button">Add Branch</button>
        </form>
         <?php
        if ( isset( $_POST['submit'] ) ){

         global $wpdb;
         $tablename = $wpdb->prefix.'store_details';

            $wpdb->insert( $tablename, array(
                'branch' => $_POST['branch'], 
                'address' => $_POST['branch_address'],
                'hours' => $_POST['branch_hour']),
                array( '%s', '%s', '%s'));
        }
        if ( isset( $_POST['delete'] ) ){

         global $wpdb;
         $tablename = $wpdb->prefix.'store_details';
         $id = $_POST['id'];
         $wpdb->delete( $tablename, array( 'id' => $id ) );
     }

    ?>
    </div>
    <div class="column hide">
         <!-- <h2>Add new Branch</h2>
        <form method="post">
            <input type="text" name="branch" placeholder="branch" class="f-input"><br>
            <input type="text" name="branch_address" placeholder="address" class="f-input"><br>
            <input type="text" name="branch_hour" placeholder="hour" class="f-input"><br>
            <button name="submit" class="submit_button">Add Branch</button>
        </form> -->
    </div>
</div>

    <?php
global $wpdb;
$query="";
if (isset($_POST['search'])) {
    $txt_search = $_POST['txt_search'];
    $query = "SELECT * FROM wp_store_details WHERE branch LIKE '%$txt_search%' OR address LIKE '%$txt_search%' OR hours LIKE '%$txt_search%'";
}
else{
    $query="SELECT * FROM wp_store_details";
}
$branches = $wpdb->get_results($query);
?>
<form method="post" style="float: right;padding: 10px">
    <input type="text" name="txt_search"><button name="search">Search</button> | <button name="view_all">View All</button>
</form>
<table id="branches">
<tr>
    <th>ID</th>
    <th>Branch</th>
    <th>Address</th>
    <th>Hours</th>
    <th>Action</th>
</tr>
<?php foreach($branches as $branch){ ?>
<tr>
 <td><?php echo $branch->id; ?></td>
 <td><?php echo $branch->branch; ?></td>
 <td><?php echo $branch->address; ?></td>
 <td><center><?php echo $branch->hours; ?></td>
 <td><form method="post"><input type="hidden" name="id" value="<?= $branch->id; ?>"><button name="delete">Delete</button></form></td>
</tr>

<?php } ?>

</table><br>
</div>



<!-- <p>If you click on the "Hide" button, I will disappear.</p>
<button id="hide">Hide</button>
<button id="show">Show</button>
<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $(".column.hide").hide();
  });
  $("#show").click(function(){
    $(".column.hide").show();
  });
});
</script> -->