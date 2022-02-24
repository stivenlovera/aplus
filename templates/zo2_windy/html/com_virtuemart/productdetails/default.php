<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz, Max Galt
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9185 2016-02-25 13:51:01Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

/* Let's see if we found the product */
if (empty($this->product)) {
	echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));



if(vRequest::getInt('print',false)){ ?>
<body onload="javascript:print();">
<?php } ?>
<script type="text/javascript">
	jQuery('#zo2-position-25').parent().hide();
	jQuery('#zo2-component').parent().removeClass('col-md-9 col-sm-9').addClass('col-md-12 col-sm-12');
</script>

<div class="row" id="windy-product-detail">
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 windy-product-detail-gallery">
		<?php
			echo $this->loadTemplate('images');
			?>
			<?php
				$count_images = count ($this->product->images);
				if ($count_images > 1) {
					echo $this->loadTemplate('images_additional');
					
				}

				// event onContentBeforeDisplay
				echo $this->product->event->beforeDisplayContent; 


                $sale = $this->product->prices['product_override_price'];
                $saleClass = '';
                if ($sale > 0) {
                    $saleClass = 'product-sale';
                }
           

                ?>
	</div>
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 windy-product-detail-info">
		<div class="row infor">
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 detail-product-title">
				<?php // Product Title   ?>
					<h1 itemprop="name"><?php echo $this->product->product_name ?></h1>
				<?php // Product Title END   ?>		
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 detail-product-direct">
				<div class="windy-prodcut-detai-nav">
					<?php  if (VmConfig::get('product_navigation', 1)) : // Product Navigation ?>
				        <div class="product-neighbours">
						    <?php if (!empty($this->product->neighbours ['previous'][0])) : ?>									
							<a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE); ?>" class="#"><i class="fa fa-angle-left"></i></a>
						    <?php endif; ?>
						    <?php if (!empty($this->product->neighbours ['next'][0])) : ?>
								<a class="#" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE); ?>" title="#"><i class="fa fa-angle-right"></i></a>
					    	<?php endif; ?>
				        </div>
					<?php endif; // Product Navigation END ?>
				</div>
			</div>
	    	<div class="clear"></div>

			<div class="raiting">					
				<?php echo shopFunctionsF::renderVmSubLayout('raiting-prodcut-detail',array('showRating'=>$this->showRating,'product'=>$this->product)); ?>
			</div>
		</div>
		<div class="row price">					
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 list-price">
				<?php echo shopFunctionsF::renderVmSubLayout('prices-detail',array('product'=>$this->product,'currency'=>$this->currency)); ?>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<p><b>Availability </b>: <a href="#">In stock</a></p>
			</div>
		</div>

		<div class="description-detail">
			<?php if(isset($this->product->product_s_desc)): ?>
				<?php echo nl2br($this->product->product_s_desc); ?>
			<?php else: ?>
				<p>Description empty</p>
			<?php endif; ?>

		</div>

		<div class="windy-addtocart clearfix">					
			<?php echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product)); ?>
		</div>

		<div class="detail-bottons">
			<ul>
				<li><?php plgSystemZtvirtuemarter::addWishlistButton($product); ?></li>
				<li><?php plgSystemZtvirtuemarter::addCompareButton($product); ?></li>
				<li><div class="share"><a href="#"><i class="fa fa-share-alt"></i><span>Share</span></a></div></li>
			</ul>

			<br>
			<div class="cat-detail">
				<p>
					<b>Cateogories :</b> <?php 
						if (VmConfig::get('showCategory', 1)) {
							echo $this->loadTemplate('showcategory');
						}
					 ?>
				</p>
				<p><b>Tags :</b> </p>
			</div>
		</div>
	</div>
</div>

<div class="container-desc">
	<div id="zt_tabs" class="tabs">
        <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li class="active"><a href="#tab1" role="tab" data-toggle="tab"><?php echo 'DESCRIPTION' ;?></a></li>
            <li class=""><a href="#tab2" role="tab" data-toggle="tab"><?php echo 'Reviews'; ?></a></li>
        </ul>        
	    <div class="tab-content">
	        <div class="tab-pane active " id="tab1">  
	           	<?php
					// Product Description
					if (!empty($this->product->product_desc)) {
					    ?>
				        <div class="product-description">
					<?php /** @todo Test if content plugins modify the product description */ ?>
				    	<span class="title"><?php //echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></span>
					<?php echo $this->product->product_desc; ?>
				        </div>
					<?php
			    } ?>
	        </div>
	         <div class="tab-pane " id="tab2">
	         	<?php echo $this->loadTemplate('reviews');?>
	        </div>
	    </div>         
	</div><!--/zt_tabs-->
</div>

<div class="row related_products">
	<h2 class="title-related_products">Related Products</h2>
	<?php echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products-windy','customTitle' => true )); ?>
</div>













<div class="productdetails-view productdetails" style="display: none;" >

    <?php
    // Product Navigation
    if (VmConfig::get('product_navigation', 1)) {
	?>
        <div class="product-neighbours">
	    <?php
	    if (!empty($this->product->neighbours ['previous'][0])) {
		$prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
		echo JHtml::_('link', $prev_link, $this->product->neighbours ['previous'][0]
			['product_name'], array('rel'=>'prev', 'class' => 'previous-page','data-dynamic-update' => '1'));
	    }
	    if (!empty($this->product->neighbours ['next'][0])) {
		$next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
		echo JHtml::_('link', $next_link, $this->product->neighbours ['next'][0] ['product_name'], array('rel'=>'next','class' => 'next-page','data-dynamic-update' => '1'));
	    }
	    ?>
    	<div class="clear"></div>
        </div>
    <?php } // Product Navigation END
    ?>

	<?php // Back To Category Button
	if ($this->product->virtuemart_category_id) {
		$catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE);
		$categoryName = vmText::_($this->product->category_name) ;
	} else {
		$catURL =  JRoute::_('index.php?option=com_virtuemart');
		$categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
	}
	?>
	<div class="back-to-category">
    	<a href="<?php echo $catURL ?>" class="product-details" title="<?php echo $categoryName ?>"><?php echo vmText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO',$categoryName) ?></a>
	</div>

    <?php // Product Title   ?>
    <h1 itemprop="name"><?php echo $this->product->product_name ?></h1>
    <?php // Product Title END   ?>

    <?php // afterDisplayTitle Event
    echo $this->product->event->afterDisplayTitle ?>

    <?php
    // Product Edit Link
    echo $this->edit_link;
    // Product Edit Link END
    ?>

    <?php
    // PDF - Print - Email Icon
    if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_icon')) {
	?>
        <div class="icons">
	    <?php

	    $link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;

		echo $this->linkIcon($link . '&format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_icon', false);
	    //echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');
		echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon',false,true,false,'class="printModal"');
		$MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';
	    echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend', false,true,false,'class="recommened-to-friend"');
	    ?>
    	<div class="clear"></div>
        </div>
    <?php } // PDF - Print - Email Icon END
    ?>

    <?php
    // Product Short Description
    if (!empty($this->product->product_s_desc)) {
	?>
        <div class="product-short-description">
	    <?php
	    /** @todo Test if content plugins modify the product description */
	    echo nl2br($this->product->product_s_desc);
	    ?>
        </div>
	<?php
    } // Product Short Description END

	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'ontop'));
    ?>

    <div class="vm-product-container">
	<div class="vm-product-media-container">
<?php
echo $this->loadTemplate('images');
?>
	</div>

	<div class="vm-product-details-container">
	    <div class="spacer-buy-area">

		<?php
		// TODO in Multi-Vendor not needed at the moment and just would lead to confusion
		/* $link = JRoute::_('index2.php?option=com_virtuemart&view=virtuemart&task=vendorinfo&virtuemart_vendor_id='.$this->product->virtuemart_vendor_id);
		  $text = vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL');
		  echo '<span class="bold">'. vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_VENDOR_LBL'). '</span>'; ?><a class="modal" href="<?php echo $link ?>"><?php echo $text ?></a><br />
		 */
		?>

		<?php
		echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$this->showRating,'product'=>$this->product));

		if (is_array($this->productDisplayShipments)) {
		    foreach ($this->productDisplayShipments as $productDisplayShipment) {
			echo $productDisplayShipment . '<br />';
		    }
		}
		if (is_array($this->productDisplayPayments)) {
		    foreach ($this->productDisplayPayments as $productDisplayPayment) {
			echo $productDisplayPayment . '<br />';
		    }
		}

		//In case you are not happy using everywhere the same price display fromat, just create your own layout
		//in override /html/fields and use as first parameter the name of your file
		echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$this->product,'currency'=>$this->currency));
		?> <div class="clear"></div><?php
		echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product));

		echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$this->product));

		// Ask a question about this product
		if (VmConfig::get('ask_question', 0) == 1) {
			$askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component', FALSE);
			?>
			<div class="ask-a-question">
				<a class="ask-a-question" href="<?php echo $askquestion_url ?>" rel="nofollow" ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?></a>
			</div>
		<?php
		}
		?>

		<?php
		// Manufacturer of the Product
		if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) {
		    echo $this->loadTemplate('manufacturer');
		}
		?>

	    </div>
	</div>
	<div class="clear"></div>


    </div>
<?php
	$count_images = count ($this->product->images);
	if ($count_images > 1) {
		echo $this->loadTemplate('images_additional');
	}

	// event onContentBeforeDisplay
	echo $this->product->event->beforeDisplayContent; ?>

	<?php
	//echo ($this->product->product_in_stock - $this->product->product_ordered);
	// Product Description
	if (!empty($this->product->product_desc)) {
	    ?>
        <div class="product-description" >
	<?php /** @todo Test if content plugins modify the product description */ ?>
    	<span class="title"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></span>
	<?php echo $this->product->product_desc; ?>
        </div>
	<?php
    } // Product Description END

	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'normal'));

    // Product Packaging
    $product_packaging = '';
    if ($this->product->product_box) {
	?>
        <div class="product-box">
	    <?php
	        echo vmText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX') .$this->product->product_box;
	    ?>
        </div>
    <?php } // Product Packaging END ?>

    <?php 
	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot'));

  	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));

	shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));

	?>

<?php // onContentAfterDisplay event
echo $this->product->event->afterDisplayContent;

echo $this->loadTemplate('reviews');

// Show child categories
if (VmConfig::get('showCategory', 1)) {
	echo $this->loadTemplate('showcategory');
}

$j = 'jQuery(document).ready(function($) {
	Virtuemart.product(jQuery("form.product"));

	$("form.js-recalculate").each(function(){
		if ($(this).find(".product-fields").length && !$(this).find(".no-vm-bind").length) {
			var id= $(this).find(\'input[name="virtuemart_product_id[]"]\').val();
			Virtuemart.setproducttype($(this),id);

		}
	});
});';
//vmJsApi::addJScript('recalcReady',$j);

/** GALT
 * Notice for Template Developers!
 * Templates must set a Virtuemart.container variable as it takes part in
 * dynamic content update.
 * This variable points to a topmost element that holds other content.
 */
$j = "Virtuemart.container = jQuery('.productdetails-view');
Virtuemart.containerSelector = '.productdetails-view';";

vmJsApi::addJScript('ajaxContent',$j);

if(VmConfig::get ('jdynupdate', TRUE)){
	$j = "jQuery(document).ready(function($) {
	Virtuemart.stopVmLoading();
	var msg = '';
	jQuery('a[data-dynamic-update=\"1\"]').off('click', Virtuemart.startVmLoading).on('click', {msg:msg}, Virtuemart.startVmLoading);
	jQuery('[data-dynamic-update=\"1\"]').off('change', Virtuemart.startVmLoading).on('change', {msg:msg}, Virtuemart.startVmLoading);
});";

	vmJsApi::addJScript('vmPreloader',$j);
}

echo vmJsApi::writeJS();

if ($this->product->prices['salesPrice'] > 0) {
  echo shopFunctionsF::renderVmSubLayout('snippets',array('product'=>$this->product, 'currency'=>$this->currency, 'showRating'=>$this->showRating));
}

?>
</div>



