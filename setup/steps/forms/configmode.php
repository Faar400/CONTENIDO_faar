<?php
/**
 * Project:
 * CONTENIDO Content Management System
 *
 * Description:
 *
 * Requirements:
 * @con_php_req 5
 *
 * @package    CONTENIDO Backend <Area>
 * @version    0.2
 * @author     unknown
 * @copyright  four for business AG <www.4fb.de>
 * @license    http://www.contenido.org/license/LIZENZ.txt
 * @link       http://www.4fb.de
 * @link       http://www.contenido.org
 *
 *
 *
 * {@internal
 *   created  unknown
 *   modified 2008-07-07, bilal arslan, added security fix
 *
 *   $Id$:
 * }}
 *
 */

if (!defined('CON_FRAMEWORK')) {
    die('Illegal call');
}


class cSetupConfigMode extends cSetupMask
{
    function cSetupConfigMode($step, $previous, $next)
    {
        if ($_SESSION["setuptype"] == "setup") {
            cSetupMask::cSetupMask("templates/setup/forms/configmode.tpl", $step);
        } else {
            cSetupMask::cSetupMask("templates/setup/forms/configmodewopass.tpl", $step);
        }
        $this->setHeader(i18n("config.php mode"));
        $this->_oStepTemplate->set("s", "TITLE", i18n("config.php mode"));
        $this->_oStepTemplate->set("s", "DESCRIPTION", i18n("Please choose 'save' or 'download'"));
        $this->_oStepTemplate->set("s", "LABEL_DESCRIPTION", i18n("CONTENIDO requires a configuration file called 'config.php'. This file will be generated by the setup automatically if the filesystem permissions are correct. If 'save' is activated by default, setup can save the file config.php. If not, 'download' is activated by default, and you have to place the file in the directory &quot;contenido/includes/&quot; manually when a download prompt appears. The download prompt appears at the end of the setup process."));

        $oConfigSave = new cHTMLRadiobutton("configmode", "save");
        $oConfigSave->setLabelText(" ");
        $oConfigSave->setStyle('width:auto;border:0;');

        $oConfigDownload = new cHTMLRadiobutton("configmode", "download");
        $oConfigDownload->setLabelText(" ");
        $oConfigDownload->setStyle('width:auto;border:0;');

        if (canWriteFile(C_FRONTEND_PATH . "contenido/includes/config.php")) {
            $oConfigSave->setChecked(true);
        } else {
            $oConfigDownload->setChecked(true);
        }


        $oConfigSaveLabel = new cHTMLLabel(i18n("Save"), $oConfigSave->getId());
        $this->_oStepTemplate->set("s", "CONTROL_SAVE", $oConfigSave->render());
        $this->_oStepTemplate->set("s", "CONTROL_SAVELABEL", $oConfigSaveLabel->render());

        $oConfigDownloadLabel = new cHTMLLabel(i18n("Download"), $oConfigDownload->getId());
        $this->_oStepTemplate->set("s", "CONTROL_DOWNLOAD", $oConfigDownload->render());
        $this->_oStepTemplate->set("s", "CONTROL_DOWNLOADLABEL", $oConfigDownloadLabel->render());

        $this->setNavigation($previous, $next);
    }

    function _createNavigation()
    {
        $link = new cHTMLLink("#");

        if ($this->_bNextstep == "doinstall") {
            // Install launcher
        }

        $link->attachEventDefinition("pageAttach", "onclick", "document.setupform.step.value = '".$this->_bNextstep."'; document.setupform.submit();");

        $nextSetup = new cHTMLAlphaImage();
        $nextSetup->setSrc(C_SETUP_CONTENIDO_HTML_PATH . "images/submit.gif");
        $nextSetup->setMouseOver(C_SETUP_CONTENIDO_HTML_PATH . "images/submit_hover.gif");
        $nextSetup->setClass("button");

        $link->setContent($nextSetup);

        $this->_oStepTemplate->set("s", "NEXT", $link->render());

        $backlink = new cHTMLLink("#");
        $backlink->attachEventDefinition("pageAttach", "onclick", "document.setupform.step.value = '".$this->_bBackstep."';");
        $backlink->attachEventDefinition("submitAttach", "onclick", "document.setupform.submit();");

        $backSetup = new cHTMLAlphaImage();
        $backSetup->setSrc("images/controls/back.gif");
        $backSetup->setMouseOver("images/controls/back.gif");
        $backSetup->setClass("button");
        $backSetup->setStyle("margin-right: 10px");
        $backlink->setContent($backSetup);
        $this->_oStepTemplate->set("s", "BACK", $backlink->render());
    }
}

?>