<?php
/**
 * Appreciate class for Unitenepal.org
 * @author Rabi Thapa
 * @version  1.0 2015
 */
class Appreciate extends Object{
	public static $table = 'appreciate';
	public static $class = 'Appreciate'; 

	protected $id;
	protected $userid;
	protected $contentid;
	protected $type;
	protected $link;

	public static function getFromContentId($contentid, $connection){
		return self::getFromSql('SELECT * FROM appreciate WHERE contentid = :contentid',
								array(':contentid' => $contentid), $connection);
	}

	public static function getFromContentIdAndUserId($contentid, $userid, $connection){
		return self::getSingleFromSql('SELECT * FROM appreciate WHERE contentid = :contentid AND userid = :userid',
								array(':contentid' => $contentid, ':userid'=>$userid), $connection);
	}

	public function delete($connection){
		$connection->deleteRow('DELETE FROM appreciate WHERE id = :id', array(':id'=>$this->getId()));
	}

	public function save($connection){
		if($this->getId()){
			$connection->updateRow('UPDATE 
										appreciate
									SET 
										userid = :userid,
										contentid = :contentid,
										type = :type
									WHERE
										id = :id',
									array(
										':userid' => $this->getUserId(),
										':contentid' => $this->getContentId(),
										':type' => $this->getType(),
										':id' => $this->getId()
										));
		}else{
			$connection->insertRow('INSERT INTO
										appreciate(
											userid,
											contentid,
											type
										) 
									values
										(
											:userid,
											:contentid,
											:type
										)',
									 array(
									 		':userid' => $this->getUserId(),
									 		':contentid' => $this->getContentId(),
									 		':type' => $this->getType()
									 		));

			$this->id = $connection->getLastInsertId();
		}
	}

	/* Setters */
	public function setUserId($value){
		return $this->userid = $value;
	}

	public function setContentId($value){
		return $this->contentid = $value;
	}

	public function setType($value){
		return $this->type = $value;
	}

	/* Getters */
	public function getId(){
		return $this->id;
	}

	public function getUserId(){
		return $this->userid;
	}

	public function getContentId(){
		return $this->contentid;
	}

	public function getType(){
		return $this->type;
	}
}
