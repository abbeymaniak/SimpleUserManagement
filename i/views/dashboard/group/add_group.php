<div class="container">

    <?php



if(isset($successHeader) && isset($successMessage)){
    echo '
    <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">'.$successHeader.'!</h4>
  <p>'.$successMessage.'</p>
 
</div>
    
    
    ';
}


?>

    <h4>Add Group</h4>
    <form method="POST">
        <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control w-50" placeholder="Enter Group Name" name="groupName">
            <small class="form-text text-danger"
                style=" color: red;"><?php if(isset($errorGroup)){ echo $errorGroup;} ?></small>
        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary mt-2 form-control w-50" name="addNewGroup">Submit</button>
        </div>
    </form>
</div>