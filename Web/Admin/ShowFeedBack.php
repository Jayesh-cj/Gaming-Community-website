<?php
include("../Assets/Connection/Connection.php");

ob_start();
include('head.php')

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Show FeedBack</title>
</head>

<body>
    <table>
        <tr>
            <td>SL.NO</td>
            <td>FeedBack</td>
            <td>User name</td>
            <td>Date</td>
        </tr>
        <?php
        $selFB="select * from tbl_feedback f inner join tbl_user u on f.user_id=u.user_id";
        $resFB=$con->query($selFB);
        $i=0;
        while($catFB=$resFB->fetch_assoc())
        {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $catFB['feedback_content']?></td>
                <td><?php echo $catFB['user_name']?></td>
                <td><?php echo $catFB['feedback_date']?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
<?php
include('foot.php');
ob_flush();
?>
</html>