<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
 include('head.php');
//  session_start();

 $selComp="SELECT * FROM tbl_complaint c INNER JOIN tbl_user u ON c.user_id=u.user_id WHERE complaitnt_id='".$_GET['replay']."'";
 $resComp=$con->query($selComp);
 $dataComp=$resComp->fetch_assoc();

 if(isset($_Post['btn_submit']))
 {
    $replay=$_POST['replay'];
    $updateCom="update tbl_complaint set complaint_replay='".$replay."'complaint_status=1";
    If($con->query($updateCom))
    {
        ?>
        <script>
            alert("Replayed");
            window.location="AdminShowComplaints.php";
        </script>
        <?php
    }
 }
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Replay Complaints</title>
</head>

<body>
<div class="container mt-5">
    <form>
        <table class="table table-bordered" align="center" style="border-color: white;">
            <tr>
                <th scope="row">User Name</th>
                <td><?php echo $dataComp['user_name']?></td>
            </tr>
            <tr>
                <th scope="row">Complaint Title</th>
                <td><?php echo $dataComp['complaint_title']?></td>
            </tr>
            <tr>
                <th scope="row">Complaint Content</th>
                <td><?php echo $dataComp['complaint_details']?></td>
            </tr>
            <tr>
                <th scope="row">Date</th>
                <td><?php echo $dataComp['complaint_date']?></td>
            </tr>
            <tr>
                <th scope="row">Reply</th>
                <td><textarea name="reply" class="form-control" placeholder="Enter Reply" required="required"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" class="btn btn-primary" name="btn_submit" value="Send" />
                    <input type="reset" class="btn btn-secondary" name="btn_cancel" value="Cancel" />
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>