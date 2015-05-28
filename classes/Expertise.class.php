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

	public function delete($connection){
		$connection->deleteRow('DELETE FROM expertise WHERE id = :id', array(':id'=>$this->getId()));
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
