<?php
// https://github.com/dominicklee/PHP-MySQL-Sessions.git
/*
	Revised code by Dominick Lee
	Original code derived from "Essential PHP Security" by Chriss Shiflett
	Last Modified 2/27/2017


	CREATE TABLE sessions
	(
		id varchar(32) NOT NULL,
		access int(10) unsigned,
		data text,
		PRIMARY KEY (id)
	);

	+--------+------------------+------+-----+---------+-------+
	| Field  | Type             | Null | Key | Default | Extra |
	+--------+------------------+------+-----+---------+-------+
	| id     | varchar(32)      |      | PRI |         |       |
	| access | int(10) unsigned | YES  |     | NULL    |       |
	| data   | text             | YES  |     | NULL    |       |
	+--------+------------------+------+-----+---------+-------+

	*/


class Session extends Dbh_class
{
	private $db;

	public function __construct()
	{
		// Instantiate new Database object
		//  DUMMY DB OBJECT
		$this->db = new Dbh_class;
		$this->db->session_connect();

		// Set handler to overide SESSION
		session_set_save_handler(
			array($this, "_open"),
			array($this, "_close"),
			array($this, "_read"),
			array($this, "_write"),
			array($this, "_destroy"),
			array($this, "_gc")
		);

		// Start the session
		// FOR DEV
		// session_set_cookie_params(
		// 	0,
		// 	null,
		// 	"localhost",
		// 	false,
		// 	true
		// );
		// FRO PRODUCTION
		// https://www.php.net/manual/en/function.session-set-cookie-params.php
		$secure = false; // if you only want to receive the cookie over HTTPS
		$httponly = true; // prevent JavaScript access to session cookie
		$samesite = 'lax';
		$maxlifetime = 	3600;
		if (PHP_VERSION_ID < 70300) {
			session_set_cookie_params($maxlifetime, '/; samesite=' . $samesite, $_SERVER['HTTP_HOST'], $secure, $httponly);
		} else {
			session_set_cookie_params([
				'lifetime' => $maxlifetime,
				'path' => '/',
				'domain' => $_SERVER['HTTP_HOST'],
				'secure' => $secure,
				'httponly' => $httponly,
				'samesite' => $samesite
			]);
		}
		session_start();
	}
	public function _open()
	{
		// If successful
		if ($this->db) {
			// Return True
			return true;
		}
		// Return False
		return false;
	}
	public function _close()
	{
		// Close the database connection
		// If successful
		if ($this->db->close()) {
			// Return True
			return true;
		}
		// Return False
		return false;
	}
	public function _read($id)
	{
		// Set query
		$this->db->query('SELECT data FROM sessions WHERE id = :id');
		// Bind the Id
		$this->db->bind(':id', $id);
		// Attempt execution
		// If successful
		if ($this->db->execute()) {
			if ($this->db->rowCount() > 0) {
				// Save returned row
				$row = $this->db->single();
				// Return the data
				return $row['data'];
			}
		}
		// Return an empty string
		return '';
	}
	public function _write($id, $data)
	{
		// Create time stamp
		$expires = time();
		// Set query  
		$this->db->query('REPLACE INTO sessions VALUES (:id, :expires, :data)');
		// Bind data
		$this->db->bind(':id', $id);
		$this->db->bind(':expires', $expires);
		$this->db->bind(':data', $data);
		// Attempt Execution
		// If successful
		if ($this->db->execute()) {
			// Return True
			return true;
		}
		// Return False
		return false;
	}
	public function _destroy($id)
	{
		// Set query
		$this->db->query('DELETE FROM sessions WHERE id = :id');
		// Bind data
		$this->db->bind(':id', $id);
		// Attempt execution
		// If successful
		if ($this->db->execute()) {
			// Return True
			return true;
		}
		// Return False
		return false;
	}
	public function _gc($max)
	{
		// Calculate what is to be deemed old
		$old = time() - $max;
		// Set query
		$this->db->query('DELETE FROM sessions WHERE expires < :old');
		// Bind data
		$this->db->bind(':old', $old);
		// Attempt execution
		if ($this->db->execute()) {
			// Return True
			return true;
		}
		// Return False
		return false;
	}
}
