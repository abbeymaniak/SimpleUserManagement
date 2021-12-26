<?php

if(isset($_GET['edit_user'])){

    $user_id = $_GET['edit_user'];

   $user_data = $getFromU->userDataWithGroup($user_id);
   $groups = $getFromU->getGroups();

//    var_dump($groups);

//    var_dump($user_data);
   ?>
<div class="container">

    <?php

if(isset($errorPass) || isset($errorName) || isset($errorUsername) || isset($errorDob) || isset($errorGroup)) 
{
   echo '<div class="alert alert-danger" role="alert">'.
  $errorPass .' <br> '. $errorName .' <br> '. $errorUsername .'<br> '. $errorDob .'<br> '. $errorGroup .'
</div>';
}

if(isset($successHeader) && isset($successMessage)){
    echo '
    <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">'.$successHeader.'!</h4>
  <p>'.$successMessage.'</p>
 
</div>
    
    
    ';
}


?>

    <form method="POST">
        <input type="hidden" name="user_id" value="<?= $user_data->id;?>" />
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control w-50" placeholder="Enter Username" name="username"
                value="<?= $user_data->username;?>">
            <small class="form-text text-danger"
                style=" color: red;"><?php if(isset($errorUsername)){ echo $errorUsername;} ?></small>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control w-50" placeholder="Password" name="password">
            <small class="form-text text-danger"><?php if(isset($errorPass)){ echo $errorPass;} ?></small>
        </div>
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control w-50" placeholder="First Name" name="firstname"
                value="<?= $user_data->name?>">
            <small class="form-text text-danger"><?= isset($errorName) ? $errorName : ''?></small>
        </div>
        <div class="form-group">
            <label>Surname</label>
            <input type="text" class="form-control w-50" placeholder="Surname" name="lastname"
                value="<?= $user_data->surname?>">
            <small class=" form-text text-danger"><?= isset($errorName) ? $errorName : ''?></small>
        </div>

        <div class="form-group">
            <label>Date Of Birth</label>
            <input type="date" class="form-control w-50" name="dob" value="<?= $user_data->dob;?>">
            <small class="form-text text-danger"><?= isset($errorDob) ? $errorDob : ''?></small>
        </div>


        <div class="form-group">
            <label>Groups</label>
            <select class=" form-control form-control-md w-50" name="group">
                <option value="">Select Group</option>
                <?php
                if(!empty($groups)){
                foreach($groups as $group): ?>
                <option value="<?= $group->id; ?>"
                    <?php if($user_data->user_group_id == $group->id){ echo 'selected';} ?>>
                    <?= $group->group_name;?></option>
                <?php 
            
            
            endforeach;
         } ?>

            </select>
            <small class="form-text text-danger"><?= isset($errorGroup) ? $errorGroup : ''?></small>
        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary mt-2 form-control w-50" name="editUser">Submit</button>
        </div>
    </form>


</div>
<?php
}