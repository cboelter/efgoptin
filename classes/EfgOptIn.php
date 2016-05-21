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

namespace Cboelter\EfgOptIn;

/**
 * Class EfgOptIn
 */
class EfgOptIn
{

    /**
     * add the optin link to the submitted values
     *
     * @param $arrSubmitted
     * @param $files
     * @param $oldId
     * @param $form
     *
     * @return mixed
     */
    public function addOptInLink($arrSubmitted, $arrFiles, $intOldId, &$arrForm)
    {
        if ($arrForm['optin'] && $arrForm['optinTokenField'] != '' && $arrForm['storeFormdata']) {
            if ($arrForm['optinCondition']
                && ($arrSubmitted[$arrForm['optinConditionField']] == '0'
                    || $arrSubmitted[$arrForm['optinConditionField']] == '')
            ) {
                return $arrSubmitted;
            }

            $arrSubmitted = $this->sendOptInEmail($arrSubmitted, $arrForm);

        }

        return $arrSubmitted;
    }

    /**
     * @param $arrSubmitted
     * @param $form
     *
     * @return mixed
     */
    private function sendOptInEmail($arrSubmitted, $form)
    {
        $data = $arrSubmitted;
        unset($data['FORM_SUBMIT'], $data['MAX_FILE_SIZE']);

        if ($data[$form['optinEmailField']]) {

            $email  = new \Email();
            $strUrl = \Environment::get('base') . \Controller::generateFrontendUrl($GLOBALS['objPage']->row());

            $token       = md5(microtime() * rand(0, 999));
            $paramString = '?form=' . $form['id'] . '&token=' . $token;

            $data['optinurl'] = $strUrl . $paramString;
            $text             = \StringUtil::parseSimpleTokens($form['optinEmailText'], $data);
            $subject          = \StringUtil::parseSimpleTokens($form['optinEmailSubject'], $data);

            $mailTemplate = $form['optinEmailTemplate'];
            if ($mailTemplate != '') {
                $fileTemplate = new \File($mailTemplate);

                if ($fileTemplate->mime == 'text/html') {
                    $html = $fileTemplate->getContent();

                    $html        = \StringUtil::parseSimpleTokens($html, $data);
                    $email->html = $html;
                }
            }

            $email->subject = $subject;
            $email->text    = $text;
            $email->sendTo($arrSubmitted[$form['optinEmailField']]);

            $arrSubmitted[$form['optinTokenField']]    = $token;
            $arrSubmitted[$form['optinFeedbackField']] = '';
            $arrSubmitted[$form['optinFeedbackTimeField']]  = '';
        }

        return $arrSubmitted;
    }
}
