<?php
/**
 * User class for linknect.com
 * @author Rabi Thapa
 * @version  1.1 2014
 */
class User{
	private $id;
	private $username;
	private $email;
	private $pwd;
	private $realname;
	private $realsurname;

	private $ip;
	private $lastlogin;
	private $activated;
	private $joindate;
	private $fbid;
	private $img;
	private $gender;
	private $location;
	private $hash;
	private $bio;

	public static function getFromAuth($emailOrUsername, $password, $connection ){
		$auth = $connection->query('SELECT * FROM users WHERE (username = :eOu AND pwd = :pwd) OR (email = :eOu AND pwd = :pwd)',
									array(':eOu' => $emailOrUsername,
											':pwd' => md5($password),
											));

		if(count($auth) > 0){
			$obj = new User();
			foreach($auth = $auth[0] as $key => $value){
				$obj->$key = $value;
			}
			return $obj;
		}else{
			return false;
		}
	}

	public static function getUsernameFromId($id, $connection){
		$usernameQuery = $connection->query('SELECT * FROM users
												WHERE id = :id',
												array(":id"=>$id)) ;
		$username = "";
		foreach($usernameQuery as $user){
			$username = $user['username'];
		}
		return $username;
	}

	public static function emailExist($email, $connection){
		$query = $connection->query("SELECT * FROM users WHERE email = :email LIMIT 1",
							array(":email"=>$email));
		if(count($query) < 1){
			return false;
		}else{
			return true;
		}
	}

	public static function fbIdExist($fbid, $connection){
		$query = $connection->query("SELECT * FROM users WHERE fbid = :fbid LIMIT 1",
							array(":fbid"=>$fbid));
		if(count($query) < 1){
			return false;
		}else{
			return true;
		}
	}

	public static function usernameExist($username, $connection){
		$query = $connection->query("SELECT * FROM users WHERE username = :username LIMIT 1",
							array(":username"=>$username));
		if(count($query) < 1){
			return false;
		}else{
			return true;
		}
	}

	public static function authCookie($id, $email, $hash, $connection){
		$query = $connection->query("SELECT * FROM users WHERE id = :id AND email = :email AND hash = :hash LIMIT 1",
							array(":id"=>$id, ":email"=>$email, ":hash"=>$hash));
		if(count($query) < 1){
			return false;
		}else{
			return true;
		}
	}

	public static function getFromId($id, $connection){
		$query = $connection->query('SELECT * FROM users
							WHERE id =:id LIMIT 1',
							array(":id"=>$id)) ;
		if(count($query) > 0){
			$obj = new User();
			foreach($query = $query[0] as $key => $value){
				$obj->$key = $value;
			}
			return $obj;
		}else{
			return new User;
		}
	}

	public static function getSingleFromSql($sql, $pdoParams = array(), $connection){
		$query = $connection->query($sql, $pdoParams);
		if(count($query) > 0){
			$obj = new User();
			foreach($query = $query[0] as $key => $value){
				$obj->$key = $value;
			}
			return $obj;
		}else{
			return new User;
		}
	}

	public static function getFromSql($sql, $pdoParams = array(), $connection){
		$query = $connection->query($sql, $pdoParams);

		$objArr = array();
		if(count($query)>0){
			foreach($query as $key => $value){
				$obj = new User();
				foreach($query[$key] as $k => $v){
					$obj->$k = $v;
				}
				$objArr[] = $obj;
			}

		}
		return $objArr;
	}

	public static function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	// public static function getFromEmailOrUsername($emailOrUsername, $connection){
	// 	$query = $connection->query('SELECT * FROM users
	// 						WHERE email =:id LIMIT 1',
	// 						array(":id"=>$id)) ;
	// 	if(count($query) > 0){
	// 		$obj = new User();
	// 		foreach($query = $query[0] as $key => $value){
	// 			$obj->$key = $value;
	// 		}
	// 		return $obj;
	// 	}else{
	// 		return new User;
	// 	}
	// }

	public function save($connection){
		if($this->getId()){
			$connection->updateRow('UPDATE 
										users
									SET 
										email = :email,
										pwd = :pwd,
										realname = :realname,
										realsurname = :realsurname,
										ip = :ip,
										username = :username,
										activated = :activated,
										lastlogin = now(),
										fbid = :fbid,
										img = :img,
										gender = :gender,
										location = :location,
										hash = :hash,
										bio = :bio
									WHERE
										id = :id',
									array(
										':email' => $this->getEmail(),
										':pwd' => $this->getPassword(),
										':realname' => $this->getRealName(),
										':realsurname' => $this->getRealSurname(),
										':ip' => preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR')),
										':activated' => $this->getActivated(),
										':username' => $this->getUsername(),
										':fbid' => $this->getFbId(),
										':img' => $this->getImg(),
										':gender' => $this->getGender(),
										':location' => $this->getLocation(),
										':hash' => $this->getHash(),
										':id' => $this->getId(),
										':bio' => $this->getBio()
										));
		}else{
			$connection->insertRow('INSERT INTO
										users(
											email,
											pwd,
											realname,
											realsurname,
											ip,
											lastlogin,
											activated,
											joindate,
											fbid,
											img,
											gender,
											location,
											hash,
											bio
										) 
									values
										(
											:email,
											:pwd, 
											:realname,
											:realsurname, 
											:ip, 
											now(),
											:activated,
											now(),
											:fbid,
											:img,
											:gender,
											:location,
											:hash,
											:bio
										)',
									 array(':email' => $this->getEmail(),
									 		':pwd' => $this->getPassword(),
									 		':realname' => $this->getRealName(),
									 		':realsurname' => $this->getRealSurname(),
									 		':ip' => preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR')),
									 		':activated' => $this->getActivated(),
									 		':fbid' => $this->getFbId(),
									 		':img' => $this->getImg(),
									 		':gender' => $this->getGender(),
									 		':location'=>$this->getLocation(),
									 		':hash'=>$this->getHash(),
									 		':bio'=> $this->getBio()
									 		));

			$this->id = $connection->getLastInsertId();
		}
	}

	/* Setters */
	public function setEmail($value){
		return $this->email = $value;
	}

	public function setPassword($value){
		return $this->pwd = $value;
	}

	public function setRealName($value){
		return $this->realname = $value;
	}
	public function setRealSurname($value){
		return $this->realsurname = $value;
	}
	public function setIp($value){
		return $this->ip = $value;
	}

	public function setLastLogin($value){
		return $this->lastlogin = $value;
	}

	public function setUsername($value){
		return $this->username = $value;
	}

	public function setActivated($value){
		return $this->activated = $value;
	}

	public function setJoinDate($value){
		return $this->joindate = $value;
	}

	public function setFbId($value){
		return $this->fbid = $value;
	}

	public function setImg($value){
		return $this->img = $value;
	}

	public function setGender($value){
		return $this->gender = $value;
	}

	public function setLocation($value){
		return $this->location = $value;
	}

	public function setHash($value){
		return $this->hash = $value;
	}

	public function setBio($value){
		return $this->bio = $value;
	}

	/* Getters */
	public function getId(){
		return $this->id;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPassword(){
		return $this->pwd;
	}

	public function getRealName(){
		return $this->realname;
	}
	public function getRealSurname(){
		return $this->realsurname;
	}
	public function getIp(){
		return $this->ip;
	}

	public function getLastLogin(){
		return $this->lastlogin;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getActivated(){
		return $this->activated;
	}

	public function getJoinDate(){
		return $this->joindate;
	}

	public function getFbId(){
		return $this->fbid;
	}

	public function getImg(){
		if(trim($this->img)){
			return $this->img;
		}else{
			return 'images/defaultuser.jpg';
		}
	}

	public function getGender(){
		return $this->gender;
	}

	public function getLocation(){
		return $this->location;
	}

	public function getHash(){
		return $this->hash;
	}

	public function getBio(){
		return $this->bio;
	}
}
