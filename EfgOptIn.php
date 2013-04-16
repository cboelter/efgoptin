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
 * Class EfgOptIn
 */
class EfgOptIn extends Frontend {

		/**
		 * add the optin link to the submitted values
		 * @param $arrSubmitted
		 * @param $arrFiles
		 * @param $intOldId
		 * @param $arrForm
		 * @return mixed
		 */
		public function addOptInLink($arrSubmitted, $arrFiles, $intOldId, &$arrForm) {

				if($arrForm['optin'] && $arrForm['optinTokenField'] != '') {
						global $objPage;

						$strRequest = ampersand($this->Environment->base . $this->generateFrontendUrl($objPage->row()));
						$strToken = md5(microtime() * rand(0,999));
						$paramString = 'form=' . $arrForm['id'] . '&token=' . $strToken;

						$arrSubmitted[$arrForm['optinLinkField']] = $strRequest . (strpos('?', $strRequest) ? $paramString . '&' : '?' . $paramString);
						$arrSubmitted[$arrForm['optinTokenField']] = $strToken;
						$arrSubmitted[$arrForm['optinFeedbackField']] = '0';
				}

				return $arrSubmitted;
		}
}