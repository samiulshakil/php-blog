<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
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
                $sql = "INSERT INTO tbl_category VALUES(NULL, '$name')";
                $insertcat = $db->insert($sql);
                
                if ($insertcat) {
                   $_SESSION['insertsuccess'] = "";
                }else{
                    $_SESSION['errorinsert'] = "";
                }
           }
        }else{
            echo "";
        }
        ?>
         <form action="addcat.php" method="post">
            <table class="form">

            <?php if (isset($_SESSION['name_error'])) { ?>
            <p style="color: red;"> * Category Name is Required</p>	
            <?php   } ?>

             <?php if (isset($_SESSION['insertsuccess'])) { ?>
            <p style="color: green;"> Category  Inserted Successfully... </p> 
            <?php   } ?>

            <?php if (isset($_SESSION['errorinsert'])) { ?>
            <p style="color: green;"> Category  Not Inserted Successfully... </p> 
            <?php   } ?>			

                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
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
    <?php unset($_SESSION['insertsuccess']); ?>
    <?php unset($_SESSION['errorinsert']); ?>