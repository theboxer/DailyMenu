<?php
/**
 * Create an dishes
 *
 * @package dailymenu
 * @subpackage processors
 */
class DailyMenuDishesCreateProcessor extends modObjectProcessor {
    public $classKey = 'DailyMenuDish';
    public $languageTopics = array('dailymenu:default');
    public $objectType = 'dailymenu.dish';

    public function beforeSet(){
        $date = $this->getProperty('date');
        $dishes = $this->getProperty('dishes');


        if ($date == $this->modx->lexicon('today')) {
            $today = new DateTime();
            $today->setTime(0,0,0);
            $this->setProperty('date', $today->format('Y-m-d H:i:s'));
        }

        if (empty($dishes)) {
            $this->addFieldError('dishes',$this->modx->lexicon('dailymenu.dishes_err_ns'));
        }

        return !$this->hasErrors();
    }

    public function process(){
        $canSave = $this->beforeSet();
        if ($canSave !== true) {
            return $this->failure($canSave);
        }

        $date = $this->getProperty('date');
        $dishes = $this->getProperty('dishes');

        $dishes = preg_split("/(\r\n|\n|\r)/", $dishes);

        foreach($dishes as $dish){
            $dish = preg_replace('!\s+!', ' ', $dish);
            $matches = array();
            $returnValue = preg_match_all('/[0-9]+[0-9 \t]*/', $dish, $matches);

            if($returnValue > 0){
                $price = trim($matches[0][count($matches[0]) - 1]);
                $currency = explode($price, $dish);
                $name = trim($currency[0]);
                $currency = trim($currency[count($currency) - 1]);
                $price .= " " . $currency;

                $currentDishes = $this->modx->getCollection($this->classKey, array('date' => $date));


                /* @var $dishObject DailyMenuDish */
                $dishObject = $this->modx->newObject($this->classKey);
                $dishObject->set('name', $name);
                $dishObject->set('price', $price);
                $dishObject->set('bold', 0);
                $dishObject->set('date', $date);
                $dishObject->set('position', count($currentDishes));
                $dishObject->save();

            }else{
                $this->addFieldError('dishes',$this->modx->lexicon('dailymenu.price_err_ns'));
                return $this->failure();
            }
        }

        return $this->success();
    }
}
return 'DailyMenuDishesCreateProcessor';
