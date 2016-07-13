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

class ModuleEfgOptIn extends \Module
{

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'mod_efg_optin';

    /**
     * Display a wildcard in the back end
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['efgoptin'][0]) . ' ###';
            $objTemplate->title    = $this->headline;
            $objTemplate->id       = $this->id;
            $objTemplate->link     = $this->name;
            $objTemplate->href     = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }


    /**
     * Generate the module
     */
    protected function compile()
    {
        $form  = \Input::get('form');
        $token = \Input::get('token');

        if (isset($form) && strlen($token) == '32') {
            $database = \Database::getInstance();
            $form     = $database->prepare(
                "SELECT optin, optinSuccessNotification, optinSuccessMessage, optinJumpTo, optinErrorMessage, optinJumpToError, optinTokenField, optinFeedbackField, optinFeedbackTimeField, title  FROM tl_form Where id = ?"
            )->execute((int) $form);

            if ($form->numRows == 0) {
                $this->generateOptInError($form);
                return;
            }

            if ($form->optin) {
                $formData = $database->prepare(
                    "SELECT tfds.id, tfds.pid FROM tl_formdata tfd LEFT JOIN tl_formdata_details tfds ON tfd.id = tfds.pid Where tfd.form = ? AND tfds.ff_name = ? AND tfds.value = ?"
                )->execute($form->title, $form->optinTokenField, $token);

                if ($formData->numRows > 0) {

                    $optInFieldValue =
                        $database->prepare(
                            "SELECT tfd.value FROM tl_formdata_details tfd Where tfd.pid = ? AND tfd.ff_name = ?"
                        )
                            ->execute($formData->pid, $form->optinFeedbackField)->value;

                    if ($optInFieldValue) {
                        $this->generateOptInError($form);
                        return;
                    }

                    $feedback = array(
                        'tstamp' => time(),
                        'value'  => '1'
                    );

                    $this->setFormDataDetails($formData->pid, $form->optinFeedbackField, $feedback);

                    $feedbackTime = array(
                        'tstamp' => time(),
                        'value'  => time()
                    );

                    $this->setFormDataDetails($formData->pid, $form->optinFeedbackTimeField, $feedbackTime);

                    $objNotification =
                        \NotificationCenter\Model\Notification::findByPk($form->optinSuccessNotification);
                    if (null !== $objNotification) {
                        $tokens         = array('domain' => \Environment::get('host'));
                        $formDataValues = $database->prepare(
                            "SELECT tfds.ff_name, tfds.value FROM tl_formdata_details tfds Where tfds.pid = ?"
                        )->execute($formData->pid)->fetchAllAssoc();

                        $preparedTokens = $this->prepareTokens($formDataValues, $form->optinFeedbackTimeField);

                        StringUtil::flatten($preparedTokens, 'form', $tokens);
                        $objNotification->send($tokens);
                    }

                    if ($form->optinSuccessMessage) {
                        $this->Template->messageClass = 'success';
                        $this->Template->message      = $form->optinSuccessMessage;
                        return;
                    } else {
                        $this->redirectToFrontendPage($form->optinJumpTo);
                    }

                } else {
                    $this->generateOptInError($form);
                    return;
                }
            } else {
                $this->generateOptInError($form);
                return;
            }
        }
    }

    /**
     * Update the form data details inside the tl_formdata_details
     *
     * @param $pid
     * @param $formDataFieldName
     * @param $values
     */
    private function setFormDataDetails($pid, $formDataFieldName, $values)
    {
        $database = \Database::getInstance();
        $database->prepare("UPDATE tl_formdata_details %s Where pid = ? AND ff_name = ?")->set(
            $values
        )->execute($pid, $formDataFieldName);
    }

    /**
     * Generate the optInError
     *
     * @param $form
     */
    private function generateOptInError($form)
    {
        if ($form->optinErrorMessage) {
            $this->Template->messageClass = 'error';
            $this->Template->message      = $form->optinErrorMessage;
            return;
        } else {
            $this->redirectToFrontendPage($form->optinJumpToError);
        }
    }

    /**
     * Prepare the simple tokens for the notification center
     *
     * @param $formDataValues
     * @param $feedbackTimeField
     *
     * @return array
     */
    private function prepareTokens($formDataValues, $feedbackTimeField)
    {
        $tokens = array();
        foreach ($formDataValues as $value) {

            if (!$value['ff_name'] || !$value['value']) {
                continue;
            }

            if (\Validator::isNumeric($value['value']) && $value['ff_name'] == $feedbackTimeField) {
                $tokens[$value['ff_name']] = \Date::parse($GLOBALS['objPage']->datimFormat, $value['value']);
            } else {
                $tokens[$value['ff_name']] = $value['value'];
            }
        }

        return $tokens;
    }
}
