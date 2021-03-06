<?php

/**
 * Ease APP Template - User editor.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2020 Vitex Software
 */

namespace Ease\AppTemplate\Ui;

require_once './init.php';

$oPage->onlyForLogged();

$user_id = $oPage->getRequestValue('id', 'int');

//$user = Engine::doThings($oPage);
//if (is_null($user)) {
$user = new \Ease\AppTemplate\User($user_id);
//}

if ($oPage->getGetValue('delete', 'bool') == 'true') {
    if ($user->delete()) {
        $oPage->redirect('users.php');
        exit;
    }
}

$oPage->addItem(new PageTop(_('User')));

switch ($oPage->getRequestValue('action')) {
    case 'delete':

        $confirmBlock = new \Ease\TWB4\Well();

        $confirmBlock->addItem($user);

        $confirmator = $confirmBlock->addItem(new \Ease\TWB4\Panel(_('Really delete ?')), 'danger');
        $confirmator->addItem(new \Ease\TWB4\LinkButton('user.php?id=' . $user->getId(), _('No') . ' ' . \Ease\TWB4\Part::glyphIcon('ok'), 'success'));
        $confirmator->addItem(new \Ease\TWB4\LinkButton('?delete=true&' . $user->keyColumn . '=' . $user->getID(), _('Yes') . ' ' . \Ease\TWB4\Part::glyphIcon('remove'), 'danger'));

        $oPage->container->addItem(new \Ease\TWB4\Panel('<strong>' . $user->getUserName() . '</strong>', 'info', $confirmBlock));

        break;
    default :

//        $operationsMenu = $user->operationsMenu();
//        $operationsMenu->setTagCss(['float' => 'right']);
//        $operationsMenu->dropdown->addTagClass('pull-right');

        $oPage->container->addItem(new \Ease\TWB4\Panel(['<strong>' . $user->getUserName() . '</strong>', /* $operationsMenu */], 'info', new UserForm($user)));
        break;
}

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
