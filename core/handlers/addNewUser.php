<?php
if (isset($_POST['addNewUser'])) {
    $username  = $getFromV->checkInput($_POST['username']);
    $password  = $_POST['password'];
    $firstName = $getFromV->checkInput($_POST['firstname']);
    $lastName  = $getFromV->checkInput($_POST['lastname']);
    $group   = $getFromV->checkInput($_POST['group']);
     $birthday = $getFromV->checkInput($_POST['dob']);
    $dateAdded = date("Y-m-d H:i:s");

    


    if (empty($firstName) || empty($lastName)) {
        $errorName = "First & Last Name are required";
    } 
    if (empty($username)) {
        $errorUsername = "Username is required";
    } 
    if (empty($password)) {
        $errorPass = "password is required";
    } 
     if (empty($birthday)) {
        $errorDob = "Please Enter Date of Birthday";
    }
    if (empty($group)) {
        $errorGroup = "Please select group";
    } 
    
    if(empty($errorUsername) && empty($errorName) && empty($errorPass) && empty($errorGroup) && empty($errorDob))
    {
        $encPass = sha1(md5($password));
        if (strlen($firstName) > 55) {
            $errorName = "Name must be bettween 1 to 55 characters";
        } elseif (strlen($lastName) > 55) {
            $errorName = "Name must be bettween 1 to 55 characters";
        } else {
            if (!empty($username) && $getFromV->checkUsername($username) === TRUE) {
                $errorUsername = "Username already taken";
            } else {
               

                /// Create User
                $createUser = $getCRUD->insert('users',
                    [
                        'username'   => $username,
                        'password'   => $encPass,
                        'name'  => $firstName,
                        'surname'   => $lastName,
                        'dob'   => $birthday,
                        'user_group_id' => $group,
                        // 'add_ts'     => $dateAdded,
                    ]);

                $successHeader  = "New User Profile";
                $successMessage = "User profile created successfully";
                
                
              // header('Location: ?dashboard');
            }
        }
    }
}
?>