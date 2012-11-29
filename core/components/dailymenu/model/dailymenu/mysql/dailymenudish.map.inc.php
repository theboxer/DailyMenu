<?php
/**
 * @package dailymenu
 */
$xpdo_meta_map['DailyMenuDish']= array (
  'package' => 'dailymenu',
  'version' => NULL,
  'table' => 'dailymenu_dish',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => '',
    'price' => '',
    'date' => NULL,
    'bold' => 0,
    'position' => NULL,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'price' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '32',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'date' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
    ),
    'bold' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
    ),
    'position' => 
    array (
      'dbtype' => 'int',
      'precision' => '3',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
);
