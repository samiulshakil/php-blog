<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
<style type="text/css">
    .leftside {
        float: left;
        width: 70%;
    }
    .rightside {
        width: 20%;
        float: left;
    }
    .rightside img {
        width: 140px;
        height: 140px;
    }
</style>

 <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = $fm->validation($_POST['title']);
                $slogan = $fm->validation($_POST['slogan']);
             
                $title = mysqli_real_escape_string($db->conn, $title);
                $slogan = mysqli_real_escape_string($db->conn, $slogan);

                $target_dir = "uploads/";
                $target_file = $target_dir . 'logo'.'.'.pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));

                if (empty($title) || empty($slogan)) {
                $_SESSION['title_error'] = "";
                $_SESSION['slogan_error'] = "";

            } else {

                if (!empty($_FILES["image"]["name"])) {

                $check = $_FILES["image"]["tmp_name"];
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["image"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "png" ) {
                    echo "Sorry, only  PNG file is allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                   $_SESSION['notupload'] = "";
                   // if everything is ok, try to upload file
            } 
             else {

                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file); 

                $sqlupdate = "UPDATE title_slogan 
                SET 
                title='$title',
                slogan='$slogan',
                image='$target_file'
                WHERE id = '1'";

                $updated_row = $db->update($sqlupdate);

                if ($updated_row) {
                    $_SESSION['updatesuccess'] ="";
                }else{
                    echo "Not Updated";
                        }
               
                    }
                }else{
                $sqlupdate = "UPDATE title_slogan 
                SET 
                title='$title',
                slogan='$slogan'
                WHERE id = '1'";

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


<div class="box round first grid">
    <h2>Update Site Title and Description</h2>
       <?php 
        $sql = "SELECT * FROM title_slogan WHERE id='1'";
        $title_slogan = $db->select($sql);
        if ($title_slogan) {
            while ($result = $title_slogan->fetch_assoc()) {
                        
        ?>

        <?php if (isset($_SESSION['updatesuccess'])) { ?>
          <p style="color: green;"> Data Updated Successfully...</p> 
        <?php   } ?>

            <?php if (isset($_SESSION['title_error'])) { ?>
              <p style="color: red;"> Title is Required</p> 
            <?php   } ?>

            <?php if (isset($_SESSION['slogan_error'])) { ?>
              <p style="color: red;"> Title is Required</p> 
            <?php   } ?>

        <div class="block sloginblock"> 
            <div class="leftside">           
                <form action="" method="post" enctype="multipart/form-data">
                  <table class="form">					
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                        </td>
                    </tr>
    				 <tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                        </td>
                    </tr>
                        <tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
    			
    				 <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
                </form>
            </div>
            <div class="rightside">
                <img src="<?php echo $result['image'] ?>" alt="logo">
                logo
            </div>
        </div>
      <?php  } } ?>
    </div>
</div>
<?php include 'inc/footer.php'; ?>

<?php unset($_SESSION['updatesuccess']); ?>
<?php unset($_SESSION['title_error']); ?>
<?php unset($_SESSION['slogan_error']); ?>
<?php unset($_SESSION['fexists']); ?>
<?php unset($_SESSION['notupload']); ?>
