<?php
/**
 * @package		mod_fj_related_plus
 * @copyright	Copyright (C) 2008 - 2014 Mark Dexter. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
$showDate = $params->get('showDate', 'none') != 'none';
$showCount = $params->get('showMatchCount', 0);
$showMatchList = $params->def('showMatchList', 0);
$dateFormat = $params->get('date_format', JText::_('DATE_FORMAT_LC4'));
$showTooltip = $params->get('show_tooltip', '1');
$titleLinkable = $params->get('fj_title_linkable'); ?>
<?php
//echo "<pre>";
//print_r($list);
//echo "</pre>";
?>
<div class="row">
	<?php foreach ($list as $key => $value) : ?>
			<div class="col-md-4">
				<?php
					$images =  json_decode($value->images);
					if ( $images->image_intro == "")  $images->image_intro = "images/noimagesintro.png";
				?>
			<a  href="<?php echo $value->route; ?>"><img height="210px" src="<?php echo $images->image_intro;?>" alt=""></a>
			<br>
			<span class="date-post"><?php echo $value->date ?></span>
			<h5><?php echo $value->title;?></h5>

	</div>
	<?php endforeach;?>
</div>