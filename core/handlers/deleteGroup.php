<?php

if(isset($_POST['deleteGroup'])){

$group_id = $_POST['group_id'];

// $getCRUD->delete('users', $user_id);
$stmt = $pdo->prepare("DELETE FROM `user_group` WHERE `id` = $group_id");
$stmt->execute();

$successHeader = "Group Deleted";
$successMessage = "Group SuccessFully Deleted";

$_SESSION['success'] = $successMessage;

header("Location: ?view_groups");



}