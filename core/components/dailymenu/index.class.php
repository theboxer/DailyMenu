<?php
require_once dirname(__FILE__) . '/model/dailymenu/dailymenu.class.php';
/**
 * @package dailymenu
 */
class IndexManagerController extends DailyMenuBaseManagerController {
    public static function getDefaultController() { return 'home'; }
}

abstract class DailyMenuBaseManagerController extends modExtraManagerController {
    /** @var DailyMenu $dailymenu */
    public $dailymenu;
    public function initialize() {
        $this->dailymenu = new DailyMenu($this->modx);

        $this->addCss($this->dailymenu->config['cssUrl'].'mgr.css');
        $this->addJavascript($this->dailymenu->config['jsUrl'].'mgr/dailymenu.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            DailyMenu.config = '.$this->modx->toJSON($this->dailymenu->config).';
            DailyMenu.config.connector_url = "'.$this->dailymenu->config['connectorUrl'].'";
        });
        </script>');
        return parent::initialize();
    }
    public function getLanguageTopics() {
        return array('dailymenu:default');
    }
    public function checkPermissions() { return true;}
}