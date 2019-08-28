<?php 
include '../lib/session.php'; 
session::check_session();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/database.php'; ?>

<?php 
	$db = new database();
?>

<?php 
if (!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL ) {
       header("location: postlist.php");
    }else{
        $delpostid = $_GET['delpostid'];

        $sql = "SELECT * FROM tbl_post WHERE id='$delpostid'";
        $getdata = $db->select($sql);
        if ($getdata) {
        	while ($result = $getdata->fetch_assoc()) {
        		$imgpath = $result['image'];
        		unlink($imgpath);
        	}
        }

       $sqldelete = "DELETE FROM tbl_post WHERE id='$delpostid'";
       $deldata = $db->delete($sqldelete);
       if ($deldata) {
       	echo "<script>alert('Deleted Successfully....');</script>";
       	echo "<script>window.location = 'postlist.php';</script>";
       }else{
       	echo "<script>alert('Data Not Deleted...');</script>";
       	echo "<script>window.location = 'postlist.php';</script>";
       }
    }
?>