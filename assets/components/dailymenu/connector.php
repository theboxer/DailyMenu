<?php
/**
 * DailyMenu Connector
 *
 * @package dailymenu
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('dailymenu.core_path',null,$modx->getOption('core_path').'components/dailymenu/');
require_once $corePath.'model/dailymenu/dailymenu.class.php';
$modx->dailymenu = new DailyMenu($modx);

$modx->lexicon->load('dailymenu:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->dailymenu->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));