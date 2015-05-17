<?php
/**
 * Article class for Unitenepal.org
 * @author Rabi Thapa
 * @version  1.1 2015
 */
class Article{
	private $id;
	private $ownerid;
	private $title;
	private $date;
	private $updatedate;
	private $coverimg;
	private $body;

	public static function getFromId($id, $connection){
		$query = $connection->query('SELECT * FROM article
							WHERE id =:id LIMIT 1',
							array(":id"=>$id)) ;
		if(count($query) > 0){
			$obj = new Article();
			foreach($query = $query[0] as $key => $value){
				$obj->$key = $value;
			}
			return $obj;
		}else{
			return new Article;
		}
	}

	public static function getFromOwnerId($id, $connection){
		$query = $connection->query('SELECT * FROM article
							WHERE ownerid =:id',
							array(":id"=>$id)) ;

		$objArr = array();
		if(count($query)>0){
			foreach($query as $key => $value){
				$obj = new Article();
				foreach($query[$key] as $k => $v){
					$obj->$k = $v;
				}
				$objArr[] = $obj;
			}

		}
		return $objArr;
	}

	public static function getFromSql($sql, $pdoParams = array(), $connection){
		$query = $connection->query($sql, $pdoParams);

		$objArr = array();
		if(count($query)>0){
			foreach($query as $key => $value){
				$obj = new Article();
				foreach($query[$key] as $k => $v){
					$obj->$k = $v;
				}
				$objArr[] = $obj;
			}

		}
		return $objArr;
	}

	public function save($connection){
		if($this->getId()){
			$connection->updateRow('UPDATE 
										article
									SET 
										email = :email,
										pwd = :pwd,
										name = :name,
										ip = :ip,
										lastlogin = now(),
										username = :username,
										activated = :activated
									WHERE
										id = :id',
									array(':email' => $this->getEmail(),
										':pwd' => $this->getPassword(),
										':name' => $this->getName(),
										':ip' => preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR')),
										':username' => $this->getUsername(),
										':activated' => $this->getActivated(),
										':id' => $this->getId()
										));
		}else{
			$connection->insertRow('INSERT INTO
										article(
											ownerid,
											title,
											`date`,
											updatedate,
											coverimg,
											body
										) 
									values
										(
											:ownerid,
											:title, 
											now(),
											:updatedate, 
											:coverimg, 
											:body
										)',
									 array(':ownerid' => $this->getOwnerId(),
									 		':title' => $this->getTitle(),
									 		':updatedate' => $this->getUpdateDate,
									 		':coverimg' => $this->getCoverImg(),
									 		':body' => $this->getBody()
									 		));

			$this->id = $connection->getLastInsertId();
		}
	}

	/* Setters */
	public function setOwnerId($value){
		return $this->ownerid = $value;
	}

	public function setTitle($value){
		return $this->title = $value;
	}

	public function setDate($value){
		return $this->date = $value;
	}
	public function setUpdateDate($value){
		return $this->updatedate = $value;
	}

	public function setCoverImg($value){
		return $this->coverimg = $value;
	}

	public function setBody($value){
		return $this->body = $value;
	}

	/* Getters */
	public function getId(){
		return $this->id;
	}

	public function getOwnerId(){
		return $this->ownerid;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getDate(){
		return $this->date;
	}
	public function getUpdateDate(){
		return $this->updatedate;
	}
	public function getCoverImg(){
		return $this->coverimg;
	}

	public function getBody(){
		return $this->body;
	}
}
