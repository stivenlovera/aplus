<?php
/**
 * @package     Zt Portfolio
 *
 * @copyright   Copyright (C) 2010 - 2015 ZooTemplate. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die();

require_once JPATH_COMPONENT . '/helpers/helper.php';
ZtPortfolioHelper::generateMeta($this->item);


$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::root(true) . '/components/com_ztportfolio/assets/css/ztportfolio.css' );

$this->item->share_url = $_SERVER['SERVER_NAME'] . JRoute::_('index.php?option=com_ztportfolio&view=item&id='.$this->item->ztportfolio_item_id.':'.$this->item->alias );

$tags = ZtPortfolioHelper::getTags( (array) $this->item->ztportfolio_tag_id );
$newtags = array();
foreach ($tags as $tag) {
	$newtags[] 	 = $tag->title;
}

//video
if($this->item->video) {
	$video = parse_url($this->item->video);

	switch($video['host']) {
		case 'youtu.be':
		$video_id 	= trim($video['path'],'/');
		$video_src 	= '//www.youtube.com/embed/' . $video_id;
		break;

		case 'www.youtube.com':
		case 'youtube.com':
		parse_str($video['query'], $query);
		$video_id 	= $query['v'];
		$video_src 	= '//www.youtube.com/embed/' . $video_id;
		break;

		case 'vimeo.com':
		case 'www.vimeo.com':
		$video_id 	= trim($video['path'],'/');
		$video_src 	= "//player.vimeo.com/video/" . $video_id;
	}

}

?>

<div id="zt-portfolio" class="zt-portfolio zt-portfolio-view-item">
	<div class="zt-portfolio-details clearfix">
		<div class="zt-portfolio-description">
			<?php echo $this->item->description; ?>
		</div>
 </div>

	<div class="zt-portfolio-nav">
		<?php
		if($previous = ZtPortfolioHelper::getPreviousArticle($this->item->ztportfolio_item_id)): ?>
        <div class="portfolio-previous text-left">
			<i class="fa fa-angle-left"></i>
			<a  href="<?php echo ZtPortfolioHelper::getPortfolioUrl($previous[0])?>">
				<span>Previous</span>
			</a>
            <h6><a  href="<?php echo ZtPortfolioHelper::getPortfolioUrl($previous[0])?>"><?php echo $previous[0]['title']?></a></h6>
        </div>
		<?php
		endif;
		if($next = ZtPortfolioHelper::getNextArticle($this->item->ztportfolio_item_id)):
		?>
        <div class="portfolio-next text-right">

			<a href="<?php echo ZtPortfolioHelper::getPortfolioUrl($next[0])?>">
				<span>Next</span>
			</a>
			<i class="fa fa-angle-right"></i>
            <h6><a href="<?php echo ZtPortfolioHelper::getPortfolioUrl($next[0])?>"><?php echo $next[0]['title']?></a></h6>
        </div>
		<?php
		endif;?>
		
	</div>
</div>
