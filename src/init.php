<?php

/**
 * Ease APP Template - shared init.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2020 Vitex Software
 */

namespace Ease\AppTemplate;

use Ease\Shared;
use Ease\AppTemplate\Ui\WebPage;

require_once '../vendor/autoload.php';


\Ease\Shared::instanced()->loadConfig('../.env',true);
$lc = new \Ease\Locale(null, '../i18n', 'apptemplate');

session_start();

//define('EASE_LOGGER', 'syslog|\Ease\AppTemplate\LogToSQL');

$oUser = Shared::user(null, 'Ease\AppTemplate\User');
$oPage = new WebPage();
