<?php
/**
 * sublayout products
 *
 * @package	VirtueMart
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
 * @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
 */

defined('_JEXEC') or die('Restricted access');
$products_per_row = $viewData['products_per_row'];
$currency = $viewData['currency'];
$showRating = $viewData['showRating'];
$verticalseparator = " vertical-separator";
echo shopFunctionsF::renderVmSubLayout('askrecomjs');

$ItemidStr = '';
$Itemid = shopFunctionsF::getLastVisitedItemId();
if(!empty($Itemid)){
	$ItemidStr = '&Itemid='.$Itemid;
}

foreach ($viewData['products'] as $type => $products ) {

	$rowsHeight = shopFunctionsF::calculateProductRowsHeights($products,$currency,$products_per_row);

	if(!empty($type) and count($products)>0){
		$productTitle = vmText::_('COM_VIRTUEMART_'.strtoupper($type).'_PRODUCT'); ?>
<div class="<?php echo $type ?>-view">
  <h4><?php echo $productTitle ?></h4>
		<?php // Start the Output
    }

	// Calculating Products Per Row
	$cellwidth = ' width'.floor ( 100 / $products_per_row );

	$BrowseTotalProducts = count($products);

	$col = 1;
	$nb = 1;
	$row = 1;

	foreach ( $products as $product ) {

		// Show the horizontal seperator
		if ($col == 1 && $nb > $products_per_row) { ?>
	<!-- <div class="horizontal-separator"></div> -->
		<?php }

		// this is an indicator wether a row needs to be opened or not
		if ($col == 1) { ?>
	<div class="row windy-products-grid windy-products">
		<?php }

		// Show the vertical seperator
		if ($nb == $products_per_row or $nb % $products_per_row == 0) {
			$show_vertical_separator = ' ';
		} else {
			$show_vertical_separator = $verticalseparator;
		}

    // Show Products ?>
	<div class="product vm-col<?php echo ' vm-col-' . $products_per_row . $show_vertical_separator ?> windy-product">
		<div class="spacer">
			<div class="vm-product-media-container">
					<a class="windy-thumb" title="<?php echo $product->product_name ?>" href="<?php echo $product->link.$ItemidStr; ?>">
						<?php
						echo $product->images[0]->displayMediaThumb('class="browseProductImage"', false);
						?>
					</a>
					<!-- <a href="<?php echo $product->link.$ItemidStr; ?>" class="windy-add-to-cart">Add to cart</a> -->
					<div class="windy-add-to-link grid-view">	
						<?php plgSystemZtvirtuemarter::addQuickviewButton($product); ?>
						<?php plgSystemZtvirtuemarter::addCompareButton($product); ?>
						<?php plgSystemZtvirtuemarter::addWishlistButton($product); ?>
					</div>
			</div>

			<div class="vm-product-descr-container-<?php echo $rowsHeight[$row]['product_s_desc'] ?> windy-descr-container">
					<h2><?php echo JHtml::link ($product->link.$ItemidStr, $product->product_name); ?></h2>

					<?php if(!empty($rowsHeight[$row]['product_s_desc'])){ ?>
						<div class="product_s_desc">
							<?php // Product Short Description
							if (!empty($product->product_s_desc)) {
								echo shopFunctionsF::limitStringByWord ($product->product_s_desc, 400, ' ...') ?>
							<?php } ?>
						</div>
					<?php  } ?>
					<br />
					<div class="vm3pr-<?php echo $rowsHeight[$row]['price'] ?> list-view">
						<?php echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency)); ?>
						<!-- Raiting -->
						<?php echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$showRating, 'product'=>$product));
						if ( VmConfig::get ('display_stock', 1)) { ?>
							<span class="vmicon vm2-<?php echo $product->stock->stock_level ?>" title="<?php echo $product->stock->stock_tip ?>"></span>
						<?php } echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$product));?>
					</div>					
					<div class="windy-add-to-link list-view">	
						<ul>
							<li><?php echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product,'rowHeights'=>$rowsHeight[$row], 'position' => array('ontop', 'addtocart'))); ?></li>
							<li><?php plgSystemZtvirtuemarter::addQuickviewButton($product); ?></li>
							<li><?php plgSystemZtvirtuemarter::addCompareButton($product); ?></li>
							<li><?php plgSystemZtvirtuemarter::addWishlistButton($product); ?></li>
						</ul>			
					</div>
			</div>
			<div class="vm3pr-<?php echo $rowsHeight[$row]['price'] ?> grid-view">
				<?php echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency)); ?>
				<div class="clear"></div>
			</div>
			<div class="vm-product-rating-container grid-view">
				<?php echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$showRating, 'product'=>$product));
				if ( VmConfig::get ('display_stock', 1)) { ?>
					<span class="vmicon vm2-<?php echo $product->stock->stock_level ?>" title="<?php echo $product->stock->stock_tip ?>"></span>
				<?php } echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$product));?>

				<div class="vm3pr-<?php echo $rowsHeight[$row]['customfields'] ?>"> 
					<?php echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product,'rowHeights'=>$rowsHeight[$row], 'position' => array('ontop', 'addtocart'))); ?>
				</div> 	
			</div>
			
		</div>
		
	</div>

	<?php
    $nb ++;

      // Do we need to close the current row now?
      if ($col == $products_per_row || $nb>$BrowseTotalProducts) { ?>
    <div class="clear"></div>
  </div>
      <?php
      	$col = 1;
		$row++;
    } else {
      $col ++;
    }
  }

      if(!empty($type)and count($products)>0){
        // Do we need a final closing row tag?
        //if ($col != 1) {
      ?>
    <div class="clear"></div>
  </div>
    <?php
    // }
    }
  }
