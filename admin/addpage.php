<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
    <div class="box round first grid">
        <h2>Add New Post</h2>


        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $fm->validation($_POST['name']);
                $body = $fm->validation($_POST['body']);
        

                $name = mysqli_real_escape_string($db->conn, $name);
                $body = mysqli_real_escape_string($db->conn, $body);



                if (empty($name) || empty($body)) {
                    echo "<span style='color: red;'>Field must Not be empty</span>";
            } else {
 
                $sqlinsert = "INSERT INTO tbl_pages(name, body) VALUES ('$name', '$body')";
                $post_insert = $db->insert($sqlinsert);
                if ($post_insert) {
                    echo "<span style='color: greed;'>Page Created Successfully</span>";
                }else{
                    echo "<span style='color: red;'>page not Created</span>";
                }
               
                    }
                 }

            ?>         

                <div class="block">               
                 <form action="addpage.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       <?php if (isset($_SESSION['sesuccess'])) { ?>
                        <p style="color: green;"> Data Inserted Successfully...</p> 
                       <?php   } ?>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                    
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
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

<?php unset($_SESSION['sesuccess']); ?>
<?php unset($_SESSION['title_error']); ?>
<?php unset($_SESSION['body_error']); ?>
<?php unset($_SESSION['tags_error']); ?>
<?php unset($_SESSION['author_error']); ?>
<?php unset($_SESSION['notupload']); ?>
<?php unset($_SESSION['fexists']); ?>