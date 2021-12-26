<?php

if(isset($_GET['delete_user'])){

    $user_id = $_GET['delete_user'];

    $user_data = $getFromU->userDataWithGroup($user_id);

    ?>

<div class="container">



    <div class="card card-content" style="margin: 50px auto;">
        <div class="card-heading text-center py-4">
            <h4> Delete User</h4>
        </div>

        <div class="card-body text-center">
            <div>
                Are you sure you want to delete <span class="text-uppercase font-weight-bold"><?= $user_data->name?>
                    <?= $user_data->surname;?></span> in
                <?= $user_data->group_name;?> ?
            </div>

            <div class="flex text-center py-4">

                <a href="?view_user" class="btn btn-success mr-3" type="button">No, Leave User</a>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                    <button class="btn btn-danger" type="submit" name="deleteUser">Yes, Delete User</button>
                </form>
            </div>
            </divv>
        </div>







    </div>



    <?php

}