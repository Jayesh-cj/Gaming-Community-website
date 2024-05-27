<?php
  include("../Assets/Connection/Connection.php");
  session_start();
  include("Head.php");
  ob_start();
  
  if(isset($_GET['accept'])) {
	  $update="UPDATE `tbl_joinlist` SET `list_status` = '1' WHERE user_id='".$_GET['accept']."'";
	  if($con->query($update)) {
		  header("Location:Requests.php");
	  }
  }
  if(isset($_GET['reject'])) {
	  $reject="delete from tbl_joinlist where user_id='".$_GET['reject']."'";
	  if($con->query($reject)) {
		  header("Location:Requests.php");
	  }
  }

  $selMembers="select * from tbl_joinlist l inner join tbl_user u on l.user_id=u.user_id where community_id='".$_SESSION['cid']."' and list_status=0";
  $res=$con->query($selMembers);
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Requests</title>
</head>
<?php
if($res->num_rows <= 0)
{
  echo "<h2 align='center'>No Requests</h2>";
}
else
{
  ?>
<table width="500" border="1" align="center">
  <caption><h2 align="center">Show Requests</h2></caption>
  <tr>
    <th scope="row" class="text-white">&nbsp;SL.NO</th>
    <th scope="row" class="text-white">&nbsp;Photo</th>
    <th scope="row">&nbsp;Name</th>
    <th scope="row" colspan="2">&nbsp;Action</th>
  </tr>
  <?php

  $i=0;
  while($data=$res->fetch_assoc())
  {
	  $i++;
	  ?>
      <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><img src="../Assets/File/User/<?php echo $data['user_photo']?>" width="100px" height="60px"/></td>
    	<td>&nbsp;<a href="ShowProfile.php?showP=<?php echo $data['user_id'];?>"><?php echo ucfirst($data['user_name'])?></a></td>
        <th scope="row">&nbsp;<a href="Requests.php?accept=<?php echo $data['user_id'];?>">Accept</th>
   	    <th scope="row">&nbsp;<a href="Requests.php?reject=<?php echo $data['user_id'];?>">Reject</th>
       </tr>
    <?php
  }  
  ?>
  </table>
  <?php
}
?>
</body>
</html>
<?php
ob_flush();
include("Foot.php");
?>