<?php
class User {
	protected $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}


	

	public function userIdByUsername($username) {
		$stmt = $this->pdo->prepare("SELECT `userID` FROM users WHERE username = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_OBJ);
		return $user->userID;
	}


	public function checkUsername($username) {
		$stmt = $this->pdo->prepare("SELECT `username` FROM `users` WHERE `username` = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}



	public function userData($user_id) {

		$stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `id` = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function userDataWithGroup($user_id){
		$stmt = $this->pdo->prepare("SELECT users.id, users.username, users.name, users.surname, users.dob, users.user_group_id, user_group.group_name FROM `users` join `user_group` ON users.user_group_id = user_group.id WHERE users.id = :user_id");
		$stmt->bindParam(":user_id", $user_id,  PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);

	}

	public function userGroupData($group_id){
		$stmt = $this->pdo->prepare("SELECT users.*,user_group.* FROM `users` join `user_group` ON users.user_group_id = user_group.id WHERE user_group.id = :group_id");
		$stmt->bindParam(":group_id", $group_id,  PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);

	}

	public function groupData($group_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `user_group` WHERE `id` = :group_id ");
		$stmt->bindParam(":group_id", $group_id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);

	}


	public function getUsers(){
		$stmt = $this->pdo->prepare("SELECT users.id, users.username, users.name, users.surname, users.dob, users.user_group_id, user_group.group_name FROM `users` left join `user_group` ON users.user_group_id = user_group.id");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function getGroups(){
		$stmt = $this->pdo->prepare("SELECT * FROM `user_group`");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function getGroupsCount(){
		$stmt = $this->pdo->prepare("SELECT * FROM `user_group`");
		$stmt->execute();
		$count = count($stmt->fetchAll(PDO::FETCH_OBJ));
		return $count;
		
	}

	public function getUsersCount(){
		$stmt = $this->pdo->prepare("SELECT * FROM `users`");
		$stmt->execute();
		$count = count($stmt->fetchAll(PDO::FETCH_OBJ));
		return $count;
		
	}



	public function timeAgo($datetime) {
		$time = strtotime($datetime);
		$current = time();
		$seconds = $current - $time;
		$minutes = round($seconds / 60);
		$hours = round($seconds / 3600);
		$months = round($seconds / 2600640);
		if ($seconds <= 60) {
			if ($seconds == 0) {
				echo 'now';
			}
		} else if ($minutes <= 60) {
			return $minutes . 'm';
		} else if ($hours <= 24) {
			return $hours . 'h';
		} else if ($months <= 12) {
			return date('M j', $time);
		} else {
			return date('j M Y', $time);
		}

	}

}

?>