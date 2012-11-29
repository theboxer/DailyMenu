<?php
/**
 * Loads the home page.
 *
 * @package dailymenu
 * @subpackage controllers
 */
class DailyMenuHomeManagerController extends DailyMenuBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('dailymenu'); }
    public function loadCustomCssJs() {
        $this->addJavascript($this->dailymenu->config['jsUrl'].'mgr/extra/griddraganddrop.js');
        $this->addJavascript($this->dailymenu->config['jsUrl'].'mgr/widgets/dishes.grid.js');
        $this->addJavascript($this->dailymenu->config['jsUrl'].'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->dailymenu->config['jsUrl'].'mgr/sections/home.js');
    }
    public function getTemplateFile() { return $this->dailymenu->config['templatesPath'].'home.tpl'; }
}