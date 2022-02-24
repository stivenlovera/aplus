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

require __DIR__ . '/init.php';
?>
<div id="zt-headline" class="wrapper">
    <div class="">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php foreach ($list as $key => $slide) : ?>    
                    <div class="item <?php echo ($key == 0) ? 'active' : ''; ?>">
                        <?php require __DIR__ . '/slide.php'; ?>
                    </div>
                <?php endforeach; ?>               
            </div>

        </div>
    </div>
</div>