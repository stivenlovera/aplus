<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$app = JFactory::getApplication();
$menu = $app->getMenu()->getActive()->id;
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);
JHtml::_('behavior.caption');
?>
<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
	<div id="img-intro-page<?php echo $this->pageclass_sfx; ?>" class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>">
		<img
			<?php if ($images->image_intro_caption):
				echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
			endif; ?>
			src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
	</div>
<?php endif; ?>

<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article"
	 xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
	{
		echo $this->item->pagination;
	}
	?>

	<?php // Todo Not that elegant would be nice to group the params ?>
	<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ); ?>

	<?php if (!$useDefList && $this->print) : ?>
		<div id="pop-print" class="btn hidden-print">
			<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
		</div>
		<div class="clearfix"> </div>
	<?php endif; ?>
	<?php if (!$this->print) : ?>
		<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php if ($useDefList) : ?>
			<div id="pop-print" class="btn hidden-print">
				<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

    <div class="post-image">
    	<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
    	<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
    	<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image"> <img
    	<?php if ($images->image_fulltext_caption):
    		echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_fulltext_caption) . '"';
    	endif; ?>
    	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" itemprop="image"/> </div>
    	<?php endif; ?>
    </div>
    <div class="news-info">
    
	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
	<?php endif; ?>

	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<div class="page-header">
		<h1 itemprop="name" class="title">
			<?php if ($params->get('show_title')) : ?>
				<?php echo $this->escape($this->item->title); ?>
			<?php endif; ?>
		</h1>
		<?php if ($this->item->state == 0) : ?>
			<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
		<?php endif; ?>
		<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
			<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
		<?php endif; ?>
		<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
			<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if (!$params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')):?>

	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative):
		echo $this->item->pagination;
	endif;
	?>
	<?php if (isset ($this->item->toc)) :
		echo $this->item->toc;
	endif; ?>
	<div itemprop="articleBody">
		<?php echo $this->item->text; ?>
	</div>

	<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
		<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
		<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
			<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php // Optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
	<?php echo $this->item->introtext; ?>
	<?php // Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
	<?php $menu = JFactory::getApplication()->getMenu(); ?>
	<?php $active = $menu->getActive(); ?>
	<?php $itemId = $active->id; ?>
	<?php $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
	<?php $link->setVar('return', base64_encode(JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language), false))); ?>
	<p class="readmore">
		<a href="<?php echo $link; ?>" class="register">
		<?php $attribs = json_decode($this->item->attribs); ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?>
		</a>
	</p>
	<?php endif; ?>
	<?php endif; ?>
    <div class="tagspopular">

	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

		<?php //echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
		<ul id="windy-tag-list">
			<h6 class="tag">TAGS:</h6>
			<?php foreach ($this->item->tags->itemTags as $tag) : ?>
			<li><a href="<?php  echo JRoute::_('index.php?option=com_tags&view=tag&id='.$tag->id.'-'.$tag->path.'')?>"><?php echo $tag->title; ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
    </div>
		<div class="windy-single-comment-share clearfix">
			<div class="single-comment pull-left special-font">
				<span class="post-comment"><a href="#comments-form"><i class="fa fa-comments"></i> Write comment</a></span>
			</div>
			<div class="share-links pull-right">
				<ul class="social-icons">
					<li class="text-share"><span class="special-font">Share:</span> </li>
					<li class="facebook "><a href="http://www.facebook.com/sharer.php?u=<?php echo JUri::current();?>?option=com_content&view=article&id=<?php echo $this->item->id; ?>&Itemid=<?php echo $menu; ?>" class="post_share_facebook" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i class="fa fa-facebook-f"></i></a></li>
					<li class="twitter "><a href="<?php echo JUri::current();?>?option=com_content&view=article&id=<?php echo $this->item->id; ?>&Itemid=<?php echo $menu; ?>" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" class="product_share_twitter"><i class="fa fa-twitter"></i></a></li>
					<li class="googleplus "><a href="https://plus.google.com/share?url=<?php echo JUri::current();?>?option=com_content&view=article&id=<?php echo $this->item->id; ?>&Itemid=<?php echo $menu; ?>" onclick="javascript:window.open(this.href,
                          '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a></li>
					<li class="pinterest "><a href="http://pinterest.com/pin/create/button/?url=<?php echo JUri::current();?>?option=com_content&view=article&id=<?php echo $this->item->id; ?>&Itemid=<?php echo $menu; ?><?php echo JUri::current();?>?option=com_content&view=article&id=<?php echo $this->item->id; ?>&Itemid=<?php echo $menu; ?>"><i class="fa fa-pinterest"></i></a></li>
					<li class="mail "><a href="mailto:?subject=Repair and maintenance of wind turbines&amp;body=For consumers wanting to generate their own green power, installing a small wind turbine may... <?php echo JUri::current();?>?option=com_content&view=article&id=<?php echo $this->item->id; ?>&Itemid=<?php echo $menu; ?>" class="product_share_email"><i class="fa fa-envelope"></i></a></li>
				</ul>
			</div>
		</div>

	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
		echo $this->item->pagination;
	?>
	<?php endif; ?>
    </div>

	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative):
		echo $this->item->pagination;
	?>
		
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>
</div>

