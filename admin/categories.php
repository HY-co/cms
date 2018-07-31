<?php include "includes/admin_header.php" ?>

   
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        
                        <div class="col-xs-6">
                        
                        <?php 
                        
                        if (isset($_POST["submit"])) {
                            $cat_title = $_POST["cat_title"];
                            if ($cat_title == "" || empty($cat_title)) {
                                echo "This field should not be empty";
                            }else {
                                $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
                                
                                $create_category = mysqli_query($connection, $query);
                                
                                if (!$create_category) {
                                    die("QUERY FAILED " . mysqli_error($connection));
                                }
                            }
                        }
                            
                        ?>
                        
                        <form action="" method="post">
                           <div class="form-group">
                             <label for="cat_title">Add Category</label>
                              <input class="form-control" type="text" name="cat_title">
                           </div>
                           
                           <div>
                               <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                           </div>
                            
                        </form>
                        
                        <?php 
                        if (isset($_GET["edit"])) {
                            $cat_id = $_GET["edit"];
                            
                            include "includes/update_category.php";
                        }    
                            
                        ?>
                        
                        </div>
                        
                        <div class="col-xs-6">
                            <?php
                            $query = "SELECT * FROM categories LIMIT 3";
                            $categories = mysqli_query($connection, $query);
                            ?>
                           <table class="table table-bordered table-hover">
                               <thead>
                                   <tr>
                                       <th>Id</th>
                                       <th>Category Title</th>
                                   </tr>
                               </thead>
                               <tbody>
                                  <?php
                                  while ($row = mysqli_fetch_assoc($categories)) {
                                      $cat_id = $row["cat_id"];
                                      $cat_title = $row["cat_title"];
                                      
                                      echo "<tr>";
                                      echo "<td>${cat_id}</td>";
                                      echo "<td>${cat_title}</td>";
                                      echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
                                      echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
                                      echo "</tr>";
                                  }
                                  ?>
                                  
                                  <?php 
                                      if (isset($_GET["delete"])) {
                                          $to_delete_category_id = $_GET["delete"];
                                          $query = "DELETE FROM categories WHERE cat_id={$to_delete_category_id}";
                                          $deleted = mysqli_query($connection, $query);
                                          
                                          if (!$deleted) {
                                              die("DELETE FAILED " . mysqli_error($connection));
                                          }
                                          
                                          header("Location: categories.php");
                                      } 
                                  ?>
                               </tbody>
                           </table>
                            
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>