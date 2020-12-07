<?php

/**
 * Multi FlexiBee Setup  - Main Menu
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2020 Vitex Software
 */

namespace Ease\AppTemplate\Ui;

/**
 * Description of MainMenu
 *
 * @author vitex
 */
class MainMenu extends \Ease\Html\DivTag {

    /**
     * Vytvoří hlavní menu.
     */
    public function __construct() {
        parent::__construct(null, ['id' => 'MainMenu']);
    }

    /**
     * Data source.
     *
     * @param \Ease\SQL\Engine   $source
     * @param string $icon   Icon column
     *
     * @return string
     */
    protected function getMenuList($source, $icon = null) {
        $keycolumn = $source->getkeyColumn();
        $namecolumn = $source->nameColumn;
        $lister = $source->getColumnsFromSQL([$source->getkeyColumn(), $namecolumn, $icon],
                null, $namecolumn, $keycolumn);

        $itemList = [];
        if ($lister) {
            foreach ($lister as $uID => $uInfo) {
                if ($icon && array_key_exists($icon, $uInfo)) {
                    $logo = new \Ease\Html\ImgTag($uInfo[$icon], $uInfo[$namecolumn], ['height' => 20]) . '&nbsp;';
                } else {
                    $logo = '';
                }
                $itemList[$source->keyword . '.php?' . $keycolumn . '=' . $uInfo[$keycolumn]] = $logo . $uInfo[$namecolumn];
            }
        }

        return $itemList;
    }

    /**
     * Insert menu.
     */
    public function afterAdd() {
        $nav = $this->addItem(new BootstrapMenu('main-menu', null, ['class' => 'navbar navbar-expand-lg navbar-light bg-light']));


        if (\Ease\Shared::user()->isLogged()) { //Authenticated user
            
            $this->usersMenuEnabled($nav);
            
            $nav->addMenuItem(new \Ease\Html\ATag('logout.php', '<img height=30 src=images/application-exit.svg> ' . _('Sign Off')), 'right');
            
        }
    }

    public function usersMenuEnabled($nav) {
        $nav->addDropDownMenu('<img width=30 src=images/users-young.svg> ' . _('Admin'),
                array_merge([
            'createaccount.php' => _('New User'),
            'users.php' => new \Ease\TWB4\Widgets\FaIcon('list') . '&nbsp;' . _('Users Overview'),
            '' => '',
                        ], $this->getMenuList(\Ease\Shared::user(), 'user'))
        );
    }

    /**
     * Přidá do stránky javascript pro skrývání oblasti stavových zpráv.
     */
    public function finalize() {

        if (!empty(\Ease\Shared::logger()->getMessages())) {

            WebPage::singleton()->addCss('
#smdrag { height: 8px; 
          background-image:  url( images/slidehandle.png ); 
          background-color: #ccc; 
          background-repeat: no-repeat; 
          background-position: top center; 
          cursor: ns-resize;
}
#smdrag:hover { background-color: #f5ad66; }

');

            $this->addItem(WebPage::singleton()->getStatusMessagesBlock(['id' => 'status-messages', 'title' => _('Click to hide messages')]));
            $this->addItem(new \Ease\Html\DivTag(null, ['id' => 'smdrag', 'style' => 'margin-bottom: 5px']));
            \Ease\Shared::logger()->cleanMessages();
            WebPage::singleton()->addCss('.dropdown-menu { overflow-y: auto } ');
            WebPage::singleton()->addJavaScript("$('.dropdown-menu').css('max-height',$(window).height()-100);",
                    null, true);
            WebPage::singleton()->includeJavaScript('js/slideupmessages.js');
        }
    }

}
