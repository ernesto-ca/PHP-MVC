 <?php

    $interval = 5;
    $index = 0;


    if (!isset($_SESSION['logged'])) {
        header("Location:index.php?page=login");
        return;
    } else {
        if (!$_SESSION['logged']) {
            header("Location:index.php?page=login");
            return;
        }
    }

    // Check if it is a page (pg) number and a interval (in) number to do the selection query
    if (isset($_GET['pg']) && isset($_GET['in'])) {
        $interval = $_GET['in'];
        $index = $_GET['pg'] == 1 ? 0 : ($interval * $_GET['pg']) - $interval;
    }

    // Set the interval selected to restart the selection query
    if (isset($_POST['total_number_to_see'])) {
        $interval =  $_POST['total_number_to_see'];
    }


    // Get total pages number that can be displayed
    $totalPages = FormController::ctrGetTotalPages($interval);

    // Do the selection query with the index and interval
    $users = FormController::ctrSelectUsers($index, $interval);



    if (isset($_POST['update'])) {
        $update = FormController::ctrUpdateUser();
        if ($update) {
    ?>
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             User successfully Updated
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
     <?php
        }

        echo "<script>window.location.href = window.location.href; </script>";
    }

    if (isset($_POST['delete'])) {
        $delete = FormController::ctrDeleteUser();
        if ($delete) {
        ?>
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             User successfully Deleted
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
 <?php
        }
        echo "<script>window.location.href = window.location.href; </script>";
    }
    ?>


 <script type="text/javascript">
     function setValuesIntoModal(id, user, fname) {
         document.getElementById("idU").value = id;
         document.getElementById("user").value = user;
         document.getElementById("fname").value = fname;
     }

     function setValuesIntoDeleteModal(id) {
         document.getElementById("idUD").value = id;
     }
 </script>
 <!-- Content Start -->
 <div class="container">
     <h2 class="mb-5 text-center">Users In DB</h2>
     <form class="mb-3" method="POST" action="index.php?page=crud">
         <div class="input-group">
             <label class="form-control" for="total_number">Select by interval:</label>
             <select class="form-control" name="total_number_to_see" id="total_number">
                 <?php
                    if ($interval == 5) {
                        echo "
                    <option value='2'>2</option>
                    <option value='5' selected>5</option>
                    <option value='10'>10</option>
                    ";
                    } elseif ($interval == 2) {
                        echo "
                    <option value='2' selected>2</option>
                    <option value='5' >5</option>
                    <option value='10'>10</option>
                    ";
                    } elseif ($interval == 10) {
                        echo "
                    <option value='2' >2</option>
                    <option value='5' >5</option>
                    <option value='10' selected>10</option>
                    ";
                    }
                    ?>

             </select>
             <input type="submit" class="btn btn-primary" value="Apply">
         </div>
     </form>

     <nav aria-label="Page navigation">
         <ul class="pagination">
             <li class="page-item">
                 <a class="page-link" href="index.php?page=crud&pg=1&in=<?php echo $interval ?>" aria-label="First">
                     <span aria-hidden="true">&laquo;</span>
                 </a>
             </li>
             <?php
                for ($i = 1; $i <= $totalPages; $i++) {

                    // Is a page specified that match with the number of the page-item? OR Is index equals to 0 and this is the first page-item?
                    if ((isset($_GET['pg']) && $_GET['pg'] == $i) || ($index == 0 && $i == 1)) {
                        echo "<li class='page-item active'> <a class='page-link' href='index.php?page=crud&pg=$i&in=$interval'> $i </a> </li>";
                    } else {
                        echo "<li class='page-item'> <a class='page-link' href='index.php?page=crud&pg=$i&in=$interval'> $i </a> </li>";
                    }
                }
                ?>
             <li class="page-item">
                 <a class="page-link" href="index.php?page=crud&pg=<?php echo $totalPages ?>&in=<?php echo $interval ?>" aria-label="Last">
                     <span aria-hidden="true">&raquo;</span>
                 </a>
             </li>
         </ul>
     </nav>

     <table class="table table-bordered table-striped">
         <thead>
             <tr>
                 <th>User</th>
                 <th>Full Name</th>
                 <th>Actions</th>
             </tr>
         </thead>
         <tbody>
             <?php
                foreach ($users as $key  => $value) {
                ?>
                 <tr>
                     <td><?php echo $value["user"] ?></td>
                     <td><?php echo $value["name"] ?></td>
                     <td>
                         <div class="btn-group">
                             <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="setValuesIntoModal('<?php echo $value['id'] ?>', '<?php echo $value['user'] ?>', '<?php echo $value['name'] ?>')"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                             <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setValuesIntoDeleteModal('<?php echo $value['id'] ?>')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                         </div>
                     </td>
                 </tr>

             <?php } ?>

         </tbody>
     </table>
 </div>
 <!-- Content End -->

 <!-- Edit Modal Start -->
 <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="updateModalLabel">Edit User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="POST">
                     <input type="number" name="u_id_u" id="idU" hidden>
                     <div class="input-group mb-3">
                         <span class="input-group-text">
                             <i class="fa fa-user-circle" aria-hidden="true"></i>
                         </span>
                         <input type="text" class="form-control" placeholder="New User Name" name="u_name_u" id="user" value="" required>
                     </div>
                     <div class="input-group mb-3">
                         <span class="input-group-text">
                             <i class="fa fa-user" aria-hidden="true"></i>
                         </span>
                         <input type="text" class="form-control" placeholder="New Full Name" name="u_fname_u" id="fname" value="" required>
                     </div>
                     <div class="input-group mb-3">
                         <span class="input-group-text">
                             <i class="fa fa-key" aria-hidden="true"></i>
                         </span>
                         <input type="password" class="form-control" placeholder="New Password" name="u_password_u">
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-success" name="update">Save changes</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- Edit Modal End -->

 <!-- Delete Modal Start -->
 <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="POST">
                     <input type="number" name="u_id_d" id="idUD" hidden>
                     <p class="modal-text"> Are you sure to delete this user permanently?</p>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- Delete Modal End -->
