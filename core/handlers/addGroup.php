<?php

if(isset($_POST['addNewGroup'])){

     $groupName  = $getFromV->checkInput($_POST['groupName']);

     if (empty($groupName)) {
        $errorGroup = "Please select group";
    } 

    if(empty($errorGroup)){

        $createGroup = $getCRUD->insert('user_group',
        [
            'group_name'   => $groupName,
            // 'add_ts'     => $dateAdded,
        ]);
        
        $successHeader  = "New Group Added!!";
        $successMessage = "New Group Successfully Added!!";
    }
}