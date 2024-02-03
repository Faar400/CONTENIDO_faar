<?php

/**
 * CONTENIDO setup script. Main entry point for the setup requests.
 *
 * @package    Setup
 * @subpackage Setup
 * @author     Murat Purc <murat@purc.de>
 * @copyright  four for business AG <www.4fb.de>
 * @license    https://www.contenido.org/license/LIZENZ.txt
 * @link       https://www.4fb.de
 * @link       https://www.contenido.org
 */

if (!defined('CON_FRAMEWORK')) {
    define('CON_FRAMEWORK', true);
}

include_once('lib/startup.php');

// Detect controller
$controller = $_GET['c'] ?? '';
if (!in_array($controller, ['index', 'db', 'config'])) {
    die('Illegal setup call');
}

// Include detected controller
$fileName = 'include.' . $controller . '.controller.php';
$filePathName = CON_SETUP_PATH . '/lib/' . $fileName;
if (is_file($filePathName)) {
    include($filePathName);
} else {
    die('Illegal setup call 2');
}
