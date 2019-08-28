<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    $userid = session::get('userid');
    $role = session::get('UserRole');
 ?>

        <div class="grid_10">
		
    <div class="box round first grid">
        <h2>Update Post</h2>


        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $fm->validation($_POST['name']);
                $username = $fm->validation($_POST['username']);
                $email = $fm->validation($_POST['email']);
                $details = $fm->validation($_POST['details']);
    
                 $sqlupdate = "UPDATE tbl_user 
                SET 
                name='$name',
                username='$username',
                email='$email',
                details='$details'
                WHERE id = '$userid'";

                $updated_row = $db->update($sqlupdate);

                if ($updated_row) {
                    $_SESSION['updatesuccess'] ="";
                }else{
                    echo "";
                    }
               }
     ?>         


                <div class="block">  
                <?php 
                    $sqlprof = "SELECT * FROM tbl_user WHERE id = '$userid'";
                    $getuser = $db->select($sqlprof);
                    if ($getuser) {
                        while ($result = $getuser->fetch_assoc()) {
                            
                ?>             
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <input type="text" name="details" value="<?php echo $result['details']; ?>" class="medium" />
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
                       <?php   } } ?>
                </div>
            </div>
        </div>
               
        <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });

        <?php include 'inc/footer.php'; ?>

