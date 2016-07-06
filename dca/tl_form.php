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
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'optin';
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'optinCondition';

/**
 * Subalettes
 */
$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] =
    str_replace('storeFormdata', 'storeFormdata,optin', $GLOBALS['TL_DCA']['tl_form']['palettes']['default']);
array_insert(
    $GLOBALS['TL_DCA']['tl_form']['subpalettes'],
    count($GLOBALS['TL_DCA']['tl_form']['subpalettes']),
    array(
        'optin'          => 'optinEmailField,optinEmailSender,optinEmailReply,optinEmailSubject,optinEmailText,optinEmailHtml,optinEmailTemplate,optinTokenField,optinFeedbackField,optinFeedbackTimeField,optinSuccessMessage,optinJumpTo,optinErrorMessage,optinJumpToError,optinCondition',
        'optinCondition' => 'optinConditionField'
    )
);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form']['fields']['optin'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optin'],
    'exclude'   => true,
    'filter'    => true,
    'inputType' => 'checkbox',
    'eval'      => array('submitOnChange' => true),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailField'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_form']['optinEmailField'],
    'exclude'          => true,
    'filter'           => false,
    'inputType'        => 'select',
    'options_callback' => array('tl_form_efg_optin', 'getFormFields'),
    'eval'             => array('chosen' => true, 'mandatory' => true, 'tl_class' => 'w50'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailSender'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinEmailSender'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('mandatory' => true, 'tl_class' => 'w50'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailReply'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinEmailReply'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('mandatory' => true, 'tl_class' => 'w50'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailSubject'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinEmailSubject'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('mandatory' => true, 'tl_class' => 'w50', 'decodeEntities' => true),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailText'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinEmailText'],
    'exclude'   => true,
    'inputType' => 'textarea',
    'eval'      => array('mandatory' => true, 'tl_class' => 'long', 'decodeEntities' => true),
    'sql'       => "text NOT NULL"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailHtml'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinEmailHtml'],
    'exclude'   => true,
    'inputType' => 'textarea',
    'eval'      => array('tl_class' => 'long', 'allowHtml' => true, 'rte' => 'tinyMce'),
    'sql'       => "text NOT NULL"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailTemplate'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_form']['optinEmailTemplate'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => array('tl_form_efg_optin', 'getMailTemplates'),
    'eval'             => array(
        'includeBlankOption' => true
    ),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinTokenField'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_form']['optinTokenField'],
    'exclude'          => true,
    'filter'           => false,
    'inputType'        => 'select',
    'options_callback' => array('tl_form_efg_optin', 'getFormFields'),
    'eval'             => array('chosen' => true, 'mandatory' => true, 'tl_class' => 'w50'),
    'sql'              => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinFeedbackField'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_form']['optinFeedbackField'],
    'exclude'          => true,
    'filter'           => false,
    'inputType'        => 'select',
    'options_callback' => array('tl_form_efg_optin', 'getFormFields'),
    'eval'             => array('chosen' => true, 'mandatory' => true, 'tl_class' => 'w50'),
    'sql'              => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinFeedbackTimeField'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_form']['optinFeedbackTimeField'],
    'exclude'          => true,
    'filter'           => false,
    'inputType'        => 'select',
    'options_callback' => array('tl_form_efg_optin', 'getFormFields'),
    'eval'             => array('chosen' => true, 'mandatory' => true, 'tl_class' => 'w50'),
    'sql'              => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinJumpTo'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinJumpTo'],
    'exclude'   => true,
    'inputType' => 'pageTree',
    'eval'      => array('fieldType' => 'radio', 'tl_class' => 'clr'),
    'sql'       => "int(10) NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinSuccessMessage'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinSuccessMessage'],
    'exclude'   => true,
    'inputType' => 'textarea',
    'eval'      => array('tl_class' => 'clr long'),
    'sql'       => "text NOT NULL"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinJumpToError'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinJumpToError'],
    'exclude'   => true,
    'inputType' => 'pageTree',
    'eval'      => array('fieldType' => 'radio', 'tl_class' => 'clr'),
    'sql'       => "int(10) NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinErrorMessage'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinErrorMessage'],
    'exclude'   => true,
    'inputType' => 'textarea',
    'eval'      => array('tl_class' => 'long'),
    'sql'       => "text NOT NULL"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinCondition'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['optinCondition'],
    'exclude'   => true,
    'filter'    => true,
    'inputType' => 'checkbox',
    'eval'      => array('submitOnChange' => true),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinConditionField'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_form']['optinConditionField'],
    'exclude'          => true,
    'filter'           => false,
    'inputType'        => 'select',
    'options_callback' => array('tl_form_efg_optin', 'getOptinConditionField'),
    'eval'             => array('chosen' => true, 'mandatory' => true, 'tl_class' => 'w50'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

/**
 * Class tl_form_efg_optin
 */
class tl_form_efg_optin extends \Backend
{

    /**
     * load the form fields from the current form
     *
     * @param DataContainer $dc
     *
     * @return array
     */
    public function getFormFields(\DataContainer $dc)
    {
        $database  = \Database::getInstance();
        $formField =
            $database->prepare("SELECT name FROM tl_form_field Where pid = ?")->execute($dc->activeRecord->id);

        $fields = array();
        while ($formField->next()) {
            $fields[$formField->name] = $formField->name;
        }

        return $fields;
    }

    /**
     * load the form checkbox fields from the current form
     *
     * @param DataContainer $dc
     *
     * @return array
     */
    public function getOptinConditionField(DataContainer $dc)
    {
        $database  = \Database::getInstance();
        $formField = $database->prepare("SELECT name FROM tl_form_field Where pid = ? AND type = ?")->execute(
            $dc->activeRecord->id,
            'checkbox'
        );

        $fields = array();
        while ($formField->next()) {
            $fields[$formField->name] = $formField->name;
        }

        return $fields;
    }

    /**
     * Return all mail templates as array
     *
     * @return array
     */
    public function getMailTemplates()
    {
        return $this->getTemplateGroup('mail_');
    }
}
