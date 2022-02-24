<?php
/**
 * Zt Shortcodes
 * A powerful Joomla plugin to help effortlessly customize your own content and style without HTML code knowledge
 * 
 * @name        Zt Shortcodes
 * @version     2.0.0
 * @package     Plugin
 * @subpackage  System
 * @author      ZooTemplate 
 * @email       support@zootemplate.com 
 * @link        http://www.zootemplate.com 
 * @copyright   Copyright (c) 2015 ZooTemplate
 * @license     GPL v2 
 */
defined('_JEXEC') or die('Restricted access');
?>

<?php
$titleFront = $attributes->get('titleFront');
$textFront = $attributes->get('textFront');
$bgColorFront = $attributes->get('bgColorFront');
$titleFrontColor = $attributes->get('titleFrontColor');
$textFrontColor = $attributes->get('textFrontColor');
$titleBack = $attributes->get('titleBack');
$textBack = $attributes->get('textBack');
$bgColorBack = $attributes->get('bgColorBack');
$titleBackColor = $attributes->get('titleBackColor');
$textBackColor = $attributes->get('textBackColor');
$borderSize = $attributes->get('borderSize');
$borderColor = $attributes->get('borderColor');
$borderRadius = $attributes->get('borderRadius');
$icon = $attributes->get('icon');
$iconColor = $attributes->get('iconColor');
$circle = $attributes->get('circle');
$circleBgColor = $attributes->get('circleBgColor');
$circleBorderColor = $attributes->get('circleBorderColor');
$iconSpin = $attributes->get('iconSpin');
$image = $attributes->get('image');
$imageWidth = $attributes->get('imageWidth');
$imageHeight = $attributes->get('imageHeight');
$animationSpeed = $attributes->get('animationSpeed');
?>

<div class="zt-flip-box-front" style="background-color: <?php echo $bgColorFront; ?>; border: <?php echo $borderSize . 'px'; ?> solid <?php echo $borderColor; ?>; border-radius: <?php echo $borderRadius . 'px'; ?>">
    <div class="zt-flip-box-front-inner">
<?php if ($icon)
{ ?>
            <div class="zt-flip-box-icon zt-flip-box-<?php echo ($circle == "yes") ? 'circle' : 'no-circle'; ?>">
                <i style="color: <?php echo $iconColor; ?>; background-color: <?php echo $circleBgColor; ?>; border: 1px solid <?php echo ($circleBorderColor) ? $circleBgColor : 'transparent'; ?>" class="<?php echo $icon; ?> <?php echo ($iconSpin == "yes") ? 'fa-spin' : ''; ?>"></i>
            </div>
        <?php } ?>
        <?php if ($image)
        { ?>
            <div class="zt-flip-box-image">
                <img src="<?php echo $image; ?>" alt="Image Flip Box" width="<?php echo $imageWidth . 'px'; ?>" height="<?php echo $imageHeight . 'px'; ?>" />
            </div>
        <?php } ?>
        <h2 class="zt-flip-box-heading" style="color: <?php echo $titleFrontColor; ?>"><?php echo $titleFront; ?></h2>
        <p style="color: <?php echo $textFrontColor; ?>"><?php $textFront ?></p>
    </div>
</div>
<div class="zt-flip-box-back" style="background-color: <?php echo $bgColorBack; ?>; border: <?php echo $borderSize; ?> solid <?php echo $borderColor; ?>; border-radius: <?php echo $borderRadius . 'px'; ?>">
    <div class="zt-flip-box-back-inner">
        <h3 class="zt-flip-box-heading-back" style="color: <?php echo $titleBackColor; ?>"><?php echo $titleBack; ?></h3>
        <p style="color: <?php echo $textBackColor; ?>"><?php echo $textBack; ?></p>
    </div>
</div>