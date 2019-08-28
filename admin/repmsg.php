<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php 
    if (!isset($_GET['repid']) || $_GET['repid'] == NULL ) {
       echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $repid = $_GET['repid'];
    }
?>


<div class="grid_10">
		
    <div class="box round first grid">
        <h2>View Message</h2>
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $to        = $fm->validation($_POST['toemail']);
                $from      = $fm->validation($_POST['fromemail']);
                $subject   = $fm->validation($_POST['subject']);
                $message   = $fm->validation($_POST['message']);
                $sendmail  = mail($to, $subject, $message, $from);

                if ($sendmail) {
                    echo '<p style="color: green;"> Data Inserted Successfully...</p>';
                }else{
                    echo " <p style='color: red;''> Message Not Sent </p>";
                }

             } ?>

<div class="block">               
     <form action="" method="post" enctype="multipart/form-data">
    <?php 
        $sql = "SELECT * FROM tbl_contact WHERE id='$repid'";
        $tbl_contact = $db->select($sql);
        if ($tbl_contact) {
            $i=0;
            while ($result = $tbl_contact->fetch_assoc()) {
            $i++;   
      ?>
        <table class="form">

             <tr>
                <td>
                    <label>To</label>
                </td>
                <td>
                    <input type="text" name="toemail" readonly value="<?php echo $result['email']; ?>" class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>From</label>
                </td>
                <td>
                    <input type="text" name="fromemail" placeholder="Please enter your email" class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Subject</label>
                </td>
                <td>
                    <input type="text" name="subject" placeholder="Enter Subject" class="medium" />
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Message</label>
                </td>
                <td>
                    <textarea class="tinymce" name="message" rows="15" cols="130">
                     
                    </textarea>
                </td>
            </tr>

			<tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="send" />
                </td>
            </tr>
        </table>
    <?php } } ?>
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

