<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
		
    <div class="box round first grid">
        <h2>Add New User</h2>
       <div class="block copyblock"> 
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Username = $fm->validation($_POST['Username']);     
            $Password = $fm->validation(md5($_POST['Password']));     
            $role = $fm->validation($_POST['role']);     


            $Username = mysqli_real_escape_string($db->conn, $Username);
            $Password = mysqli_real_escape_string($db->conn, $Password);
            $role = mysqli_real_escape_string($db->conn, $role);

           if (empty($Username) || empty($Password) || empty($role)) {
               echo "<span style='color: red;'>Field must not be empty </span>";
           }else{
                $sql = "INSERT INTO tbl_user(username, password, role) VALUES('$Username', '$Password', '$role')";
                $insertcat = $db->insert($sql);
                
                if ($insertcat) {
                   echo "<span> User Created Successfully </span>";
                }else{
                    echo "<span> Not Created... </span>";
                }
           }
        }

        ?>
         <form action="" method="post">
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
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="Username" placeholder="Enter Username..." class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="text" name="Password" placeholder="Enter Password..." class="medium" />
                    </td>
                </tr>
                
                 <tr>
                    <td>
                        <label>User role</label>
                    </td>
                    <td>
                       <select id="select" name="role">
                           <option value="">select role</option>
                           <option value="3">Admin</option>
                           <option value="1">Author</option>
                           <option value="2">Editor</option>
                       </select>
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

    <?php include 'inc/footer.php'; ?>

    <?php unset($_SESSION['name_error']); ?>
    <?php unset($_SESSION['insertsuccess']); ?>
    <?php unset($_SESSION['errorinsert']); ?>