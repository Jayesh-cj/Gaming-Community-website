<?php
  include("../Assets/Connection/Connection.php");
  session_start();
  include("Head.php");
  ob_start();
  
  
  $selPost="select * from tbl_post where community_id='".$_SESSION['cid']."' and user_id='".$_SESSION['uid']."'";
  $resPost=$con->query($selPost);
  
  if(isset($_GET['delpost']))
  {
	  $del="delete from tbl_post where post_id='".$_GET['delpost']."'";
	  if($con->query($del))
	  {
		  ?>
		  <script>
		  alert("Post Deleted");
		  window.location="UserActivitys.php";
		  </script>
          <?php
	  }
  }	  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Activitys</title>
</head>

<body>
<div class="container mt-4">
        <?php
         if($resPost->num_rows <= 0)
         {
            echo "<h2 class='text-center'>No Activities</h2>";
         }
         else
         {
        ?>
        <table class="table table-bordered table-hover">
            <caption align="top"><h1 class="text-center">My Activities</h1></caption>
            <?php
            while ($dataPost = $resPost->fetch_assoc()) {
                ?>
                <tr>
                    <td colspan="2" class="text-center text-white"><?php echo $dataPost['post_content']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <img src="../Assets/File/User/Post/<?php echo $dataPost['post_file']; ?>" class="img-fluid" alt="Activity Image">
                    </td>
                </tr>
                <tr>
                    <td class="text-left">
                        <a href="UserActivitys.php?delpost=<?php echo $dataPost['post_id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                    <td class="text-right text-white"><?php echo $dataPost['post_date']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
         }
         ?>
    </div>
</body>
</html>
<?php
ob_flush();
include("Foot.php");
?>