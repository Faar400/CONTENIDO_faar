<?php

/**
 * This file contains the frontend group collection and item class.
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
 * Frontend group collection
 *
 * @package    Core
 * @subpackage GenericDB_Model
 * @method cApiFrontendGroup createNewItem
 * @method cApiFrontendGroup|bool next
 */
class cApiFrontendGroupCollection extends ItemCollection
{
    /**
     * Constructor to create an instance of this class.
     *
     * @throws cInvalidArgumentException
     */
    public function __construct()
    {
        parent::__construct(cRegistry::getDbTableName('frontendgroups'), 'idfrontendgroup');
        $this->_setItemClass('cApiFrontendGroup');

        // set the join partners so that joins can be used via link() method
        $this->_setJoinPartner('cApiClientCollection');
    }

    /**
     * Creates a new group
     *
     * @param string $groupname
     *         Specifies the groupname
     *
     * @return cApiFrontendGroup
     * @throws cDbException
     * @throws cException
     * @throws cInvalidArgumentException
     */
    public function create($groupname)
    {
        $client = cSecurity::toInteger(cRegistry::getClientId());

        $group = new cApiFrontendGroup();

        // _arrInFilters = ['urlencode', 'htmlspecialchars', 'addslashes'];

        $mangledGroupName = $group->inFilter($groupname);
        $this->select("idclient = " . cSecurity::toInteger($client) . " AND groupname = '" . $mangledGroupName . "'");

        if (($obj = $this->next()) !== false) {
            $groupname = $groupname . md5(rand());
        }

        $item = $this->createNewItem();
        $item->set('idclient', $client);
        $item->set('groupname', $groupname);
        $item->store();

        return $item;
    }

    /**
     * Overridden delete method to remove groups from groupmember table
     * before deleting group
     *
     * @param int $itemID
     *         specifies the frontend user group
     *
     * @return bool
     *
     * @throws cDbException
     * @throws cException
     * @throws cInvalidArgumentException
     */
    public function delete($itemID)
    {
        $associations = new cApiFrontendGroupMemberCollection();
        $associations->select('idfrontendgroup = ' . (int)$itemID);

        while (($item = $associations->next()) !== false) {
            $associations->delete($item->get('idfrontendgroupmember'));
        }

        return parent::delete($itemID);
    }
}

/**
 * Frontend group item
 *
 * @package    Core
 * @subpackage GenericDB_Model
 */
class cApiFrontendGroup extends Item
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
        parent::__construct(cRegistry::getDbTableName('frontendgroups'), 'idfrontendgroup');
        if ($mId !== false) {
            $this->loadByPrimaryKey($mId);
        }
    }
}
