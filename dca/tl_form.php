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

/**
 * Subalettes
 */
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['sendConfirmationMail'] =  str_replace('addConfirmationMailAttachments','addConfirmationMailAttachments,optin', $GLOBALS['TL_DCA']['tl_form']['subpalettes']['sendConfirmationMail']);

array_insert($GLOBALS['TL_DCA']['tl_form']['subpalettes'], count($GLOBALS['TL_DCA']['tl_form']['subpalettes']),
		array('optin' => 'optinLinkField,optinTokenField,optinFeedbackField,optinJumpTo')
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

$GLOBALS['TL_DCA']['tl_form']['fields']['optinLinkField'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['optinLinkField'],
		'exclude'                 => true,
		'filter'                  => false,
		'inputType'               => 'select',
		'options_callback'				=> array('tl_form_efg_optin', 'getFormFields'),
		'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'tl_class'=>'w50')
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
}

?>