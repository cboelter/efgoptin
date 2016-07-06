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

$GLOBALS['TL_LANG']['tl_form']['optin']                  =
    array('Double Opt-In', 'Double Opt-In für gespeicherte Formulardaten aktivieren.');
$GLOBALS['TL_LANG']['tl_form']['optinEmailField']        = array('Empfänger', '');
$GLOBALS['TL_LANG']['tl_form']['optinEmailSender']       = array('Absender', '');
$GLOBALS['TL_LANG']['tl_form']['optinEmailReply']        = array('Antwort-Adresse', '');
$GLOBALS['TL_LANG']['tl_form']['optinEmailSubject']      = array('Betreff', '');
$GLOBALS['TL_LANG']['tl_form']['optinEmailText']         = array('Text-Inhalt', '');
$GLOBALS['TL_LANG']['tl_form']['optinEmailText']         = array('HTML-Inhalt', '');
$GLOBALS['TL_LANG']['tl_form']['optinEmailTemplate']     = array('Mail-Template HTML', '');
$GLOBALS['TL_LANG']['tl_form']['optinTokenField']        =
    array('Token-Feld', 'Hiddenfield in dem der Token für das Double Opt-In gespeichert wird');
$GLOBALS['TL_LANG']['tl_form']['optinFeedbackField']     =
    array('Feedback-Feld', 'Hiddenfield in dem das Feedback für das Double Opt-In gespeichert wird');
$GLOBALS['TL_LANG']['tl_form']['optinFeedbackTimeField'] = array(
    'Zeitstempel Opt-In',
    'Hiddenfield in dem die Uhrzeit und das Datum des Feedback für das Double Opt-In gespeichert wird'
);
$GLOBALS['TL_LANG']['tl_form']['optinSuccessMessage']    =
    array('Erfolgsmeldung Opt-In');
$GLOBALS['TL_LANG']['tl_form']['optinJumpTo']            =
    array('Weiterleitung Erfolgsseite', 'Zielseite für erfolgreichen Double Opt-In');
$GLOBALS['TL_LANG']['tl_form']['optinErrorMessage']      =
    array('Fehlermeldung Opt-In');
$GLOBALS['TL_LANG']['tl_form']['optinJumpToError']       =
    array('Weiterleitung Fehlerseite', 'Zielseite für fehlgeschlagenen Double Opt-In');
$GLOBALS['TL_LANG']['tl_form']['optinCondition']         =
    array('Bedingung', 'Den Opt-In nur nutzen, wenn eine bestimmte Checkbox gewählt ist.');
$GLOBALS['TL_LANG']['tl_form']['optinConditionField']    = array(
    'Double Opt-In Bedingungsfeld',
    'Das Feld an das das Double-Opt-In gebunden ist. (funktioniert nur mit checkboxen)'
);
