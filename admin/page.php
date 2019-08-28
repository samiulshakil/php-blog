<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL ) {
       header("location: index.php");
    }else{
        $pageid = $_GET['pageid'];
    }
?>
<style type="text/css">
    .actiondel{
        margin-left: 10px;
    }
</style>

        <div class="grid_10">
		
    <div class="box round first grid">
        <h2>Update Page</h2>


        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $fm->validation($_POST['name']);
                $body = $fm->validation($_POST['body']);
        

                $name = mysqli_real_escape_string($db->conn, $name);
                $body = mysqli_real_escape_string($db->conn, $body);



                if (empty($name) || empty($body)) {
                    echo "<span style='color: red;'>Field must Not be empty</span>";
            } else {
 
                $sqlupdate = "UPDATE tbl_pages 
                SET 
                name='$name',
                body='$body'
                WHERE id = '$pageid'";

                $updated_row = $db->update($sqlupdate);
                if ($updated_row) {
                    echo "<span style='color: greed;'>Page Created Successfully</span>";
                }else{
                    echo "<span style='color: red;'>page not Created</span>";
                }
               
                    }
                 }

             ?>         
      

                <div class="block"> 
                <?php 
                $sql = "SELECT * FROM tbl_pages WHERE id='$pageid';";
                $tbl_pages = $db->select($sql);
                if ($tbl_pages) {
                    while ($result = $tbl_pages->fetch_assoc()) {
                                
                ?>              
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       <?php if (isset($_SESSION['sesuccess'])) { ?>
                        <p style="color: green;"> Data Inserted Successfully...</p> 
                       <?php   } ?>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                    
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body" rows="20" cols="140">
                                    <?php echo $result['body']; ?>
                                </textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                                <span class="actiondel"><a href="delpage.php?delid=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure?');" >Delete</a></span>
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
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