<?php defined('_JEXEC') or die('Restricted access');
$product = $viewData['product'];

if ($viewData['showRating']) {
	$maxrating = VmConfig::get('vm_maximum_rating_scale', 5);
	if (empty($product->rating)) {
	?>
		<div class="ratingbox dummy" title="<?php echo vmText::_('COM_VIRTUEMART_UNRATED'); ?>" >

		</div>
	<?php
	} else {
		$ratingwidth = $product->rating * 24;
  	?>

		<div title=" <?php echo (vmText::_("COM_VIRTUEMART_RATING_TITLE") . round($product->rating) . '/' . $maxrating) ?>" class="ratingbox" style="float: left;" >
	  		<div class="stars-orange" style="width:<?php echo $ratingwidth.'px'; ?>"></div>
		</div>
		<div class="reviews-history"><p><?php echo round($product->rating);?> Review(s) &nbsp; | &nbsp; <a href=""><b>Add your reviews</b></a></p></div>
	<?php
	}
}

?>
<style type="text/css" >
	.reviews-history {
		padding-left: 20px;
		float: left;
	}
	.reviews-history p {
		line-height: 28px;
		margin: 0px;
	}
	.reviews-history p a {
		color : #252525;
	}
	.reviews-history p a b {
		font-weight: 500;
	}
</style>