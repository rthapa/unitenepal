<?php
/**
 * Object class
 * @author Rabi Thapa
 * @version  1.0 2015
 */
class Object{
	public static $table;
	public static $class;

	public static function getFromId($id, $connection){
		$query = $connection->query('SELECT * FROM :table
							WHERE id =:id LIMIT 1',
							array(":id"=>$id, ":table"=>static::$table)) ;
		if(count($query) > 0){
			$obj = new static::$class;
			foreach($query = $query[0] as $key => $value){
				$obj->$key = $value;
			}
			return $obj;
		}else{
			return new static::$class;
		}
	}

	public static function getFromSql($sql, $pdoParams = array(), $connection){
		$query = $connection->query($sql, $pdoParams);

		$objArr = array();
		if(count($query)>0){
			foreach($query as $key => $value){
				$obj = new static::$class;
				foreach($query[$key] as $k => $v){
					$obj->$k = $v;
				}
				$objArr[] = $obj;
			}

		}
		return $objArr;
	}

	public static function getSingleFromSql($sql, $pdoParams = array(), $connection){
		$query = $connection->query($sql, $pdoParams);
		if(count($query) > 0){
			$obj = new static::$class;
			foreach($query = $query[0] as $key => $value){
				$obj->$key = $value;
			}
			return $obj;
		}else{
			return new static::$class;
		}
	}
}
