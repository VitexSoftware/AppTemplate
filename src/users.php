<?php

/**
 * Ease APP Template - Users list.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2020 Vitex Software
 */

namespace Ease\AppTemplate\Ui;

require_once './init.php';

$oPage->onlyForLogged();

//Engine::doThings($oPage);

$oPage->addItem(new PageTop(_('Users overview')));

//$oPage->addItem(new \Ease\TWB4\Container(new DataGrid(_('Uživatelé'), new User())));

$oPage->addItem(new PageBottom());

$oPage->draw();
