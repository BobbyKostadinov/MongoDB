<?php
/**
 * Sale Cursor
 * 
 * @author Bobby Kostadinov b.a.kostadinov@gmail.com
 * @see http://www.php.net/manual/en/book.mongo.php
 * @see http://www.mongodb.com/
 *
 */
class Models_Logs_Cursors_Abstract extends MongoCursor
{
	
	/**
	 * @var MongoCursor
	 */
	protected $_cursor;
	
	public function __construct(MongoCursor $cursor)
    {
    	$this->_cursor = $cursor;
    }

	public function __call($method, $arguments)
	{
		// Forward the call to the MongoCursor
		$res = call_user_func_array(array($this->_cursor, $method), $arguments);
		
		// Allow chaining
		if ($res instanceof MongoCursor) {
			return $this;
		}
		
		return $res;
	}
}