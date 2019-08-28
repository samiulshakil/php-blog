<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php if (isset($_GET['seenid'])) {
					$seenid = $_GET['seenid'];
					$sql = "UPDATE tbl_contact SET status = '1' WHERE id = '$seenid'";
	                $update_status = $db->update($sql);
	                
	                if ($update_status) {
	                   echo "Message Sent in the seen box";
	                }else{
	                    echo "Message not sent in thek seen box";
	                }
				} ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Message</th>
							<th>Email</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
				<tbody>
				    <?php 
					$sql = "SELECT * FROM tbl_contact WHERE status='0'";
					$tbl_contact = $db->select($sql);
					if ($tbl_contact) {
						$i=0;
						while ($result = $tbl_contact->fetch_assoc()) {
						$i++;	
				    ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $fm->textShorten($result['body'] , 30); ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->formatdate($result['date']); ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">view</a> ||
								<a href="repmsg.php?repid=<?php echo $result['id']; ?>">Reply</a> ||
								<a href="?seenid=<?php echo $result['id']; ?>"" onclick="return confirm('Are you sure?');">Seen</a> 
							</td>
						</tr>
					<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>

	        <div class="box round first grid">
              <h2>Seen Message</h2>
           <?php 
	    	if (isset($_GET['delid'])) {
	    		$delid = $_GET['delid'];
	    		$delsql = "DELETE FROM tbl_contact WHERE id='$delid'";
	    		$deldata = $db->delete($delsql);
	    		if ($deldata) {
	    			echo "Deleted..";
	    		}else{
	    			echo "Not Deleted";
	    		}
	    	}
	    ?>
                <div class="block">        
                   <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Message</th>
							<th>Email</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
				<tbody>
				    <?php 
					$sql = "SELECT * FROM tbl_contact WHERE status='1'";
					$tbl_contact = $db->select($sql);
					if ($tbl_contact) {
						$i=0;
						while ($result = $tbl_contact->fetch_assoc()) {
						$i++;	
				    ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $fm->textShorten($result['body'] , 30); ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->formatdate($result['date']); ?></td>
							<td>
								<a href="?delid=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a> 
							</td>
						</tr>
					<?php } } ?>
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

