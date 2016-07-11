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
$GLOBALS['TL_HOOKS']['processEfgFormData'][] = array('Cboelter\\EfgOptIn\\EfgOptIn', 'checkOptInMail');

/**
 * Cronjobs
 */
$GLOBALS['TL_CRON']['hourly'][] = array('Cboelter\\EfgOptIn\\EfgOptIn', 'cleanExpiredOptIn');

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

/**
 * Notifications
 */
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'] = array_merge_recursive(
    (array) $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'],
    array(
        'efgoptin' => array(
            'efgoptin_optin'   => array(
                'recipients'    => array('form_*'),
                'email_subject' => array('form_*', 'domain'),
                'email_text'    => array('form_*', 'optin_url', 'domain'),
                'email_html'    => array('form_*', 'optin_url', 'domain'),
            ),
            'efgoptin_success' => array(
                'recipients'    => array('form_*'),
                'email_subject' => array('form_*', 'domain'),
                'email_text'    => array('form_*', 'domain'),
                'email_html'    => array('form_*', 'domain'),
            )
        )
    )
);

/**
 * Storage time
 */
$GLOBALS['TL_CONFIG']['efgoptin_storage'] = 24;