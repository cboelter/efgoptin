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

use Haste\Util\StringUtil;

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
    public function checkOptInMail($arrSubmitted, $arrFiles, $intOldId, &$arrForm)
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
            list($url, $token) = $this->generateOptInUrl($form['id']);

            $objNotification = \NotificationCenter\Model\Notification::findByPk($form['optinNotification']);
            if (null !== $objNotification) {
                $tokens = array('optin_url' => $url, 'domain' => \Environment::get('host'));
                StringUtil::flatten($data, 'form', $tokens);
                $objNotification->send($tokens);
            }

            $arrSubmitted[$form['optinTokenField']]        = $token;
            $arrSubmitted[$form['optinFeedbackField']]     = '';
            $arrSubmitted[$form['optinFeedbackTimeField']] = '';
        }

        return $arrSubmitted;
    }

    private function generateOptInUrl($formId)
    {
        $url       = \Environment::get('base') . \Controller::generateFrontendUrl($GLOBALS['objPage']->row());
        $token     = md5(microtime() * rand(0, 999));
        $parameter = '?form=' . $formId . '&token=' . $token;

        return array($url . $parameter, $token);
    }

    public function cleanExpiredOptIn()
    {
        if ($GLOBALS['TL_CONFIG']['efgoptin_storage'] == 0) {
            return;
        }

        $database     = \Database::getInstance();
        $expiredOptIn = $database->prepare(
            "SELECT tfd.id, tfd.form, tf.optinFeedbackField as feedbackField FROM tl_formdata tfd LEFT JOIN tl_form tf ON tf.title = tfd.form LEFT JOIN tl_formdata_details tfdd ON tfdd.pid = tfd.id Where tf.optin = '1' AND tfdd.ff_name = tf.optinFeedbackField AND tfdd.value = '' AND tfd.date < ?"
        )->execute(strtotime(date('Y-m-d H:i:s') . ' -' . $GLOBALS['TL_CONFIG']['efgoptin_storage'] . ' hours'));

        $expiredCount = $expiredOptIn->count();

        while ($expiredOptIn->next()) {
            $database->prepare("DELETE FROM tl_formdata_details Where pid = ?")->execute($expiredOptIn->id);
            $database->prepare("DELETE FROM tl_formdata Where id = ?")->execute($expiredOptIn->id);
        }

        \System::log('Deleted ' . $expiredCount . ' opt-in entries successfully', 'EfgOptIn::cleanExpiredOptIn', 'CRON');
    }
}
