<?php
 include("../Assets/Connection/Connection.php");
 session_start();
 include("Head.php");
 ob_start();
 
 $selC="select * from tbl_complaintcommunity where user_id='".$_SESSION['uid']."'";
 $resC=$con->query($selC);
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Complaints</title>
</head>

<body>
<table border="1" class="text-white">
  <tr>
    <th scope="row">SL.NO</th>
    <td>Title</td>
    <td>Details</td>
    <td>Date</td>
    <td>Status</td>
  </tr>
  <?php
  if($resC->num_rows<=0)
  {
	  echo "<h3 align='center'>No Complaints Registered</h3>>";
  }
  else
  {
	  $i=0;
  	  while($dataC=$resC->fetch_assoc())
	  {
		  $i++;
		  ?>
  	  <tr>
    	<th scope="row"><?php echo $i; ?></th>
    	<td>&nbsp;<?php echo $dataC['cc_title']?></td>
      	<td>&nbsp;<?php echo $dataC['cc_details']?></td>
        <td>&nbsp;<?php echo $dataC['cc_date']?></td>
        <td>
		 <?php
          if($dataC['cc_status'] == 0)
		  {
			  echo "<p>Complaint not seen by the admin</p>";
		  }
		  else
		  {
			  echo $dataC['cc_replay'];
		  }
		 ?>
         </td>
  	  </tr>
      <?php
	  }
  }
  ?>
</table>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>