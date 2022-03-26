<?php
function lister_page(){
	$start_date = !empty($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('first day of this month'));
    $end_date = !empty($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d', strtotime('last day of this month'));
	?>
	<h1 class="wp-heading-inline">Lister Report</h1>
  <form method="GET" action="/wp-admin/admin.php">
  <form method="GET" action="/wp-admin/admin.php">
  <table class="form-table">


  <tbody>
  <tr class="form-field form-required">
	<th scope="row">
		  <label>Lister:</label>
		  <td>
 		  	<select name="Listers" id="lister">
 				 <option value="user1">User 1</option>
 				 <option value="user2">User 2</option>
  				 <option value="user3">User 3</option>
  		 	 </select>
	      </td>
	</th>
  </tr>
  <tr class="form-field form-required">
  <th scope="row">
    <label>Start Date</label>
  </th>
  <td>
   <input style="width:25em" type="date" name="start_date" value="<?php echo $start_date;?>"/>
  </td>
  </tr>
  <tr class="form-field form-required">
  <th scope="row">
    <label>End Date</label>
  </th>
  <td>
   <input style="width:25em" type="date" name="end_date" value="<?php echo $end_date;?>"/>
  </td>
  </tr>
  </tbody>
  </table>
  <input type="hidden" name="page" value="admin_report"/>
  <input type="submit" name="submit" class="button button-primary" value="submit"/>
  <input type="submit" name="export" class="button" value="export"/>
  </form>
	<?php
}
?>
