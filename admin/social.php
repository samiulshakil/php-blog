<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>


        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $facebook = $fm->validation($_POST['facebook']);
                $twitter = $fm->validation($_POST['twitter']);
                $linkdin = $fm->validation($_POST['linkdin']);
                $google = $fm->validation($_POST['google']);
             
                $facebook = mysqli_real_escape_string($db->conn, $facebook);
                $twitter = mysqli_real_escape_string($db->conn, $twitter);
                $linkdin = mysqli_real_escape_string($db->conn, $linkdin);
                $google = mysqli_real_escape_string($db->conn, $google);

            if (empty($facebook) || empty($twitter) || empty($linkdin) || empty($google)) {
                echo "Field must not be empty";

            }else{
                $sqlupdate = "UPDATE tbl_social 
                SET 
                facebook='$facebook',
                twitter='$twitter',
                linkdin='$linkdin',
                google='$google'
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

        <?php 
        $sql = "SELECT * FROM tbl_social WHERE id='1'";
        $tbl_social = $db->select($sql);
        if ($tbl_social) {
            while ($result = $tbl_social->fetch_assoc()) {
                        
        ?>

        <div class="block">               
         <form action="social.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo $result['facebook']; ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" value="<?php echo $result['twitter']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="linkdin" value="<?php echo $result['linkdin']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="google" value="<?php echo $result['google']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
         <?php  } } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
