<?php
$dailymenu = $modx->getService('dailymenu','DailyMenu',$modx->getOption('dailymenu.core_path',null,$modx->getOption('core_path').'components/dailymenu/').'model/dailymenu/',$scriptProperties);
if (!($dailymenu instanceof DailyMenu)) return '';


$m = $modx->getManager();
$m->createObjectContainer('DailyMenuDish');
return 'Table created.';