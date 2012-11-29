<?php
/**
 * @package dailymenu
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/dailymenudish.class.php');
class DailyMenuDish_mysql extends DailyMenuDish {}
?>