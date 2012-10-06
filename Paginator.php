<?php

/**
* @see Zend_Paginator_Adapter_Interface
*/
require_once 'Zend/Paginator/Adapter/Interface.php';

/**
* Paginator for MongoCursor
* @author Bobby Kostadinov b.a.kostadinov@gmail.com
*/
class MongoDB_Paginator implements Zend_Paginator_Adapter_Interface
{

/**
* Cursor
*
* @var MongoCursor
*/
    protected $_cursor = null;

    /**
* Constructor.
*
* @param MongoCursor $cursor
*/
    public function __construct(MongoCursor $cursor)
    {
        $this->_cursor = $cursor;
    }
	
	/**
	 * Returns an cursor limited to items for a page.
	 *
	 * @param integer $offset Page offset
	 * @param integer $itemCountPerPage Number of items per page
	 * @return MongoCursor
	*/
	public function getItems($offset, $itemCountPerPage)
	{
		$cursor = $this->_cursor->skip($offset)->limit($itemCountPerPage);
		return $cursor;
	}
	
	/**
	 * Returns the total number of rows in the cursor.
	 *
	 * @return integer
	*/
    public function count()
    {
        return $this->_cursor->count();
    }
}