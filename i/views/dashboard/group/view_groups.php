<?php

$allGroups = $getFromU->getGroups();

// var_dump($allUsers);

?>

<div class="container">

    <?php


if(isset($_SESSION['success'])){
    echo '
    <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">'.$_SESSION['success'].'!</h4>
  <p>'.$_SESSION['success'].'</p>
 
</div>
    
    
    ';
}

unset($_SESSION['success'])


?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-fullheight">
                <div class="card-body">
                    <h5 class="box-title">Users Table</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Group Name</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1; 
                            foreach($allGroups as $group): ?>
                            <tr>
                                <th scope="row"><?= $i;?></th>
                                <td><?= $group->group_name;?></td>

                                <td>
                                    <div>
                                        <a href="?edit_group=<?= $group->id?>"
                                            class="btn btn-primary btn-floating btn-md" type="button">Edit<span
                                                data-feather="pencil"></span></a>
                                        <a href="?delete_group=<?= $group->id;?>"
                                            class="btn btn-danger btn-floating btn-md" type="button">Delete<span
                                                data-feather="trash"></span></a>
                                    </div>

                                </td>
                            </tr>
                            <?php $i++; endforeach;?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>