<?php include 'inc/header.php'; ?>

<?php
	if (!isset($_GET['Category']) || $_GET['Category'] == NULL) {
		header("Location: 404.php");
	}else{
		$category = $_GET['Category'];
	}
 ?>

<div class="contentsection contemplete clear">
<div class="maincontent clear">
	<!----- post query Start ------>	
	<?php 
	$sql = "SELECT * FROM tbl_post WHERE catid= $category ";
	$post = $db->select($sql);
	if ($post) {
		while ($result = $post->fetch_assoc()) {
		
	 ?>
	<div class="samepost clear">
		<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
		<h4><?php echo $fm->formatdate($result['date']);?> <a href="#"><?php echo $result['author'];?></a></h4>
		<a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>

		<?php echo $fm->textShorten($result['body']);?>
		
		<div class="readmore clear">
			<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
		</div>
	</div>

<?php } } else { ?>
	<h3>No Category Post Available...</h3>
<?php  } ?>

</div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>
