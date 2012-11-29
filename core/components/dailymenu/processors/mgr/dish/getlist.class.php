<?php
/**
 * Get list Items
 *
 * @package dailymenu
 * @subpackage processors
 */
class DailyMenuDishGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'DailyMenuDish';
    public $languageTopics = array('dailymenu:default');
    public $defaultSortField = 'position';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'dailymenu.dish';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $date = $this->getProperty('filterDay');
        if (empty($date)) {
            $date = new DateTime();
            $date->setTime(0,0,0);
            $date = $date->format('Y-m-d H:i:s');
        }

        $c->where(array(
                'date' => $date
            ));

        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                    'name:LIKE' => '%'.$query.'%'
                ));
        }
        return $c;
    }
}
return 'DailyMenuDishGetListProcessor';