<?php
/**
 * Update an Item
 * 
 * @package dailymenu
 * @subpackage processors
 */

class DailyMenuDishUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'DailyMenuDish';
    public $languageTopics = array('dailymenu:default');
    public $objectType = 'dailymenu.dish';
}
return 'DailyMenuDishUpdateProcessor';