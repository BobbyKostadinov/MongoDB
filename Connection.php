<?php
/**
 * Handle connections to MongoDB server
* @author Bobby Kostadinov b.a.kostadinov@gmail.com
 *
 */
class MongoDB_Connection
{
	public static $registryKey = 'mongoConnection';
    
    public static function connect()
    {
    	try {
    		
    		$config = Zend_Registry::get('config');
    		$connectionString = $config->MongoDB->connection_string;
    		if (!$connectionString) {
    			throw new Exception ('MongoDB connection string missing in configuration!');
    		}
    		
	    	if (!Zend_Registry::isRegistered(self::$registryKey)) {
	    		$connection =  new Mongo($connectionString);
	    		Zend_Registry::set(self::$registryKey, $connection);
	    	} else {
	    		$connection = Zend_Registry::get(self::$registryKey);
	    	}
	    	
    	} catch (Exception $e) {
    		$nSubject = new Notify_Events();
    		$nSubject->attach(new Notify_Handlers_Email());
    		$nSubject->exception = $e;
    		$nSubject->onInternalError();
    		throw new Exception(__FILE__ . ': Error connecting to MongoDB server');
    	}
    	
    	return $connection;
    }
    
    
}