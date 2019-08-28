<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php 
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL ) {
       echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $msgid = $_GET['msgid'];
    }
?>


<div class="grid_10">
		
    <div class="box round first grid">
        <h2>View Message</h2>
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'inbox.php';</script>";
             } ?>

<div class="block">               
     <form action="" method="post" enctype="multipart/form-data">
    <?php 
        $sql = "SELECT * FROM tbl_contact WHERE id='$msgid'";
        $tbl_contact = $db->select($sql);
        if ($tbl_contact) {
            $i=0;
            while ($result = $tbl_contact->fetch_assoc()) {
            $i++;   
      ?>
        <table class="form">
            <tr>
                <td>
                    <label>Name</label>
                </td>
                <td>
                    <input type="text" name="name" readonly value="<?php echo $result['firstname'].' '.$result['lastname']; ?>" class="medium" />
                </td>
            </tr>

             <tr>
                <td>
                    <label>Email</label>
                </td>
                <td>
                    <input type="text" name="name" readonly value="<?php echo $result['email']; ?>" class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Date</label>
                </td>
                <td>
                    <input type="text" name="name" readonly value="<?php echo $fm->formatdate($result['date']); ?>" class="medium" />
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Message</label>
                </td>
                <td>
                    <textarea class="tinymce" readonly name="body" rows="15" cols="130">
                     <?php echo $result['body']; ?>
                    </textarea>
                </td>
            </tr>

			<tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="OK" />
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

