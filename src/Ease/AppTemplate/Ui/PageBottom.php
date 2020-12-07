<?php

/**
 * Multi FlexiBee Setup  - Shared page bottom class
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2020 Vitex Software
 */

namespace Ease\AppTemplate\Ui;

/**
 * Page Bottom
 *
 * @package    VitexSoftware
 * @author     Vitex <vitex@hippy.cz>
 */
class PageBottom extends \Ease\Html\FooterTag {

    /**
     * Zobrazí přehled právě přihlášených a spodek stránky
     */
    public function finalize() {
        $composer = 'composer.json';
        if (!file_exists($composer)) {
            $composer = '../' . $composer;
        }
        
        $this->includeCSS('https://use.fontawesome.com/releases/v5.3.1/css/all.css');

        $appInfo = json_decode(file_get_contents($composer));

        $container = $this->setTagID('footer');

//        if (\Ease\Shared::user()->getUserID()) {
//        $this->addItem(new \Ease\ui\BrowsingHistory());
//        }
        $this->addItem('<hr>');
        $footrow = new \Ease\TWB4\Row();

        $author = \Ease\Functions::cfg('APP_NAME') . ' v.: ' . $appInfo->version . '&nbsp;&nbsp; &copy; 2020 <a href="http://vitexsoftware.cz/">Vitex Software</a>';

        $footrow->addColumn(6, [$author]);

        $this->addItem(new \Ease\TWB4\Container($footrow));
    }

}
