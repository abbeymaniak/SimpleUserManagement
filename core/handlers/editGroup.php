<?php

if(isset($_POST['editGroup'])){

     $groupName  = $getFromV->checkInput($_POST['group_name']);
     $groupId = $getFromV->checkInput($_POST['group_id']);

     if (empty($groupName)) {
        $errorGroup = "Please select group";
    } 

    if(empty($errorGroup)){

        $stmt = $pdo->prepare("UPDATE `user_group` SET group_name = :group_name WHERE id = :userid");
                $stmt->bindParam(":group_name", $groupName, PDO::PARAM_STR);
                $stmt->bindParam(":userid", $groupId);
                $stmt->execute();

            

              
        $successHeader  = "Group Updated!!";
        $successMessage = "Group Successfully Updated!!";
    }
}