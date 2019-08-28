<?php include 'inc/header.php'; ?>
<?php 
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL ) {
       header("location: postlist.php");
    }else{
        $pagesid = $_GET['pageid'];
        
    }
?>

   <?php 
    $sql = "SELECT * FROM tbl_pages WHERE id='$pagesid';";
    $tbl_pages = $db->select($sql);
    if ($tbl_pages) {
        while ($result = $tbl_pages->fetch_assoc()) {
                    
    ?>     


<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2><?php echo $result['name']; ?></h2>
			<?php echo $result['body']; ?>
			
	</div>
</div>
	<?php } }else{
		header("location: 404.php");
	} ?>
	
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>


		