<?php
/**
 * Zo2 (http://www.zootemplate.com/zo2)
 * A powerful Joomla template framework
 *
 * @version     1.4.4
 * @link        http://www.zootemplate.com/zo2
 * @link        https://github.com/cleversoft/zo2
 * @author      ZooTemplate <http://zootemplate.com>
 * @copyright   Copyright (c) 2015 CleverSoft (http://cleversoft.co/)
 * @license     GPL v2
 */
defined('_JEXEC') or die('Restricted Access');

require_once __DIR__ . '/includes/bootstrap.php';
$lang = JFactory::getLanguage();

?>

<!DOCTYPE html>
<html lang="<?php echo $lang->getTag() ?>" dir="<?php echo $this->zo2->template->getDirection(); ?>">
    <head>
        <?php unset($this->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Enable responsive -->
        <?php if (!$this->zo2->framework->get('non_responsive_layout')) : ?>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php endif; ?> 
    <jdoc:include type="head" />
    
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '639047403732551');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=639047403732551&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-208227553-1">
    </script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-208227553-1');
    </script>
    <meta name="facebook-domain-verification" content="isz0fv9qipgisay1m621wkhbt4o1gt" />
</head>
<body class="<?php //echo $this->zo2->layout->getBodyClass(); ?> <?php echo $this->zo2->template->getDirection(); ?> <?php echo $this->zo2->framework->isBoxed() ? 'boxed' : ''; ?>">
    <?php echo $this->zo2->template->fetch('html://layouts/css.condition.php'); ?>        
    <!-- Main wrapper -->
    <section class="zo2-wrapper<?php echo $this->zo2->framework->isBoxed() ? ' boxed container' : ''; ?>">        
        <?php echo $this->zo2->layout->render(); ?>               
    </section>    
    <?php echo $this->zo2->template->fetch('html://layouts/joomla.debug.php'); ?>
    <script type="text/javascript">
		<?php echo $this->zo2->utilities->bottomscript->render(); ?>
    </script>

</body>
</html>
