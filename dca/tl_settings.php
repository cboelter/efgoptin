<?php

/**
 * Contao Open Source CMS, Copyright (C) 2005-2016 Leo Feyer
 *
 * EfgOptin
 *
 * @copyright  Christopher Bölter 2016
 * @author     Christopher Bölter
 * @package    EfgOptin
 * @license    LGPL
 * @filesource
 * @see        https://github.com/cboelter/efgoptin
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{efgoptin_legend},efgoptin_storage';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['efgoptin_storage'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['efgoptin_storage'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('tl_class' => 'w50')
);
