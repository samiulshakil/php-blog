<?php include 'inc/header.php'; ?>
<?php
	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		header("Location: 404.php");
	}else{
		$id = $_GET['id'];
	}
 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">

				 <!-- post single query start-->
				<?php 
					$sql = "SELECT * FROM tbl_post WHERE id = $id";
					$post = $db->select($sql);
					if ($post) {
						while ($result = $post->fetch_assoc()) {
	
				?>
				<h2><a><?php echo $result['title'];?></a></h2>
				<h4><?php echo $fm->formatdate($result['date']);?> <a href="#"><?php echo $result['author'];?></a></h4>
				<a href=""><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>

				<?php echo $result['body'];?>
				

					
			<div class="relatedpost clear">
				<h2>Related articles</h2>
				 <!-- Categroy Related Start -->
				<?php 
				$catid = $result['catid'];
				$sqlrealted = "SELECT * FROM tbl_post WHERE catid = '$catid' order by rand() limit 6";
				$relatedpost = $db->select($sqlrealted);
				if ($post) {
				while ($rresult = $relatedpost->fetch_assoc()) {

				?>
				<a href="post.php?id=<?php echo $rresult['id'];?>"><img src="admin/<?php echo $rresult['image']; ?>" alt="post image"/></a>

			<?php } } else { echo "No related post available"; } ?>  <!-- Category while and if end -->

			</div>

			<?php } } else { header("location: 404.php"); } ?> <!-- post while and if end -->

		</div>
	</div>
			
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>