-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

--
-- Table `tl_form`
--

CREATE TABLE `tl_form` (
  `optin` char(1) NOT NULL default '',
  `optinEmailField` varchar(255) NOT NULL default '',
  `optinEmailSender` varchar(255) NOT NULL default '',
  `optinEmailReply` varchar(255) NOT NULL default '',
  `optinEmailSubject` varchar(255) NOT NULL default '',
  `optinEmailText` text NOT NULL,
  `optinEmailTemplate` varchar(255) NOT NULL default '',
  `optinTokenField` varchar(32) NOT NULL default '',
  `optinFeedbackField` varchar(32) NOT NULL default '',
  `optinJumpTo` int(10) NOT NULL default '0',
  `optinJumpToError` int(10) NOT NULL default '0',
  `optinCondition` char(1) NOT NULL default '',
  `optinConditionField` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;