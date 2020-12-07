<?php
namespace Ease\AppTemplate\Ui;

use Ease\TWB4\LinkButton;
use Ease\AppTemplate\Ui\PageBottom;
use Ease\AppTemplate\Ui\PageTop;

/**
 * Ease APP Template - Index page.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2020 Vitex Software
 */

require_once './init.php';

$oPage->addItem(new PageTop(_('Ease APP Template')));

if (empty($oUser->listingQuery()->count())) {
    $oUser->addStatusMessage(_('There is no administrators in the database.'), 'warning');
    $oPage->container->addItem(new LinkButton('createaccount.php', _('Create first Administrator Account'), 'success'));
}



$oPage->addItem(new PageBottom());

$oPage->draw();
