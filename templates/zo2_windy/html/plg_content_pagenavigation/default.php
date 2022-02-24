<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$lang = JFactory::getLanguage();
$article_next =& JTable::getInstance("content");
$article_prev =& JTable::getInstance("content");
$short_url_next = explode(':',$row->next);
$short_url_prev = explode(':',$row->prev);
$id_artile_next = substr($short_url_next[0],63);
$id_artile_prev = substr($short_url_prev[0],63);

$article_next->load($id_artile_next);
$article_prev->load($id_artile_prev);
//echo $article_prev->get("title");
//echo $article_next->get("title");

?>

<ul class="pager pagenav row">
    <?php if ($row->prev) :
        $direction = $lang->isRtl() ? 'right' : 'left'; ?>
        <li class="previous col-sm-6 col-xs-12">
            <a href="<?php echo $row->prev; ?>" rel="prev">Previous Article</a>
            <br/>
            <h6><?php echo $article_prev->get("title"); ?></h6>

        </li>
    <?php endif; ?>
    <?php if ($row->next) :
        $direction = $lang->isRtl() ? 'left' : 'right'; ?>
        <li class="next col-sm-6 col-xs-12">
            <a href="<?php echo $row->next; ?>" rel="next">Next Article</a>
            <br/>
            <h6><?php echo $article_next->get("title"); ?></h6>
        </li>
    <?php endif; ?>
</ul>
