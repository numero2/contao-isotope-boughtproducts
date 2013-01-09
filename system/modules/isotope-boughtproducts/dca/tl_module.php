<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
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
 * @copyright  2012
 * @author     numero2 - Agentur für Internetdienstleistungen
 * @package    Isotope eCommerce
 * @license    LGPL
 * @filesource
 */


/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['iso_bought_products'] = '{title_legend},name,headline,type;{redirect_legend},iso_bought_products_jumpto;{template_legend},iso_bought_products_template,iso_bought_products_limit;{expert_legend:hide},guests,cssID,space';



/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['iso_bought_products_jumpto'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_module']['iso_bought_products_jumpto']
,	'exclude'		=> true
,	'inputType'		=> 'pageTree'
,	'explanation'	=> 'jumpTo'
,	'eval'			=> array( 'fieldType'=>'radio', 'tl_class'=>'clr' )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['iso_bought_products_template'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_module']['iso_bought_products_template']
,	'exclude'		=> true
,	'inputType'		=> 'select'
,	'options_callback'	=> array( 'tl_module_isotope_bought_products', 'getTemplates' )
,	'eval'			=> array( 'chosen'=>true, 'tl_class'=>'w50' )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['iso_bought_products_limit'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_module']['iso_bought_products_limit']
,	'exclude'		=> true
,	'inputType'		=> 'text'
,	'default'		=> 3
,	'eval'			=> array( 'tl_class'=>'w50' )
);


class tl_module_isotope_bought_products extends Backend {


	public function getTemplates( DataContainer $dc ) {

		$intPid = $dc->activeRecord->pid;

		if( $this->Input->get('act') == 'overrideAll' ){
			$intPid = $this->Input->get('id');
		}

		return IsotopeBackend::getTemplates('mod_iso_bought_products_', $intPid);
	}
}

?>