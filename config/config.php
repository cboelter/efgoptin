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
 * Hooks
 */
$GLOBALS['TL_HOOKS']['processEfgFormData'][] = array('Cboelter\\EfgOptIn\\EfgOptIn', 'addOptInLink');

/**
 * Frontend Modules
 */
array_insert(
    $GLOBALS['FE_MOD']['application'],
    count($GLOBALS['FE_MOD']['application']),
    array
    (
        'efgoptin' => 'Cboelter\\EfgOptIn\\ModuleEfgOptIn'
    )
);
