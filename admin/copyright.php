<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php 

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $copyright = $fm->validation($_POST['copyright']);

                $copyright = mysqli_real_escape_string($db->conn, $copyright);

            if (empty($copyright)) {
                echo "Field must not be empty";

            }else{
                $sqlupdate = "UPDATE tbl_footer 
                SET 
                copyright='$copyright'
                WHERE id = '1'";

                $updated_row = $db->update($sqlupdate);

                if ($updated_row) {
                    echo "<span style='color:green;'>Data Updated Successfully</span>";
                }else{
                    echo "Not Updated";
                        }
            }

            }
        ?>

                <div class="block copyblock"> 
                 <form method="post" action="">
                    <table class="form">
                           <?php 
                            $sql = "SELECT * FROM tbl_footer WHERE id='1'";
                            $title_slogan = $db->select($sql);
                            if ($title_slogan) {
                                while ($result = $title_slogan->fetch_assoc()) {
                                            
                            ?>					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['copyright']; ?>" name="copyright" class="large" />
                            </td>
                        </tr>
						<?php } } ?>
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
       
<?php include 'inc/footer.php'; ?>
