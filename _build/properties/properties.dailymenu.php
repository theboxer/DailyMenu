<?php
/**
 * DailyMenu
 *
 * Copyright 2010 by Shaun McCormick <shaun+dailymenu@modx.com>
 *
 * DailyMenu is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * DailyMenu is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * DailyMenu; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package dailymenu
 */
/**
 * Properties for the DailyMenu snippet.
 *
 * @package dailymenu
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'prop_dailymenu.tpl_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'Item',
        'lexicon' => 'dailymenu:properties',
    ),
    array(
        'name' => 'sortBy',
        'desc' => 'prop_dailymenu.sortby_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'name',
        'lexicon' => 'dailymenu:properties',
    ),
    array(
        'name' => 'sortDir',
        'desc' => 'prop_dailymenu.sortdir_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'ASC',
        'lexicon' => 'dailymenu:properties',
    ),
    array(
        'name' => 'limit',
        'desc' => 'prop_dailymenu.limit_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 5,
        'lexicon' => 'dailymenu:properties',
    ),
    array(
        'name' => 'outputSeparator',
        'desc' => 'prop_dailymenu.outputseparator_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'dailymenu:properties',
    ),
    array(
        'name' => 'toPlaceholder',
        'desc' => 'prop_dailymenu.toplaceholder_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => true,
        'lexicon' => 'dailymenu:properties',
    ),
/*
    array(
        'name' => '',
        'desc' => 'prop_dailymenu.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'dailymenu:properties',
    ),
    */
);

return $properties;