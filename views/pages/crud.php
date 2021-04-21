 <?php

    if (!isset($_SESSION['logged'])) {
        header("Location:index.php?page=login");
        return;
    } else {
        if (!$_SESSION['logged']) {
            header("Location:index.php?page=login");
            return;
        }
    }


    $users = FormController::ctrSelectUsers();

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
