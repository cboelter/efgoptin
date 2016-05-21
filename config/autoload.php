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
 * Register the namespaces
 */
ClassLoader::addNamespaces(
    array
    (
        'Cboelter',
    )
);


/**
 * Register the classes
 */
ClassLoader::addClasses(
    array
    (
        // Classes
        'Cboelter\\EfgOptIn\\EfgOptIn'       => 'system/modules/efgoptin/classes/EfgOptIn.php',
        // Modules
        'Cboelter\\EfgOptIn\\ModuleEfgOptIn' => 'system/modules/efgoptin/modules/ModuleEfgOptIn.php',
    )
);


/**
 * Register the templates
 */
TemplateLoader::addFiles(
    array
    (
        'mod_efg_optin' => 'system/modules/efgoptin/templates',
    )
);
