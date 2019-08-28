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
if (!isset($_GET['delid']) || $_GET['delid'] == NULL ) {
       header("location: index.php");
    }else{
        $delid = $_GET['delid'];

       $sqldeletepage = "DELETE FROM tbl_pages WHERE id='$delid'";
       $deldatapage = $db->delete($sqldeletepage);
       if ($deldatapage) {
       	echo "<script>alert('Deleted Successfully....');</script>";
       	echo "<script>window.location = 'index.php';</script>";
       }else{
       	echo "<script>alert('Data Not Deleted...');</script>";
       	echo "<script>window.location = 'index.php';</script>";
       }
    }
?>