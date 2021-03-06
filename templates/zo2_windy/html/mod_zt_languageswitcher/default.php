<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_languages
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

?>
<link href="<?php echo JURI::base(); ?>/modules/mod_zt_languageswitcher/assets/css/selectbox.css" type="text/css" rel="stylesheet" />
<link href="<?php echo JURI::base(); ?>/modules/mod_zt_languageswitcher/assets/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo JURI::base(); ?>/modules/mod_zt_languageswitcher/assets/js/jquery.selectbox.js"></script>
<div class="mod-languages<?php echo $moduleclass_sfx ?>">
    <?php if ($headerText) : ?>
        <div class="pretext"><p><?php echo $headerText; ?></p></div>
    <?php endif; ?>

    <?php if ($params->get('dropdown', 1)) : ?>
        <form id="frmlang" name="lang" method="post" action="<?php echo htmlspecialchars(JUri::current()); ?>">
            <select id="zt_language" class="inputbox" onchange="document.location.replace(this.value);" >
                <?php foreach ($list as $language) : ?>
                    <option data-code="<?php echo $language->image; ?>" dir=<?php echo JLanguage::getInstance($language->lang_code)->isRTL() ? '"rtl"' : '"ltr"' ?> value="<?php echo $language->link; ?>" <?php echo $language->active ? 'selected="selected"' : '' ?>><?php echo $language->title_native; ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    <?php else : ?>
        <ul class="<?php echo $params->get('inline', 1) ? 'lang-inline' : 'lang-block'; ?>">
            <?php foreach ($list as $language) : ?>
                <?php if ($params->get('show_active', 0) || !$language->active): ?>
                    <li class="<?php echo $language->active ? 'lang-active' : ''; ?>" dir="<?php echo JLanguage::getInstance($language->lang_code)->isRTL() ? 'rtl' : 'ltr' ?>">
                        <a href="<?php echo $language->link; ?>">
                            <?php if ($params->get('image', 1)): ?>
                                <?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, array('title' => $language->title_native), true); ?>
                            <?php else : ?>
                                <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef); ?>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($footerText) : ?>
        <div class="posttext"><p><?php echo $footerText; ?></p></div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    jQuery('#zt_language').selectbox({
        mobile: true,
        menuSpeed: '2000'
    });
</script>
