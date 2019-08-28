<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>
		 <!-- post Query start-->
				<?php 
					$sql = "SELECT * FROM tbl_category";
					$Category = $db->select($sql);
					if ($Category) {
						while ($result = $Category->fetch_assoc()) {
	
				?>
			<ul>
				<li><a href="posts.php?Category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>					
			</ul>
		<?php } } else{ ?>
		
			<ul>
				<li><a href="">No Category </a></li>					
			</ul> 
		<?php } ?>
	</div>
	
	<div class="samesidebar clear">
		<h2>Latest articles</h2>
		<?php 
		$sql = "SELECT * FROM tbl_post limit 5 ";
		$post = $db->select($sql);
		if ($post) {
		   while ($result = $post->fetch_assoc()) {
		
	 	?>
		<div class="popular clear">
			<h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
			<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
			
			<?php echo $fm->textShorten($result['body'], 120 );?>
		</div>
	
	<?php } } else { header("location: 404.php"); } ?>

	</div>
</div>
</div>

	