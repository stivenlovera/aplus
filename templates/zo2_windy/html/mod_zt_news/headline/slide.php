<?php
/**
 * ZT News
 * 
 * @package     Joomla
 * @subpackage  Module
 * @version     2.0.0
 * @author      ZooTemplate 
 * @email       support@zootemplate.com 
 * @link        http://www.zootemplate.com 
 * @copyright   Copyright (c) 2015 ZooTemplate
 * @license     GPL v2
 */
defined('_JEXEC') or die('Restricted access');
// Slice had items
$listItems = array_slice($slide, $numberIntroItems);
?>
<div class="zt-category headline" id="item-latest-new-blog">
                <?php foreach ($listItems as $key => $item) : ?>
                    <div class="zt-item row item-latest-new" >
                        <?php if($showImageOnList):?>
                            <div class="post-thumnail col-md-3">
                                <a href="<?php echo $item->link; ?>" title="">
                                        <!-- List thumbnail -->
                                    <?php if (!empty($item->subThumb)) : ?>
                                        <img class="thumbnail" 
                                             src="<?php echo $item->subThumb; ?>" 
                                             alt="<?php echo $item->title; ?>"
                                             title="<?php echo $item->title; ?>"
                                             />
                                     <?php endif; ?>
                                </a>
                            </div>
                        <?php endif;?>
                        <div class="zt-article_content col-md-9">
                            <!-- Created -->
                            <?php if ($showCreated) : ?>
                                <span class="created">
                                    <?php echo JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); ?>
                                </span>
                            <?php endif; ?>

                            <?php if ($showTitle) : ?>
                                <h3>
                                    <a href="<?php echo $item->link; ?>" title="">
                                        <?php echo $item->title; ?>
                                    </a>
                                </h3>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
</div>