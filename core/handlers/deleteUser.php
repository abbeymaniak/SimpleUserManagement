<?php

if(isset($_POST['deleteUser'])){

$user_id = $_POST['user_id'];

// $getCRUD->delete('users', $user_id);
$stmt = $pdo->prepare("DELETE FROM `users` WHERE `id` = $user_id");
$stmt->execute();

$successHeader = "User Deleted";
$successMessage = "User SuccessFully Deleted";

$_SESSION['success'] = $successMessage;

header("Location: ?view_users");



}