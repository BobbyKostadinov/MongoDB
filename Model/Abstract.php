<?php
/**
 * Abstract class for Model for managing MongoDB collections
 * 
* @author Bobby Kostadinov b.a.kostadinov@gmail.com
 * @see http://www.php.net/manual/en/book.mongo.php
 * @see http://www.mongodb.com/
 *
 */
abstract class  MongoDB_Model_Abstract 
{
	
	/**
	 * Mongo DB name
	 */
    protected $_dbName;
    
    /**
     * Mongo Collection name
     * 
     */
    protected $_collectionName;
    
    /**
     * Collection object
     * @var MongoCollection
     * @see  http://www.php.net/manual/en/class.mongocollection.php 
     */
    protected $oCollection = null;
    
    /**
     * Init collection
     */
    public function __construct()
    {
    	$mongo = MongoDB_Connection::connect();
    	$this->oCollection = $mongo->selectDB($this->_dbName)->selectCollection($this->_collectionName);
    	
    	if (! ($this->oCollection instanceof MongoCollection) ) {
    		throw new Zend_Exception('Error connecting to or retrieving MongoDB collection');;
    	}
    }

}