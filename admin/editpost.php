<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL ) {
       header("location: postlist.php");
    }else{
        $postid = $_GET['editpostid'];
    }
?>

        <div class="grid_10">
		
    <div class="box round first grid">
        <h2>Update Post</h2>


        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = $fm->validation($_POST['title']);
                $body = $fm->validation($_POST['body']);
                $tags = $fm->validation($_POST['tags']);
                $author = $fm->validation($_POST['author']);
                $catid = $_POST['catid'];

                $catid = mysqli_real_escape_string($db->conn, $catid);
                $title = mysqli_real_escape_string($db->conn, $title);
                $body = mysqli_real_escape_string($db->conn, $body);
                $tags = mysqli_real_escape_string($db->conn, $tags);
                $author = mysqli_real_escape_string($db->conn, $author);

                $target_dir = "uploads/";
                $target_file = $target_dir .rand(2331,4352). basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if (empty($title) || empty($body) || empty($tags) || empty($author)) {
                $_SESSION['title_error'] = "";
                $_SESSION['body_error'] = "";
                $_SESSION['tags_error'] = "";
                $_SESSION['author_error'] = "";
            } else {

                if (!empty($_FILES["image"]["name"])) {

                $check = $_FILES["image"]["tmp_name"];
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $_SESSION['fexists'] = "";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["image"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                   $_SESSION['notupload'] = "";
                   // if everything is ok, try to upload file
            } 
             else {

                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file); 

                $sqlupdate = "UPDATE tbl_post 
                SET 
                catid='$catid',
                title='$title',
                body='$body',
                image='$target_file',
                author='$author',
                tags='$tags'
                WHERE id = '$postid'";

                $updated_row = $db->update($sqlupdate);

                if ($updated_row) {
                    $_SESSION['updatesuccess'] ="";
                }else{
                    echo "Not Updated";
                        }
               
                    }
                }else{
                $sqlupdate = "UPDATE tbl_post 
                SET 
                catid='$catid',
                title='$title',
                body='$body',
                author='$author',
                tags='$tags'
                WHERE id = '$postid'";

                $updated_row = $db->update($sqlupdate);

                if ($updated_row) {
                    $_SESSION['updatesuccess'] ="";
                }else{
                    echo "";
                    }
                }
             }
        } 
     ?>         
            <?php if (isset($_SESSION['fexists'])) { ?>
            <p style="color: red;"> file already exists</p> 
            <?php   } ?>

            <?php if (isset($_SESSION['notupload'])) { ?>
            <p style="color: red;"> File Was Not Uploaded...</p> 
            <?php   } ?>

            <?php if (isset($_SESSION['title_error'])) { ?>
                <p style="color: red;"> Title is Required</p> 
            <?php   } ?>

                <div class="block">  
                <?php 
                    $sqledit = "SELECT * FROM tbl_post WHERE id = '$postid'";
                    $editpost = $db->select($sqledit);
                    if ($editpost) {
                        while ($editpost_result = $editpost->fetch_assoc()) {
                            
                ?>             
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       <?php if (isset($_SESSION['updatesuccess'])) { ?>
                        <p style="color: green;"> Data Updated Successfully...</p> 
                       <?php   } ?>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $editpost_result['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="catid">
                                    <option value="">Select Category</option>
                                    <?php 
                                        $sql = "SELECT * FROM tbl_category";
                                        $Category = $db->select($sql);
                                        if ($Category) {
                                            while ($result = $Category->fetch_assoc()) {
                                    ?>    
                                    <option 
                                        <?php 
                                            if ($editpost_result['catid'] == $result['id'] ) { ?>
                                               
                                          selected = "selected";

                                   <?php  } ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                   
                                     <?php  } } ?>
                                </select>
                            </td>
                        </tr>
                   
            
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $editpost_result['image']; ?>" height="50px" width="100px">
                                <input type="file" name="image" />
                            </td>
                        </tr>
                      <?php if (isset($_SESSION['body_error'])) { ?>
                         <p style="color: red;"> Contents is Required..</p> 
                       <?php   } ?>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $editpost_result['body']; ?>"
                                </textarea>
                            </td>
                        </tr>
                        <?php if (isset($_SESSION['tags_error'])) { ?>
                            <p style="color: red;"> Tags is Required.</p> 
                       <?php   } ?>
                         <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $editpost_result['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                       <?php if (isset($_SESSION['author_error'])) { ?>
                         <p style="color: red;"> Author is Required</p> 
                       <?php   } ?>
                         <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $editpost_result['author']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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

<?php unset($_SESSION['updatesuccess']); ?>
<?php unset($_SESSION['title_error']); ?>
<?php unset($_SESSION['body_error']); ?>
<?php unset($_SESSION['tags_error']); ?>
<?php unset($_SESSION['author_error']); ?>
<?php unset($_SESSION['notupload']); ?>
<?php unset($_SESSION['fexists']); ?>