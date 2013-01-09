-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `iso_bought_products_jumpto` int(10) unsigned NOT NULL default '0',
  `iso_bought_products_template` varchar(255) NOT NULL default ''
  `iso_bought_products_limit` int(2) unsigned NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
