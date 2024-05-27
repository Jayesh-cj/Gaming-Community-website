<?php 
  include("../Assets/Connection/Connection.php");
  session_start();
  include("Head.php");
  ob_start();
  
  $selPass="select * from tbl_user where user_id='".$_SESSION['uid']."'";
  $res=$con->query($selPass);
  $row=$res->fetch_assoc();
  
  if(isset($_POST['pass_submit']))
  {
	    $old_p=$_POST['old_password'];
        $new_p=$_POST['new_password'];
        $confirm_p=$_POST['confirm_password'];

	  if($row['user_password'] == $old_p)
	  {
		  if($new_p == $confirm_p)
		  {
			  $update="update tbl_user set user_password='".$new_p."' where user_id=".$_SESSION['uid'];
			  $con->query($update);
			  header("Location:../User/ChangePassword.php");
		  }
	  }
  }
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
</head>

<body>
<form method="post">
 <table width="200" border="0" align="center">
  <tr>
    <th scope="row" class="text-white">Old Password</th>
    <td><input type="text" name="old_password" /></td>
  </tr>
  <tr>
    <th scope="row" class="text-white">New Password</th>
    <td><input type="password" name="new_password" /></td>
  </tr>
  <tr>
    <th scope="row" class="text-white">Confirm Password</th>
    <td><input type="password" name="confirm_password" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <input type="submit" name="pass_submit" value="Confirm" class="btn btn-primary"/>
    </td>
  </tr>
</table>
</form>
</body>
</html>
<?php
ob_flush();
include("Foot.php");
?>