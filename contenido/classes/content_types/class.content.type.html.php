<?php
/**
 * This file contains the cContentTypeHtml class.
 *
 * @package Core
 * @subpackage Content Type
 * @version SVN Revision $Rev:$
 *
 * @author Simon Sprankel
 * @copyright four for business AG <www.4fb.de>
 * @license http://www.contenido.org/license/LIZENZ.txt
 * @link http://www.4fb.de
 * @link http://www.contenido.org
 */

if (!defined('CON_FRAMEWORK')) {
    die('Illegal call');
}

/**
 * Content type CMS_HTML which lets the editor enter HTML with the help of a
 * WYSIWYG editor.
 *
 * @package Core
 * @subpackage Content Type
 */
class cContentTypeHtml extends cContentTypeAbstract {

    /**
     * Initialises class attributes and handles store events.
     *
     * @param string $rawSettings the raw settings in an XML structure or as
     *        plaintext
     * @param integer $id ID of the content type, e.g. 3 if CMS_DATE[3] is
     *        used
     * @param array $contentTypes array containing the values of all content
     *        types
     * @return void
     */
    public function __construct($rawSettings, $id, array $contentTypes) {
        // change attributes from the parent class and call the parent
        // constructor
        parent::__construct($rawSettings, $id, $contentTypes);
        $this->_type = 'CMS_HTML';
        $this->_prefix = 'html';
    }

    /**
     * Generates the code which should be shown if this content type is shown in
     * the frontend.
     *
     * @return string escaped HTML code which sould be shown if content type is
     *         shown in frontend
     */
    public function generateViewCode() {
        return $this->_encodeForOutput($this->_rawSettings);
    }

    /**
     * Generates the code which should be shown if this content type is edited.
     *
     * @return string escaped HTML code which should be shown if content type is
     *         edited
     */
    public function generateEditCode() {
        $wysiwygDiv = new cHTMLDiv();

        // generate the div ID - format: TYPEWITHOUTCMS_TYPEID_ID
        // important because it is used to save the content accordingly
        $id = str_replace('CMS_', '', $this->_type) . '_';
        $db = cRegistry::getDb();
        $sql = 'SELECT `idtype` FROM `' . $this->_cfg['tab']['type'] . '` WHERE `type`=\'' . $this->_type . '\'';
        $db->query($sql);
        $db->next_record();
        $id .= $db->f('idtype') . '_' . $this->_id;
        $wysiwygDiv->setId($id);

        $wysiwygDiv->setEvent('Focus', "this.style.border='1px solid #bb5577';");
        $wysiwygDiv->setEvent('Blur', "this.style.border='1px dashed #bfbfbf';");
        $wysiwygDiv->appendStyleDefinitions(array(
            'border' => '1px dashed #bfbfbf',
            'direction' => langGetTextDirection($this->_lang)
        ));
        $wysiwygDiv->updateAttribute('contentEditable', 'true');
        $wysiwygDiv->setContent($this->_rawSettings);

        // construct edit button
        $editLink = $this->_session->url($this->_cfg['path']['contenido_fullhtml'] . 'external/backendedit/' . 'front_content.php?action=10&idcat=' . $this->_idCat . '&idart=' . $this->_idArt . '&idartlang=' . $this->_idArtLang . '&type=' . $this->_type . '&typenr=' . $this->_id. '&client=' . $this->_client);
        $editAnchor = new cHTMLLink("javascript:setcontent('" . $this->_idArtLang . "','" . $editLink . "');");
        $editButton = new cHTMLImage($this->_cfg['path']['contenido_fullhtml'] . $this->_cfg['path']['images'] . 'but_edithtml.gif');
        $editButton->appendStyleDefinition('margin-right', '2px');
        $editAnchor->setContent($editButton);

        // construct save button
        $saveAnchor = new cHTMLLink();
        $saveAnchor->setLink("javascript:setcontent('" . $this->_idArtLang . "', '0')");
        $saveButton = new cHTMLImage($this->_cfg['path']['contenido_fullhtml'] . $this->_cfg['path']['images'] . 'but_ok.gif');
        $saveAnchor->setContent($saveButton);

        return $this->_encodeForOutput($wysiwygDiv->render() . $editAnchor->render() . $saveAnchor->render());
    }

}