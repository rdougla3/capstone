<?php
require "vendor/autoload.php";


function createExcel($name,$date,$arr_data){
  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();

  $spreadsheet = $reader->load(ROOTDIR_Report_System."/include/Excel/Donor.xls");

  $sheet = $spreadsheet->getSheet(0);
  $sheet->setCellValue("A2","Donor: ".$name);
  $sheet->setCellValue("A3","Date Range: ".$date);

  //$formatCode = $sheet->getStyle('F7')->getNumberFormat()->getFormatCode();

  $startAt = 7;
  $key = 0;
  $total = 0;
  foreach($arr_data as $arr){
    $sheet->setCellValue("A".($startAt+$key),$arr[0]);
    $sheet->setCellValue("B".($startAt+$key),$arr[1]);
    $sheet->setCellValue("C".($startAt+$key),$arr[2]);
    $sheet->setCellValue("D".($startAt+$key),$arr[3]);
    $sheet->setCellValue("E".($startAt+$key),$arr[4]);
    $sheet->setCellValue("F".($startAt+$key),$arr[5]);
    $sheet->setCellValue("G".($startAt+$key),$arr[4]*$arr[5]);
    $sheet->setCellValue("H".($startAt+$key),$arr[6]);

  //  $sheet->getStyle('F'.($startAt+$key))->getNumberFormat()->getFormatCode()->setFormatCode($formatCode);
  //  $sheet->getStyle('G'.($startAt+$key))->getNumberFormat()->getFormatCode()->setFormatCode($formatCode);

    $key += 1;
    $total += $arr[4]*$arr[5];
  }

  $sheet->setCellValue("F".($startAt+$key+1),"Total");
  $sheet->setCellValue("G".($startAt+$key+1),$total);

  ob_clean();
  $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
  header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header("Content-Disposition: attachment;filename=\"test.xls\"");
  header("Cache-Control: max-age=0");
  header("Expires: Fri, 11 Nov 2011 11:11:11 GMT");
  header("Last-Modified: ". gmdate("D, d M Y H:i:s") ." GMT");
  header("Cache-Control: cache, must-revalidate");
  header("Pragma: public");
  $writer->save("php://output");
}
function donor_page(){
	$start_date = !empty($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('first day of this month'));
    $end_date = !empty($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d', strtotime('last day of this month'));
	?>
	<h1 class="wp-heading-inline">Donor Report</h1>
  <form method="GET" action="/wp-admin/admin.php">
  <table class="form-table">


  <tbody>
  <tr class="form-field form-required">
	<th scope="row">
		  <label>Donor:</label>
		  <td>
 		  	<select name="Donors" id="donor">
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
  <input type="hidden" name="page" value="report_system"/>
  <input type="submit" name="submit" class="button button-primary" value="submit"/>
  <input type="submit" name="export" class="button" value="export"/>
  </form>
	<?php
	if (!empty($_GET['submit']) && $_GET['submit'] == 'submit' || !empty($_GET['export']) && $_GET['export'] == 'export') {
		$data = array(
  array("JOBS-eBay",165185989011,"L  K Wall Street Bear and Bull Burled Wood Bookend Set - Great Gift Item","Figgie_Erin_Erin",1,40.99,"Jan-29-22"),
  array("JOBS-MRD",165185935093,"L  K Wall Street Bear and Bull Brass Bookend Set Stock Market Heavy Marble Base","Figgie_Erin_Erin",1,35,"Jan-24-22"),
  array("JOBS-MRD",165185935093,"L  K Wall Street Bear and Bull Brass Bookend Set Stock Market Heavy Marble Base","Figgie_Erin_Erin",1,47.96,"Jan-11-22")
);
		createExcel($_GET['Donors'],date("F j, Y", strtotime($_GET['start_date']))." - ".date("F j, Y", strtotime($_GET['end_date'])),$data);
	}
}
?>
