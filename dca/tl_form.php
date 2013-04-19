<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Christopher Bölter 2013
 * @author     Christopher Bölter <http://www.cogizz.de>
 * @package    efgoptin
 * @license    LGPL
 * @filesource
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'optin';
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'optinCondition';

/**
 * Subalettes
 */
$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] =  str_replace('storeFormdata','storeFormdata,optin', $GLOBALS['TL_DCA']['tl_form']['palettes']['default']);

array_insert($GLOBALS['TL_DCA']['tl_form']['subpalettes'], count($GLOBALS['TL_DCA']['tl_form']['subpalettes']),
		array('optin' => 'optinEmailField,optinEmailSender,optinEmailReply,optinEmailSubject,optinEmailText,optinEmailTemplate,optinTokenField,optinFeedbackField,optinJumpTo,optinJumpToError,optinCondition',
					'optinCondition' => 'optinConditionField'
		)
);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form']['fields']['optin'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optin'],
		'exclude'                 => true,
		'filter'                  => true,
		'inputType'               => 'checkbox',
		'eval'										=> array('submitOnChange' => true)
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailField'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinEmailField'],
		'exclude'                 => true,
		'filter'                  => false,
		'inputType'               => 'select',
		'options_callback'				=> array('tl_form_efg_optin', 'getFormFields'),
		'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailSender'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinEmailSender'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailReply'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinEmailReply'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailSubject'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinEmailSubject'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'decodeEntities' => true)
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailText'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinEmailText'],
		'exclude'                 => true,
		'inputType'               => 'textarea',
		'eval'                    => array('mandatory'=>true, 'tl_class'=>'long', 'decodeEntities' => true)
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinEmailTemplate'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinEmailTemplate'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('helpwizard'=>false,'files'=>true, 'fieldType'=>'radio', 'extensions' => 'htm,html,xhtml,txt,tpl')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinTokenField'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinTokenField'],
		'exclude'                 => true,
		'filter'                  => false,
		'inputType'               => 'select',
		'options_callback'				=> array('tl_form_efg_optin', 'getFormFields'),
		'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinFeedbackField'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinFeedbackField'],
		'exclude'                 => true,
		'filter'                  => false,
		'inputType'               => 'select',
		'options_callback'				=> array('tl_form_efg_optin', 'getFormFields'),
		'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinJumpTo'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinJumpTo'],
		'exclude'                 => true,
		'inputType'               => 'pageTree',
		'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'clr')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinJumpToError'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinJumpToError'],
		'exclude'                 => true,
		'inputType'               => 'pageTree',
		'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'clr')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinCondition'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinCondition'],
		'exclude'                 => true,
		'filter'                  => true,
		'inputType'               => 'checkbox',
		'eval'										=> array('submitOnChange' => true)
);

$GLOBALS['TL_DCA']['tl_form']['fields']['optinConditionField'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinConditionField'],
		'exclude'                 => true,
		'filter'                  => false,
		'inputType'               => 'select',
		'options_callback'				=> array('tl_form_efg_optin', 'getOptinConditionField'),
		'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'tl_class'=>'w50')
);

/**
 * Class tl_form_efg_optin
 */
class tl_form_efg_optin extends Backend {

		/**
		 * load the form fields from the current form
		 * @param DataContainer $dc
		 * @return array
		 */
		public function getFormFields(DataContainer $dc) {
				$objFormField = $this->Database->prepare("SELECT name FROM tl_form_field Where pid = ?")->execute($dc->activeRecord->id);

				$arrFields = array();
				while($objFormField->next())
						$arrFields[$objFormField->name] = $objFormField->name;

				return $arrFields;
		}

		/**
		 * load the form checkbox fields from the current form
		 * @param DataContainer $dc
		 * @return array
		 */
		public function getOptinConditionField(DataContainer $dc) {
				$objFormField = $this->Database->prepare("SELECT name FROM tl_form_field Where pid = ? AND type = ?")->execute($dc->activeRecord->id, 'checkbox');

				$arrFields = array();
				while($objFormField->next())
						$arrFields[$objFormField->name] = $objFormField->name;

				return $arrFields;
		}
}

?>