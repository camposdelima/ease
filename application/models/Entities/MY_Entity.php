<?php

namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

/** @MappedSuperclass */
class MY_Entity {
	   
	public function GetID() {
		return $this->id;	
	}
	
	public function IsActive() {
		return $this->active;
	}	
	
	public function Set($data) {
		
		foreach($data as $key => $property) {		
			if(property_exists($this, $key))
				$this->$key = $property;
		}
		
	}	
	
	public function ToArray($fields = null) {	
		
		
		$result = array();
		
		foreach($this as $key => $property ) {
				if(($fields == null && !(substr($key, 0, 1) == "_")) || ($fields != null && in_array($key, $fields)) )															
					$result[$key] = MY_Entity::DataExtract($property);				
		}
		
		
		return $result;
	}
	
	public static function DataExtract($data) {
		$result = $data;
				
   		if( (is_object($data) && strpos(get_class($data), "Collection") > 0) || is_array($data) ) {		
			$result = array();
													
			for($i = 0; $i < count($data);$i++) {											
				$result[$i] = $data[$i]->ToArray();
			}
		}
		elseif(is_object($data) && get_class($data) != "DateTime") {
			$result = $data->ToArray();			
		}
			
						
						
		return $result;	
		
	}
}

/* End of file MY_Entity.php */
/* Location: ./application/models/Entities/MY_Entity.php */