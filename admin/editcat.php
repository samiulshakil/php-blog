<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL ) {
       header("location: catlist.php");
    }else{
        $catid = $_GET['catid'];
    }
?>

<div class="grid_10">
		
    <div class="box round first grid">
        <h2>Add New Category</h2>
       <div class="block copyblock"> 
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $fm->validation($_POST['name']);            
            $name = mysqli_real_escape_string($db->conn, $name);

           if (empty($name)) {
               $_SESSION['name_error'] = "";
           }else{
                $sql = "UPDATE tbl_category SET name = '$name' WHERE id = '$catid'";
                $updatecat = $db->update($sql);
                
                if ($updatecat) {
                   $_SESSION['upsuccess'] = "";
                }else{
                    $_SESSION['errorupdate'] = "";
                }
           }
        }else{
            echo "";
        }
  ?>

        <?php 
            $sql = "SELECT * FROM tbl_category WHERE id = '$catid' ORDER BY id DESC";
            $cat = $db->select($sql);
            $result = $cat->fetch_assoc();
        ?>

         <form action="" method="post">
            <table class="form">

            <?php if (isset($_SESSION['name_error'])) { ?>
            <p style="color: red;"> * Category Name is Required</p>	
            <?php   } ?>

             <?php if (isset($_SESSION['upsuccess'])) { ?>
            <p style="color: green;"> Category  Updated Successfully... </p> 
            <?php   } ?>

            <?php if (isset($_SESSION['errorupdate'])) { ?>
            <p style="color: green;"> Category  Not Updated Successfully... </p> 
            <?php   } ?>			

                <tr>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>

    <?php include 'inc/footer.php'; ?>

    <?php unset($_SESSION['name_error']); ?>
    <?php unset($_SESSION['upsuccess']); ?>
    <?php unset($_SESSION['errorupdate']); ?>