<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
	<div class="box round first grid">
	    <h2>Category List</h2>
	    <?php 
	    	if (isset($_GET['delcat'])) {
	    		$delid = $_GET['delcat'];
	    		$delsql = "DELETE FROM tbl_category WHERE id='$delid'";
	    		$deldata = $db->delete($delsql);
	    		if ($deldata) {
	    			$_SESSION['delsuccess'] = "";
	    		}else{
	    			$_SESSION['delerror'] = "";
	    		}
	    	}
	    ?>

	    	<?php if (isset($_SESSION['delsuccess'])) { ?>
           		<p style="color: green;"> Category Deleted Successfully... </p>	
            <?php   } ?>

            <?php if (isset($_SESSION['delerror'])) { ?>
            	<p style="color: red;"> Category Not Deleted Successfully... </p>	
            <?php   } ?>

	    <div class="block">        
	        <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM tbl_category";
					$Category = $db->select($sql);
					if ($Category) {
						$i=0;
						while ($result = $Category->fetch_assoc()) {
						$i++;	
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure?');" href="?delcat=<?php echo $result['id']; ?>">Delete</a></td>
				</tr>
				<?php } }else{ echo "<td>No Category Found</td>"; } ?>
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

	<?php unset($_SESSION['delsuccess']); ?>
    <?php unset($_SESSION['delerror']); ?>