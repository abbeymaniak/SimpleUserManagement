<?php

// $groups = $getFromU->groupInfo();
$bulk_group = $getFromU->getGroups();
// echo '<pre>';
// var_dump($single_group);
// var_dump($groups);
// exit;
?>


<div class="container">

    <?php 

foreach($bulk_group as $single_group):
?>
    <div class="card mb-4">

        <div class="card-header">
            <h3> <?= $single_group->group_name;?></h3>

        </div>
        <div class="card-body">
            <h5 class="box-title">Users</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Date Of Birth</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
$i=1;
            $single_group_id = $single_group->id;
            $group_members = $getFromU->userGroupData($single_group_id);

            foreach($group_members as $group_member){

?>


                    <tr>
                        <th scope="row"><?= $i;?></th>
                        <td><?= $group_member->name?></td>
                        <td><?= $group_member->surname?></td>
                        <td><?= $group_member->dob?></td>
                    </tr>




                    <?php
$i++;

            }
            
            
            
            ?>

                </tbody>
            </table>
        </div>

    </div>



    <?php endforeach; ?>

</div>