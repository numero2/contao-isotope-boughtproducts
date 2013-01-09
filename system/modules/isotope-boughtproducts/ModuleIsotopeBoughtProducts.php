<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
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


class ModuleIsotopeBoughtProducts extends Module {


	protected $strTemplate = 'mod_iso_bought_products_default';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate() {

		if( TL_MODE == 'BE' ) {

			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ISOTOPE BOUGHT PRODUCTS ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate module
	 */
	protected function compile() {

		global $objPage;

		$objProduct = NULL;
		$objProduct = IsotopeFrontend::getProductByAlias( $this->Input->get('product'), $objPage->id );

		if( !$objProduct->id )
			return '';

		$objProducts = NULL;
		$objProducts = $this->Database->prepare(" SELECT r.product_id FROM `tl_iso_order_items` AS i JOIN `tl_iso_order_items` r ON (r.pid = i.pid AND r.product_id != ?) WHERE i.product_id = ? GROUP BY r.product_id")->limit( $this->iso_bought_products_limit )->execute( $objProduct->id, $objProduct->id );

		$aProducts = array();

		while( $objProducts->next() ) {

			$product = IsotopeFrontend::getProduct( $objProducts->product_id, 0, true );
			$product->reader_jumpTo = IsotopeFrontend::getReaderPageId($this->iso_bought_products_jumpto);

			$aProducts[] = $product;
		}

		$this->Template->products = $aProducts;
	}
}

?>