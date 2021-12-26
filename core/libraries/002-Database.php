<?php
/**
 * 
 */
class Database {

	protected $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}



	public function insert($table, $fields = []) {
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

	public function sendNotification($get_id, $user_id, $target, $type) {

		$this->insert('notification', array('notification' => $get_id, 'notificationFrom' => $user_id, 'target' => $target, 'type' => $type, 'time' => date('Y-m-d H:i:s')));

	}

		public function update($table, $user_id, $fields = array()) {
		$columns = '';
		$i = 1;
		foreach ($fields as $name => $value) {
			$columns .= "`{$name}` = :{$name}";
			if ($i < count($fields)) {
				$columns .= ', ';
			}
			$i++;
		}
		$sql = "UPDATE {$table} SET {$columns} WHERE `user_id` = {$user_id}";
		if ($stmt = $this->pdo->prepare($sql)) {
			foreach ($fields as $key => $value) {
				$stmt->bindValue(':' . $key, $value);
			}
			$stmt->execute();

		}
	}



	public function delete($table, $clauses = []) {
		$where = '';
		$i = 1;
		foreach ($clauses as $name => $value) {
			$where .= "`{$name}` = :{$name}";
			if ($i < count($clauses)) {
				$where .= ' AND ';
			}
			$i++;
		}
		$sql = "DELETE FROM {$table} WHERE {$where}";
		if ($stmt = $this->pdo->prepare($sql)) {
			foreach ($clauses as $key => $value) {
				$stmt->bindValue(':' . $key, $value);
			}
			return $stmt->execute();
		}
	}
}
?>