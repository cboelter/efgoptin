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
class ModuleEfgOptIn extends Module
{

		/**
		 * Template
		 * @var string
		 */
		protected $strTemplate = 'mod_efg_optin';

		/**
		 * Display a wildcard in the back end
		 * @return string
		 */
		public function generate()
		{
				if (TL_MODE == 'BE')
				{
						$objTemplate = new BackendTemplate('be_wildcard');

						$objTemplate->wildcard = '### EFG: OPT-IN Reader ###';
						$objTemplate->title = $this->headline;
						$objTemplate->id = $this->id;
						$objTemplate->link = $this->name;
						$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

						return $objTemplate->parse();
				}

				return parent::generate();
		}


		/**
		 * Generate the module
		 */
		protected function compile()
		{
				$intForm = $this->Input->get('form');
				$strToken = $this->Input->get('token');

				if(isset($intForm) && strlen($strToken) == '32') {
						$objForm = $this->Database->prepare("SELECT * FROM tl_form Where id = ?")->execute($intForm);

						if($objForm->optin) {
								$objFormData = $this->Database->prepare("SELECT tfds.id, tfds.pid FROM tl_formdata tfd LEFT JOIN tl_formdata_details tfds ON tfd.id = tfds.pid Where tfd.form = ? AND tfds.ff_name = ? AND tfds.value = ?")->execute($objForm->title, $objForm->optinTokenField, $strToken);

								if($objFormData->numRows > 0) {
										$arrSet = array(
												'tstamp' => time(),
												'value' => '1'
										);

										$this->Database->prepare("UPDATE tl_formdata_details %s Where pid = ? AND ff_name = ?")->set($arrSet)->execute($objFormData->pid, $objForm->optinFeedbackField);

										$this->redirectToFrontendPage($objForm->optinJumpTo);
								} else {
										$this->redirectToFrontendPage($objForm->optinJumpToError);
								}
						}
				}

		}
}
?>