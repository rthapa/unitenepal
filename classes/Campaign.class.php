<?php
/**
 * Campaign class for Unitenepal.org
 * @author Rabi Thapa
 * @version  1.0 2015
 */
class Campaign extends Object{
	public static $table = 'campaigns';
	public static $class = 'Campaign'; 

	protected $id;
	protected $title;
	protected $happeningdate;
	protected $location;
	protected $link;
	protected $description;
	protected $created;
	protected $userid;
	protected $img;

	public static function getFromUserId($userid, $connection){
		return self::getFromSql('SELECT * FROM campaigns WHERE userid = :userid',
								array(':userid' => $userid), $connection);
	}


	public function save($connection){
		if($this->getId()){
			$connection->updateRow('UPDATE 
										campaigns
									SET 
										title = :title,
										happeningdate = :happeningdate,
										location = :location,
										link = :link,
										description = :description,
										created = now(),
										userid = :userid,
										img = :img
									WHERE
										id = :id',
									array(
										':title' => $this->getTitle(),
										':happeningdate' => $this->getHappeningDate(),
										':location' => $this->getLocation(),
										':link' => $this->getLink(),
										':description' => $this->getDescription(),
										':userid' => $this->getUserId(),
										':img' => $this->getImg(),
										':id' => $this->getId()
										));
		}else{
			$connection->insertRow('INSERT INTO
										campaigns(
											title,
											happeningdate,
											location,
											link,
											description,
											created,
											userid,
											img
										) 
									values
										(
											:title,
											:happeningdate,
											:location,
											:link,
											:description,
											now(),
											:userid,
											:img
										)',
									 array(
									 		':title' => $this->getTitle(),
									 		':happeningdate' => $this->getHappeningDate(),
									 		':location' => $this->getLocation(),
									 		':link' => $this->getLink(),
									 		':description' => $this->getDescription(),
									 		':userid' => $this->getUserId(),
									 		':img'=>$this->getImg()
									 		));

			$this->id = $connection->getLastInsertId();
		}
	}

	/* Setters */
	public function setTitle($value){
		return $this->title = $value;
	}

	public function setHappeningDate($value){
		return $this->happeningdate = $value;
	}

	public function setLocation($value){
		return $this->location = $value;
	}

	public function setLink($value){
		return $this->link = $value;
	}

	public function setDescription($value){
		return $this->description = $value;
	}

	public function setCreated($value){
		return $this->created = $value;
	}

	public function setUserId($value){
		return $this->userid = $value;
	}

	public function setImg($value){
		return $this->img = $value;
	}

	/* Getters */
	public function getId(){
		return $this->id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getHappeningDate(){
		return $this->happeningdate;
	}

	public function getLocation(){
		return $this->location;
	}

	public function getLink(){
		return $this->link;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getCreated(){
		return $this->created;
	}

	public function getUserId(){
		return $this->userid;
	}

	public function getImg(){
		return $this->img;
	}
}
