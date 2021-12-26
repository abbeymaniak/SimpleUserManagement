<?php

$allUsers = $getFromU->getUsers();

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
                                <th scope="col">Username</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Date Of Birth</th>
                                <th scope="col">User Group</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach($allUsers as $user): ?>
                            <tr>
                                <th scope="row"><?= $i;?></th>
                                <td><?= $user->username;?></td>
                                <td><?= $user->name;?></td>
                                <td><?= $user->surname;?></td>
                                <td><?= $user->dob;?></td>
                                <td><?= ($user->group_name) ? $user->group_name : 'No group';?></td>
                                <td>
                                    <div>
                                        <a href="?edit_user=<?= $user->id?>" class="btn btn-primary btn-floating btn-md"
                                            type="button">Edit<span data-feather="pencil"></span></a>
                                        <a href="?delete_user=<?= $user->id;?>"
                                            class="btn btn-danger btn-floating btn-md" type="button">Delete<span
                                                data-feather="deletes"></span></a>
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