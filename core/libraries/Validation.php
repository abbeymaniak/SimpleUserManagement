<?php
class Validation Extends Database {
	protected $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function checkInput($var) {
		$var = htmlspecialchars($var);
		$var = trim($var);
		$var = stripcslashes($var);
		return $var;
	}

	public function clean($input) {
		if (is_array($input)) {
			foreach ($input as $key => $val) {
				$output[$key] = clean($val);
				// $output[$key] = $this->clean($val);
			}
			
		} else {

			$output = (string) $input;
			// if magic quotes is on then use strip slashes
			if (get_magic_quotes_gpc()) {
				$output = stripslashes($output);
			}
			// $output = strip_tags($output);
			$output = htmlentities($output, ENT_QUOTES, 'UTF-8');
		}
		// return the clean text
		return $output;
	}

	public function checkAccount($username) {
		$stmt = $this->pdo->prepare("SELECT `email`,`phone`,`username` FROM `users` WHERE `email` = :username OR `phone` = :username OR `username` = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkResetTokenEmail($email, $active, $resetToken) {
		$stmt = $this->pdo->prepare("SELECT `email`,`active`,`resetToken` FROM `users` WHERE `email` = :email AND `active` = :active AND `resetToken` = :resetToken");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":active", $active, PDO::PARAM_STR);
		$stmt->bindParam(":resetToken", $resetToken, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkResetTokenPhone($phone, $active, $resetToken) {
		$stmt = $this->pdo->prepare("SELECT `phone`,`active`,`resetToken` FROM `users` WHERE `phone` = :phone AND `active` = :active AND `resetToken` = :resetToken");
		$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
		$stmt->bindParam(":active", $active, PDO::PARAM_STR);
		$stmt->bindParam(":resetToken", $resetToken, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function search($search) {
		$stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `username` LIKE ? OR `screenName` LIKE ?");
		$stmt->bindValue(1, $search . '%', PDO::PARAM_STR);
		$stmt->bindValue(2, $search . '%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function userLogin($username, $password, $session, $ipAddress) {
		$stmt = $this->pdo->prepare("SELECT `userRef` FROM `users` WHERE (`email` = :username OR `phone` = :username OR `userRef` = :username OR `username` = :username) AND `password` = :password AND `active` = '1'");
		$shapassword = sha1(md5($password));
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->bindParam(":password", $shapassword, PDO::PARAM_STR);
		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_OBJ);
		$count = $stmt->rowCount();

		if ($count > 0) {
			$_SESSION['caesarsUserRef'] = $user->userRef;
			$lastLogin = date("Y-m-d H:i:s", time());
			if (isset($_GET['pageto'])) {
				$stmt = $this->pdo->prepare("UPDATE `users` SET `lastLogin` = '$lastLogin' WHERE `userRef` =" . $_SESSION['caesarsUserRef']);
				$stmt->execute();
				$stmt = $this->pdo->prepare("UPDATE `users` SET `loginCount` = `loginCount`+1 WHERE `userRef` =" . $_SESSION['caesarsUserRef']);
				$stmt->execute();
				// Insert User log
				$this->insert('userlogs', ['userRef' => $_SESSION['caesarsUserRef'], 'ipAddress' => $ipAddress, 'login_time' => $lastLogin, 'logSession' => $session, 'browser' => Helper::getBrowser(), 'operating_system' => Helper::getOS(), 'loginType' => 'SITE', 'userAgent' => $_SERVER['HTTP_USER_AGENT']]);
				echo "<script>
                         setTimeout(function(){
                            window.location.href = '" . BASE_URL . "i/" . $_GET['pageto'] . "';
                         });
                    </script>";
			} else {
				$stmt = $this->pdo->prepare("UPDATE `users` SET
                    `lastLogin` = '$lastLogin',
                    `loginCount` = `loginCount`+1,
                    `lastIpAddress` = :ipAddress,
                    `session` = :session
                    WHERE
                    `userRef` =" . $_SESSION['caesarsUserRef']
				);
				$stmt->bindParam(":ipAddress", $ipAddress, PDO::PARAM_STR);
				$stmt->bindParam(":session", $session, PDO::PARAM_STR);
				$stmt->execute();
				// Insert User log
				$this->insert('userlogs', ['userRef' => $_SESSION['caesarsUserRef'], 'ipAddress' => $ipAddress, 'login_time' => $lastLogin, 'logSession' => $session, 'browser' => Helper::getBrowser(), 'operating_system' => Helper::getOS(), 'loginType' => 'SITE', 'userAgent' => $_SERVER['HTTP_USER_AGENT']]);
				header("Location: " . BASE_URL . "i/?dashboard");
				exit();
			}
		} else {
			return false;
		}
	}

	public function logout2($userRef) {
		$stmt = $this->pdo->prepare("UPDATE `users` SET `online` = '0' WHERE `userRef` = :userRef");
		$stmt->bindParam(":userRef", $userRef, PDO::PARAM_STR);
		$stmt->execute();

		session_destroy();
		header("Location: " . BASE_URL);
		exit();
	}

	public function logout($userRef, $logSession, $logoutTime) {
		$stmt = $this->pdo->prepare("UPDATE `userlogs` SET `logout_time` = :logoutTime WHERE `userRef` = :userRef AND `logSession` = :logSession");
		$stmt->bindParam(":logoutTime", $logoutTime, PDO::PARAM_STR);
		$stmt->bindParam(":userRef", $userRef, PDO::PARAM_STR);
		$stmt->bindParam(":logSession", $logSession, PDO::PARAM_STR);
		$stmt->execute();
		session_destroy();
		header("Location: " . BASE_URL);
	}

	public function lockScreen($userRef) {
		$stmt = $this->pdo->prepare("UPDATE `users` SET `online` = '0' WHERE `userRef` = :userRef");
		$stmt->bindParam(":userRef", $userRef, PDO::PARAM_STR);
		$stmt->execute();
		unset($_SESSION['farmConnectUserRef']);
		$_SESSION['lcUserRef'] = $userRef;
		header("Location: " . BASE_URL . "lockscreen/");
		exit();
	}

	public function create($table, $fields = []) {
		$columns = implode(',', array_keys($fields));
		$values = ':' . implode(', :', array_keys($fields));
		$sql = "INSERT INTO {$table} ({$columns}) VALUES({$values})";
		if ($stmt = $this->pdo->prepare($sql)) {
			foreach ($fields as $key => $data) {
				$stmt->bindValue(':' . $key, $data);
			}
			$stmt->execute();
			return $this->pdo->lastInsertId();
		}
	}

	public function checkUniqueRef($table, $uniqueColumn, $uniqueRef) {
		$stmt = $this->pdo->prepare("SELECT `$uniqueColumn` FROM `$table` WHERE `$uniqueColumn` = :uniqueRef");
		$stmt->bindParam(":uniqueRef", $uniqueRef, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkEmail($email) {
		$stmt = $this->pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkFBID($fbID) {
		$stmt = $this->pdo->prepare("SELECT `facebookID` FROM `users` WHERE `facebookID` = :fbID");
		$stmt->bindParam(":fbID", $fbID, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkCity($country_code, $state_name, $city_name) {
		$stmt = $this->pdo->prepare("SELECT * FROM `cities` WHERE `country_code` = :country_code AND `state_name` = :state_name AND `city_name` = :city_name");
		$stmt->bindParam(":country_code", $country_code, PDO::PARAM_STR);
		$stmt->bindParam(":state_name", $state_name, PDO::PARAM_STR);
		$stmt->bindParam(":city_name", $city_name, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkState($country_code, $state_name) {
		$stmt = $this->pdo->prepare("SELECT * FROM `states` WHERE `country_code` = :country_code AND `state_name` = :state_name");
		$stmt->bindParam(":country_code", $country_code, PDO::PARAM_STR);
		$stmt->bindParam(":state_name", $state_name, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkPhone($phone) {
		$stmt = $this->pdo->prepare("SELECT `phone` FROM `users` WHERE `phone` = :phone");
		$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkUserRef($userRef) {
		$stmt = $this->pdo->prepare("SELECT `userRef` FROM `users` WHERE `userRef` = :userRef");
		$stmt->bindParam(":userRef", $userRef, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkBookingRef($reference) {
		$stmt = $this->pdo->prepare("SELECT `reference` FROM `billing_details` WHERE `reference` = :reference");
		$stmt->bindParam(":reference", $reference, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkCartRef($cart_ref) {
		$stmt = $this->pdo->prepare("SELECT `cartRef` FROM `food_cart` WHERE `cartRef` = :cart_ref");
		$stmt->bindParam(":cart_ref", $cart_ref, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

// To check if room number has already been assigned
	public function checkRoomNumber($r_Num) {
		$stmt = $this->pdo->prepare("SELECT `r_num` FROM `rooms` WHERE `r_num` = :r_num");
		$stmt->bindParam(":r_num", $r_Num, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//To Check fro existing email in the Newletter Table

	public function checkNewletter($email) {
		$stmt = $this->pdo->prepare("SELECT `email_news` FROM `newsletter` WHERE `email_news` = :email");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkUsername($username) {
		$stmt = $this->pdo->prepare("SELECT `username` FROM `users` WHERE `username` = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function userloggedIn() {
		return (isset($_SESSION['caesarsUserRef']) || isset($_SESSION['access_token'])) ? true : false;
	}

}
?>