<?php
/**
 *
 * Show the product prices
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_showprices.php 8024 2014-06-12 15:08:59Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
$product = $viewData['product'];
$currency = $viewData['currency'];
?>
<style type="text/css" media="screen">
	ul.detail-price-list{
		
	}
	ul.detail-price-list li{
		display: inline-block;
		font-family: "Poppins";
		line-height: 55px;
	}
	li.salesPriceWithDiscount{
		color : #252525;
		font-weight: 700;
		font-size: 22px;
		margin-right: 20px;
	}
	li.basePriceWithTax{
		text-decoration: line-through;
		font-size: 18px;
		color : #cccccc;
		font-weight: 500;
	}
</style>

<ul class="detail-price-list">
	<li class="salesPriceWithDiscount"><?php echo $currency->createPriceDiv ('salesPriceWithDiscount', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITH_DISCOUNT', $product->prices); ?></li>
	<li class="basePriceWithTax"><?php echo $currency->createPriceDiv ('basePriceWithTax', 'COM_VIRTUEMART_PRODUCT_BASEPRICE_WITHTAX', $product->prices) ?></li>&nbsp;&nbsp;&nbsp; 
</ul>