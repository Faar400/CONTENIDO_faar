<?php

/**
 * This file contains the config mode setup mask.
 *
 * @package    Setup
 * @subpackage Form
 * @author     Unknown
 * @copyright  four for business AG <www.4fb.de>
 * @license    https://www.contenido.org/license/LIZENZ.txt
 * @link       https://www.4fb.de
 * @link       https://www.contenido.org
 */

defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

/**
 * Config mode setup mask.
 *
 * @package    Setup
 * @subpackage Form
 */
class cSetupConfigMode extends cSetupMask {

    /**
     * cSetupConfigMode constructor.
     * @param string $step
     * @param string $previous
     * @param string $next
     */
    public function __construct($step, $previous, $next) {
        $cfg = cRegistry::getConfig();

        if ($_SESSION['setuptype'] == 'setup') {
            cSetupMask::__construct("templates/setup/forms/configmode.tpl", $step);
        } else {
            cSetupMask::__construct("templates/setup/forms/configmodewopass.tpl", $step);
        }
        $this->setHeader(i18n("config.php mode", "setup"));
        $this->_stepTemplateClass->set("s", "TITLE", i18n("config.php mode", "setup"));
        $this->_stepTemplateClass->set("s", "DESCRIPTION", i18n("Please choose 'save' or 'download'", "setup"));
        $this->_stepTemplateClass->set("s", "LABEL_DESCRIPTION", i18n("CONTENIDO requires a configuration file called 'config.php'. This file will be generated by the setup automatically if the filesystem permissions are correct. If 'save' is activated by default, setup can save the file config.php. If not, 'download' is activated by default, and you have to place the file in the directory &quot;data/config/{environment}/&quot; manually when a download prompt appears. The download prompt appears at the end of the setup process.", "setup"));

        $oConfigSave = new cHTMLRadiobutton("configmode", "save");
        $oConfigSave->setLabelText(i18n("Save", "setup"));
        $oConfigSave->setStyle('width:auto;border:0;');

        $oConfigDownload = new cHTMLRadiobutton("configmode", "download");
        $oConfigDownload->setLabelText(i18n("Download", "setup"));
        $oConfigDownload->setStyle('width:auto;border:0;');

        if (canWriteFile($cfg['path']['contenido_config'] . 'config.php')) {
            $oConfigSave->setChecked(true);
        } else {
            $oConfigDownload->setChecked(true);
        }

        $this->_stepTemplateClass->set("s", "CONTROL_SAVE", $oConfigSave->render());
        $this->_stepTemplateClass->set("s", "CONTROL_DOWNLOAD", $oConfigDownload->render());

        $this->setNavigation($previous, $next);
    }

    /**
     * Old constructor
     * @deprecated [2016-04-14] This method is deprecated and is not needed any longer. Please use __construct() as constructor function.
     * @param string $step
     * @param string $previous
     * @param string $next
     */
    public function cSetupConfigMode($step, $previous, $next) {
        cDeprecated('This method is deprecated and is not needed any longer. Please use __construct() as constructor function.');
        $this->__construct($step, $previous, $next);
    }

    /**
     * (non-PHPdoc)
     * @see cSetupMask::_createNavigation()
     */
    protected function _createNavigation() {
        $link = new cHTMLLink("#");

        if ($this->_nextstep == "doinstall") {
            // Install launcher
        }

        $link->attachEventDefinition("pageAttach", "onclick", "document.setupform.step.value = '".$this->_nextstep."'; document.setupform.submit();");
        $link->setClass("nav");
        $link->setContent("<span>&raquo;</span>");
        $this->_stepTemplateClass->set("s", "NEXT", $link->render());

        $backlink = new cHTMLLink("#");
        $backlink->attachEventDefinition("pageAttach", "onclick", "document.setupform.step.value = '".$this->_backstep."';");
        $backlink->attachEventDefinition("submitAttach", "onclick", "document.setupform.submit();");
        $backlink->setClass("nav navBack");
        $backlink->setContent("<span>&raquo;</span>");
        $this->_stepTemplateClass->set("s", "BACK", $backlink->render());
    }

}
