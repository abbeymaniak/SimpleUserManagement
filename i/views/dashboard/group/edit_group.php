<?php

if(isset($_GET['edit_group'])){

$group_id = $_GET['edit_group'];

$group_data = $getFromU->groupData($group_id);

// var_dump($group_data);

?>

<div class="container">

    <?php

if(isset($errorGroup)) 
{
   echo '<div class="alert alert-danger" role="alert"> '. $errorGroup .'
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
        <input type="hidden" name="group_id" value="<?= $group_id;?>" />
        <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control w-50" placeholder="Enter Username" name="group_name"
                value="<?= $group_data->group_name;?>">
            <small class="form-text text-danger"
                style=" color: red;"><?php if(isset($errorGroup)){ echo $errorGroup;} ?></small>
        </div>




        <div class="form-group">

            <button type="submit" class="btn btn-primary mt-2 form-control w-50" name="editGroup">Submit</button>
        </div>
    </form>


</div>
<?php
}

else{

    header("Location: ?dashboard");
}






    