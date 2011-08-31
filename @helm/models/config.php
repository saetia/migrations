<?php
class Config {
	
	private static $instance;
	private static $configuration = array();
	private function __construct(){}
	
	private function __clone(){}
	
	public static function get($property=null){
		
		if (is_null(self::$instance)){
			self::$instance = new Config();
		}
		
		try {
		
			if (is_null($property)){ throw new Exception("You must supply a property when using get()"); return false; }
			
			$value = self::$configuration;
			
			$parts = explode('.',$property);
			
			foreach ($parts as $part){
				
				if (!isset($value[$part])){
					
					throw new Exception(htmlentities(strip_tags($property))." is not a property. (".htmlentities(strip_tags($part)).") was not found.");
					
				}
				
				$value = $value[$part];
			}
		
			return $value;
			
			
		} catch (Exception $e){
			
			if (class_exists('Console',true)){Console::warn($e->getMessage());}

		}
		
		return false;
		
	}
	
	public static function set($property,$set){
		
		$properties = explode('.',$property);

		if (sizeof($properties) > 4){
			throw new Exception("Do not nest configuration values deeper than 4 levels.");
		}


		switch(sizeof($properties)){
		case 1:

			if (isset(self::$configuration[$property])){
				
				if (is_array(self::$configuration[$property])){
					
					if (is_array($set)){
						
						self::$configuration[$property] = array_merge($set, self::$configuration[$property]);
						
					} else {
					
						throw new Exception("You cannot overwrite {$property}");
						
					}
					
					
				} else {
					
					throw new Exception("You cannot overwrite {$property}");
				
				}
				

			} else {
				self::$configuration[$property] = $set;	
			}
	  
			break;	
		case 2:

			
			if (isset(self::$configuration[$properties[0]][$properties[1]])){
				throw new Exception("You cannot overwrite {$property}");
			} else {
				self::$configuration[$properties[0]][$properties[1]] = $set;	
			}


			break;	
		case 3:

			if (isset(self::$configuration[$properties[0]][$properties[1]][$properties[2]])){
				throw new Exception("You cannot overwrite {$property}");
			} else {
				self::$configuration[$properties[0]][$properties[1]][$properties[2]] = $set;	
			}

			break;

		case 4:

			if (isset(self::$configuration[$properties[0]][$properties[1]][$properties[2]][$properties[3]])){
				throw new Exception("You cannot overwrite {$property}");
			} else {
				self::$configuration[$properties[0]][$properties[1]][$properties[2]][$properties[3]] = $set;	
			}

			break;

		default:
				
		}
		return $set;
	}
	
	
	public static function import_yaml($file){
		self::$configuration = array_merge_recursive(self::$configuration,Spyc::YAMLLoad($file));		
	}
	
	
	public static function display(){
		return (array)self::$configuration;
	}
	
	
	public static function export_yaml($string = null){
		$string = (is_null($string)) ? self::$configuration : $string;
		return Spyc::YAMLDump($string);
	}
	
	
}
?>