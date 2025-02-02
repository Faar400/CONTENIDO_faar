<?php

/**
 * This file contains the right collection and item class.
 *
 * @package    Core
 * @subpackage GenericDB_Model
 * @author     Murat Purc <murat@purc.de>
 * @copyright  four for business AG <www.4fb.de>
 * @license    https://www.contenido.org/license/LIZENZ.txt
 * @link       https://www.4fb.de
 * @link       https://www.contenido.org
 */

defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

/**
 * Right collection
 *
 * @package    Core
 * @subpackage GenericDB_Model
 * @method cApiRight createNewItem
 * @method cApiRight|bool next
 */
class cApiRightCollection extends ItemCollection
{
    /**
     * Constructor to create an instance of this class.
     *
     * @throws cInvalidArgumentException
     */
    public function __construct()
    {
        parent::__construct(cRegistry::getDbTableName('rights'), 'idright');
        $this->_setItemClass('cApiRight');

        // set the join partners so that joins can be used via link() method
        $this->_setJoinPartner('cApiUserCollection');
        $this->_setJoinPartner('cApiAreaCollection');
        $this->_setJoinPartner('cApiActionCollection');
        $this->_setJoinPartner('cApiCategoryCollection');
        $this->_setJoinPartner('cApiClientCollection');
        $this->_setJoinPartner('cApiLanguageCollection');
    }

    /**
     * Creates a right entry.
     *
     * @param string $userId
     * @param int $idarea
     * @param int $idaction
     * @param int $idcat
     * @param int $idclient
     * @param int $idlang
     * @param int $type
     *
     * @return cApiRight
     * @throws cDbException
     * @throws cException
     * @throws cInvalidArgumentException
     */
    public function create($userId, $idarea, $idaction, $idcat, $idclient, $idlang, $type)
    {
        $oItem = $this->createNewItem();

        $oItem->set('user_id', $userId);
        $oItem->set('idarea', $idarea);
        $oItem->set('idaction', $idaction);
        $oItem->set('idcat', $idcat);
        $oItem->set('idclient', $idclient);
        $oItem->set('idlang', $idlang);
        $oItem->set('type', $type);

        $oItem->store();

        return $oItem;
    }

    /**
     * Checks if a specific user has frontend access to a protected category.
     *
     * @param int $idcat
     * @param string $userId
     *
     * @return bool
     *
     * @throws cDbException
     */
    public function hasFrontendAccessByCatIdAndUserId($idcat, $userId)
    {
        $sql = "SELECT :pk FROM `:rights` AS A, `:actions` AS B, `:area` AS C
                WHERE B.name = 'front_allow' AND C.name = 'str' AND A.user_id = ':userid'
                    AND A.idcat = :idcat AND A.idarea = C.idarea AND B.idaction = A.idaction
                LIMIT 1";

        $params = [
            'pk' => $this->getPrimaryKeyName(),
            'rights' => $this->table,
            'actions' => cRegistry::getDbTableName('actions'),
            'area' => cRegistry::getDbTableName('area'),
            'userid' => $userId,
            'idcat' => (int)$idcat,
        ];

        $sql = $this->db->prepare($sql, $params);
        $this->db->query($sql);
        return $this->db->nextRecord();
    }

    /**
     * Deletes right entries by user id.
     *
     * @param string $userId
     *
     * @return bool
     *
     * @throws cDbException
     * @throws cInvalidArgumentException
     * @todo Implement functions to delete rights by area, action, cat, client,
     *       language.
     *
     */
    public function deleteByUserId($userId)
    {
        $result = $this->deleteBy('user_id', $userId);
        return $result > 0;
    }

}

/**
 * Right item
 *
 * @package    Core
 * @subpackage GenericDB_Model
 */
class cApiRight extends Item
{
    /**
     * Constructor to create an instance of this class.
     *
     * @param mixed $mId [optional]
     *                   Specifies the ID of item to load
     *
     * @throws cDbException
     * @throws cException
     */
    public function __construct($mId = false)
    {
        parent::__construct(cRegistry::getDbTableName('rights'), 'idright');
        $this->setFilters([], []);
        if ($mId !== false) {
            $this->loadByPrimaryKey($mId);
        }
    }

    /**
     * User-defined setter for right fields.
     *
     * @param string $name
     * @param mixed $value
     * @param bool $bSafe [optional]
     *         Flag to run defined inFilter on passed value
     * @return bool
     */
    public function setField($name, $value, $bSafe = true)
    {
        switch ($name) {
            case 'idaction':
            case 'idcat':
            case 'idclient':
            case 'idlang':
            case 'type':
            case 'idarea':
                $value = cSecurity::toInteger($value);
                break;
        }

        return parent::setField($name, $value, $bSafe);
    }

}
