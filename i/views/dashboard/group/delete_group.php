<?php

if(isset($_GET['delete_group'])){

    $group_id = $_GET['delete_group'];

   $group_data = $getFromU->groupData($group_id);

    ?>

<div class="container">



    <div class="card card-content" style="margin: 50px auto;">
        <div class="card-heading text-center py-4">
            <h4> Delete Group</h4>
        </div>

        <div class="card-body text-center block">
            <div> Are you sure you want to delete
                <span class=" text-uppercase font-weight-bold"><?= $group_data->group_name?></span> ?
            </div>

            <div class="flex text-center py-4">

                <a href="?view_group" class="btn btn-success mr-3" type="button">No, Leave User</a>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="group_id" value="<?= $group_id; ?>">
                    <button class="btn btn-danger" type="submit" name="deleteGroup">Yes, Delete Group</button>
                </form>
            </div>
        </div>


    </div>





</div>



<?php

}