<?php
/**
 * Create a dish
 * 
 * @package dailymenu
 * @subpackage processors
 */
class DailyMenuDishCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'DailyMenuDish';
    public $languageTopics = array('dailymenu:default');
    public $objectType = 'dailymenu.dish';

    public function beforeSet(){
        $date = $this->getProperty('date');


        if ($date == $this->modx->lexicon('today')) {
            $today = new DateTime();
            $today->setTime(0,0,0);
            $date = $today->format('Y-m-d H:i:s');
            $this->setProperty('date', $date);
        }

        $dishes = $this->modx->getCollection($this->classKey, array('date' => $date));

        $this->setProperty('position', count($dishes));

        return parent::beforeSet();
    }

    public function beforeSave() {
        $name = $this->getProperty('name');
        $price = $this->getProperty('price');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('dailymenu.dish_err_ns'));
        }

        if (empty($price)) {
            $this->addFieldError('price',$this->modx->lexicon('dailymenu.price_err_ns'));
        }
        return parent::beforeSave();
    }
}
return 'DailyMenuDishCreateProcessor';
