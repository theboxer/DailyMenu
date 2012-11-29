<?php
/**
 * Reorder dishes
 *
 * @package dailymenu
 * @subpackage processors
 */
class DailyMenuReorderDishUpdateProcessor extends modObjectProcessor {
    public $classKey = 'DailyMenuDish';
    public $languageTopics = array('dailymenu:default');
    public $objectType = 'dailymenu.dish';

    public function process(){
        $idDish = $this->getProperty('idDish');
        $oldIndex = $this->getProperty('oldIndex');
        $newIndex = $this->getProperty('newIndex');
        $date = $this->getProperty('date');

        if(empty($date)){
            $date = new DateTime();
            $date->setTime(0,0,0);
            $date = $date->format('Y-m-d H:i:s');
        }

        $dishes = $this->modx->newQuery($this->classKey);
        $dishes->where(array(
                "id:!=" => $idDish,
                "date" => $date,
                "position:>=" => min($oldIndex, $newIndex),
                "position:<=" => max($oldIndex, $newIndex),
            ));

        $dishes->sortby('position', 'ASC');

        $dishes->prepare();

        $dishesCollection = $this->modx->getCollection($this->classKey, $dishes);

        if(min($oldIndex, $newIndex) == $newIndex){
            foreach ($dishesCollection as $dish) {
                $dishObject = $this->modx->getObject($this->classKey, $dish->get('id'));
                $dishObject->set('position', $dishObject->get('position') + 1);
                $dishObject->save();
            }
        }else{
            foreach ($dishesCollection as $dish) {
                $dishObject = $this->modx->getObject($this->classKey, $dish->get('id'));
                $dishObject->set('position', $dishObject->get('position') - 1);
                $dishObject->save();
            }
        }

        $dishObject = $this->modx->getObject($this->classKey, $idDish);
        $dishObject->set('position', $newIndex);
        $dishObject->save();


        return $this->success('', $dishObject);
    }

}
return 'DailyMenuReorderDishUpdateProcessor';
