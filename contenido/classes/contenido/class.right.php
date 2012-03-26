<?php
/**
 * Project:
 * CONTENIDO Content Management System
 *
 * Description:
 * Rights management class
 *
 * Requirements:
 * @con_php_req 5.0
 *
 *
 * @package    CONTENIDO API
 * @version    0.1.1
 * @author     Murat Purc <murat@purc.de>
 * @copyright  four for business AG <www.4fb.de>
 * @license    http://www.contenido.org/license/LIZENZ.txt
 * @link       http://www.4fb.de
 * @link       http://www.contenido.org
 *
 * {@internal
 *   created  2011-10-25
 *
 *   $Id: $:
 * }}
 *
 */

if (!defined('CON_FRAMEWORK')) {
    die('Illegal call');
}


/**
 * Right collection
 * @package    CONTENIDO API
 * @subpackage Model
 */
class cApiRightCollection extends ItemCollection
{
    /**
     * Constructor
     */
    public function __construct()
    {
        global $cfg;
        parent::__construct($cfg['tab']['rights'], 'idright');
        $this->_setItemClass('cApiRight');
    }

    /**
     * Creates a right entry.
     *
     * @param  string  $userId
     * @param int $idarea
     * @param int $idaction
     * @param int $idcat
     * @param int $idclient
     * @param int $idlang
     * @param int $type
     * @return cApiRight
     */
    public function create($userId, $idarea, $idaction, $idcat, $idclient, $idlang, $type)
    {
        $oItem = parent::create();

        $oItem->set('user_id', $this->escape($userId));
        $oItem->set('idarea', (int) $idarea);
        $oItem->set('idaction', (int) $idaction);
        $oItem->set('idcat', (int) $idcat);
        $oItem->set('idclient', (int) $idclient);
        $oItem->set('idlang', (int) $idlang);
        $oItem->set('type', (int) $type);

        $oItem->store();

        return $oItem;
    }

    /**
     * Deletes right entries by user id.
     *
     * @todo  Implement functions to delete rights by area, action, cat, client, language.
     * @param  string  $userId
     * @return  bool
     */
    public function deleteByUserId($userId)
    {
        $result = $this->deleteBy('user_id', $userId);
        return ($result > 0) ? true : false;
    }

}


/**
 * Right item
 * @package    CONTENIDO API
 * @subpackage Model
 */
class cApiRight extends Item
{

    /**
     * Constructor function
     * @param  mixed  $mId  Specifies the ID of item to load
     */
    public function __construct($mId = false)
    {
        global $cfg;
        parent::__construct($cfg['tab']['rights'], 'idright');
        $this->setFilters(array(), array());
        if ($mId !== false) {
            $this->loadByPrimaryKey($mId);
        }
    }
}

?>