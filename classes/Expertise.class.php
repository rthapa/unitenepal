<?php
/**
 * Expertise class for Unitenepal.org
 * @author Rabi Thapa
 * @version  1.0 2015
 */
class Expertise extends Object{
	public static $table = 'expertise';
	public static $class = 'Expertise'; 

	protected $id;
	protected $expertise;
	protected $userid;

	public static function getFromId($id, $connection){
		$query = $connection->query('SELECT * FROM expertise
							WHERE id =:id LIMIT 1',
							array(":id"=>$id)) ;
		if(count($query) > 0){
			$obj = new Expertise();
			foreach($query = $query[0] as $key => $value){
				$obj->$key = $value;
			}
			return $obj;
		}else{
			return new Expertise;
		}
	}

	public static function getExpertiseFromUserId($userid, $connection){
		return self::getFromSql('SELECT * FROM expertise WHERE userid = :userid',
								array(':userid' => $userid), $connection);
	}


	public function save($connection){
		if($this->getId()){
			$connection->updateRow('UPDATE 
										expertise
									SET 
										expertise = :expertise,
										userid = :userid
									WHERE
										id = :id',
									array(
										':expertise' => $this->getExpertise(),
										':userid' => $this->getUserId(),
										':id' => $this->getId()
										));
		}else{
			$connection->insertRow('INSERT INTO
										expertise(
											expertise,
											userid
										) 
									values
										(
											:expertise,
											:userid
										)',
									 array(
									 		':expertise' => $this->getExpertise(),
									 		':userid' => $this->getUserId()
									 		));

			$this->id = $connection->getLastInsertId();
		}
	}

	/* Setters */
	public function setExpertise($value){
		return $this->expertise = $value;
	}

	public function setUserId($value){
		return $this->userid = $value;
	}

	/* Getters */
	public function getId(){
		return $this->id;
	}

	public function getExpertise(){
		return $this->expertise;
	}

	public function getUserId(){
		return $this->userid;
	}
}
