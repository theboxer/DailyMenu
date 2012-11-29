<?php
/**
 * Remove an Item.
 * 
 * @package dailymenu
 * @subpackage processors
 */
class DailyMenuDishRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'DailyMenuDish';
    public $languageTopics = array('dailymenu:default');
    public $objectType = 'dailymenu.dish';
}
return 'DailyMenuDishRemoveProcessor';