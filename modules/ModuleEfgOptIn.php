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
                "SELECT optin, optinJumpTo, optinJumpToError, optinTokenField, optinFeedbackField, optinFeedbackTimeField, title  FROM tl_form Where id = ?"
            )->execute((int) $form);

            if ($form->numRows == 0) {
                $this->redirectToFrontendPage($form->optinJumpToError);
            }

            if ($form->optin) {
                $formData = $database->prepare(
                    "SELECT tfds.id, tfds.pid FROM tl_formdata tfd LEFT JOIN tl_formdata_details tfds ON tfd.id = tfds.pid Where tfd.form = ? AND tfds.ff_name = ? AND tfds.value = ?"
                )->execute($form->title, $form->optinTokenField, $token);

                if ($formData->numRows > 0) {

                    $optInFieldValue =
                        $database->prepare("SELECT value FROM tl_formdata_details Where pid = ? AND ff_name = ?")
                            ->execute($formData->pid, $form->optinFeedbackField)->value;

                    if ($optInFieldValue) {
                        $this->redirectToFrontendPage($form->optinJumpToError);
                    }

                    $feedback = array(
                        'tstamp' => time(),
                        'value'  => '1'
                    );

                    $database->prepare("UPDATE tl_formdata_details %s Where pid = ? AND ff_name = ?")->set(
                        $feedback
                    )->execute($formData->pid, $form->optinFeedbackField);

                    $feedbackTime = array(
                        'tstamp' => time(),
                        'value'  => time()
                    );

                    $database->prepare("UPDATE tl_formdata_details %s Where pid = ? AND ff_name = ?")->set(
                        $feedbackTime
                    )->execute($formData->pid, $form->optinFeedbackTimeField);

                    $this->redirectToFrontendPage($form->optinJumpTo);
                } else {
                    $this->redirectToFrontendPage($form->optinJumpToError);
                }
            } else {
                $this->redirectToFrontendPage($form->optinJumpToError);
            }
        }
    }
}
