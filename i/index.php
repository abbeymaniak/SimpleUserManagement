<?php include '../core/init.php';

?>
<?php
// if (!isset($_SESSION['caesarsUserRef'])) {
// 	header("Location: " . BASE_URL);
// }
// if (empty($_GET)) {
// 	header("Location: ?dashboard");
// }
// if ($_SESSION['caesarsUserRef']) {
// 	$userRef = $_SESSION['caesarsUserRef'];
// 	$user = $getFromU->userAccount($userRef);
// 	$role = $user->role;
// 	$userRef = $user->userRef;
// 	$_SESSION['logSession'] = $user->session;
// 	$userInfo = $getFromS->userDataRef($userRef);
// 	if(!empty($userInfo->reference)){
// 		$ref = $userInfo->reference;
// 	$resDetails = $getFromU->userInforReserve($ref);
// 	$checkout = $resDetails->Check_out;
// 	if(!empty($checkout)){$checkout = $resDetails->Check_out;}
// 	$cus_status = $resDetails->status;
// 	$cname = $getFromU->userInfoMore($ref);
// 	$toGetPaidAmt = $getFromU->userInfoMore($ref);
// 	$amountPaid = $toGetPaidAmt->AmountPaid;
// 	$checkin = $resDetails->Check_in;
// 	if(!empty($checkin)){$checkin = $resDetails->Check_in;}
// 	$financeDue = $getFromU->userInfoMoreAmount($ref, $checkin, $checkout);
// 	}
	
	
// 	$userInfo = $getFromS->userDataRef($userRef);
// 	$tdate = date('Y-m-d');
// 	$notificationAll = $getFromS->getNotificationAll();





	
	
// 	//$user = $getCRUD->contentData('users', 'userRef', $userRef);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <META NAME="robots" CONTENT="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="keywords" content="">
    <meta name="theme-color" content="#4A8B71" />
    <!-- == FAVICONS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/dashboard.css" type="text/html" />

</head>
<style>
hr {
    border: 1px solid black;
    width: 84%;
    margin-top: 0;
}
</style>

<body>


    <!-- Sidebar starts -->
    <?php include './views/sidebar.php' ?>

    <!-- Sidebar ends -->

    <!-- main layout starts -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">

            <?php

foreach($_GET as $key => $val){
    switch ($key) {
        case 'dashboard':
         	include 'views/dashboard/home.php';
            break;
        case 'add_user':
            include 'views/dashboard/user/add_user.php';
            break;
        case 'view_users':
            include 'views/dashboard/user/view_users.php';
            break;
        case 'edit_user':
            include 'views/dashboard/user/edit_user.php';
            break;
        case 'delete_user':
            include 'views/dashboard/user/delete_user.php';
            break;
         case 'add_group':
         	include 'views/dashboard/group/add_group.php';
            break;
         case 'edit_group':
          include 'views/dashboard/group/edit_group.php';
            break;
         case 'view_groups':
            include 'views/dashboard/group/view_groups.php';
            break;
        case 'delete_group':
            include 'views/dashboard/group/delete_group.php';
            break;
        case 'list_groups':
           include 'views/dashboard/group/list_groups.php';
            break;
        default:
	        include 'views/dashboard/home.php';

    }
}


// Main Layout

// if (isset($_GET['dashboard'])) {
// 		include 'views/dashboard/home.php';
// 	}
// 	if (isset($_GET['add_user'])) {
// 		include 'views/dashboard/user/add_user.php';
// 	}
// 	if (isset($_GET['view_users'])) {
// 		include 'views/dashboard/user/view_users.php';
// 	}
//     if(isset($_GET['edit_user'])){
//         include 'views/dashboard/user/edit_user.php';

//     }
//     if(isset($_GET['delete_user'])){
//          include 'views/dashboard/user/delete_user.php';
//     }
//     if(isset($_GET['add_group'])){
//          include 'views/dashboard/group/add_group.php';
//     }
//     if(isset($_GET['edit_group'])){
//          include 'views/dashboard/group/edit_group.php';
//     }
//     if(isset($_GET['view_groups'])){
//          include 'views/dashboard/group/view_groups.php';
//     }
//      if(isset($_GET['list_groups'])){
//          include 'views/dashboard/group/list_groups.php';
//     }
//      if(isset($_GET['delete_group'])){
//          include 'views/dashboard/group/delete_group.php';
//     }

	?>



        </div>




    </main>
    <!-- main layout ends -->
    </div>
    </div>


    <!-- footer starts -->
    <?php
include './views/footer.php' ?>

    <!-- footer ends -->





</body>

</html>