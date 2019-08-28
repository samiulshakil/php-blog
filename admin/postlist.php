<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th style="width: 5%;">No</th>
							<th style="width: 15%;">Post Title</th>
							<th style="width: 15%;">Description</th>
							<th style="width: 10%;">Category</th>
							<th style="width: 10%;">Image</th>
							<th style="width: 10%;">Author</th>
							<th style="width: 10%;">Tags</th>
							<th style="width: 10%;">Date</th>
							<th style="width: 10%;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$sql = "SELECT tbl_post.*, tbl_category.name
                            FROM tbl_post
                            INNER JOIN tbl_category
                            ON tbl_post.catid=tbl_category.id;
                            ";
							$post = $db->select($sql);
							$i = 0;
							if ($post) {
								while ($result = $post->fetch_assoc()) {
								$i++;	
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>

							<a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><td><?php echo $result['title']; ?></a></td>

							<td><?php echo $fm->textShorten($result['body'], 40); ?></td>

							<td class="center"><?php echo $result['name']; ?></td>

							<td><img src="<?php echo $result['image']; ?>"" height="40px" width="60px"></td>

							<td><?php echo $result['author']; ?></td>

							<td><?php echo $result['tags']; ?></td>

							<td class="center"> <?php echo $fm->formatdate($result['date']); ?> </td>
							<td>
								<a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a>
								 ||
							    <a onclick="return confirm('Are you sure?');" href="deletepost.php?delpostid=<?php echo $result['id']; ?>">Delete</a></td>
						</tr>
						<?php 	} } ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    <?php include 'inc/footer.php'; ?>
