<?php


use Ease\AppTemplate\Ui\AppsMenu;
use Ease\AppTemplate\Ui\DbStatus;
use Ease\AppTemplate\Ui\PageBottom;
use Ease\AppTemplate\Ui\PageTop;

/**
 * Ease APP Template - Index page.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2020 Vitex Software
 */

namespace Ease\AppTemplate\Ui;

require_once './init.php';

$oPage->onlyForLogged();

$oPage->addItem(new PageTop(_('Ease APP Template')));


$oPage->addItem(new PageBottom());

$oPage->draw();
