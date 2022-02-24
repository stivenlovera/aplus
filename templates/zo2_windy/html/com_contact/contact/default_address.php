<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<iframe style="width: 100%;" src=https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3798.856136334454!2d-63.18949446631603!3d-17.79845714054317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTfCsDQ3JzUzLjYiUyA2M8KwMTEnMjMuMyJX!5e0!3m2!1ses!2s!4v1508977251998" width="470" height="360" frameborder="0" style="border: 0px; -webkit-filter: grayscale(100%); pointer-events: none;" allowfullscreen=""></iframe>
<?php if (($this->params->get('address_check') > 0) && 
	($this->contact->address 
	|| $this->contact->suburb  
	|| $this->contact->state 
	|| $this->contact->country 
	|| $this->contact->postcode) 
	|| $this->params->get('show_email')
	|| $this->params->get('show_telephone')
	|| $this->params->get('show_fax')
	|| $this->params->get('show_mobile')
	|| $this->params->get('show_webpage')
	|| ($this->contact->con_position && $this->params->get('show_position'))):?>
	<div class="contact-title">
        <h3><span><?php  echo '<h3>' . JText::_('COM_CONTACT_DETAILS') . '</h3>';  ?></span></h3>
        </div>
	<div class="contact-address-block">
	<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
		<h4><?php echo $this->contact->con_position; ?></h4>
	<?php endif; ?>
	<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
		<div class="pull-right">
			<?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle')); ?>
		</div>
	<?php endif; ?>
	<?php if (($this->params->get('address_check') > 0) &&  ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
		<div class="contact-address">
			<div class="media">
				<div class="pull-left">
					Direccion :
				</div>
				<div class="media-body">
					<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
						<span class="contact-street">

							<?php echo nl2br($this->contact->address); ?>
						</span>
					<?php endif; ?>
					
					<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
						<span class="contact-suburb">
							<?php echo $this->contact->suburb; ?>
						</span>
					<?php endif; ?>
					
					<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
						<span class="contact-state">
							<?php echo $this->contact->state; ?>
						</span>
					<?php endif; ?>
					
					<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
						<span class="contact-postcode">
							<?php echo $this->contact->postcode; ?>
						</span>
					<?php endif; ?>
					
					<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
						<span class="contact-country">
							<?php echo $this->contact->country; ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
		<div class="contact-contactinfo">
	<?php endif; ?>
	

	<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
		<div class="media">
			<div class="pull-left">
				Telefono:
			</div>
			<div class="media-body contact-telephone">
				
				<?php echo nl2br($this->contact->telephone); ?>
			</div>
		</div>
	<?php endif; ?>
	
	<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
		<div class="media">
			<div class="pull-left">
				<i class="fa fa-print"></i>
			</div>
			<div class="media-body contact-fax">
				<?php echo nl2br($this->contact->fax); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($this->contact->mobile && $this->params->get('show_mobile')) :?>
		<div class="media">
			<div class="pull-left">
				Celular:
			</div>
			<div class="media-body contact-mobile">
				<?php echo nl2br($this->contact->mobile); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
		<div class="media">
			<div class="pull-left">
				Email :
			</div>
			<div class="media-body contact-emailto">
				<?php echo $this->contact->email_to; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
		<div class="media">
			<div class="pull-left">
				<i class="fa fa-globe"></i>
			</div>
			<div class="media-body contact-webpage">
				<a href="<?php echo $this->contact->webpage; ?>" target="_blank">
				<?php echo $this->contact->webpage; ?></a>
			</div>
		</div>
	<?php endif; ?>
	<?php if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
		</div>
	<?php endif; ?>
	
	<?php if ($this->params->get('allow_vcard')) :	?>
		<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
			<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id='.$this->contact->id . '&amp;format=vcf'); ?>">
				<?php echo JText::_('COM_CONTACT_VCARD');?></a>
	<?php endif; ?>	
	</div>
<?php endif; ?>

<div class="contact-footer-social">
	<a href="https://www.facebook.com/" target="new"><i class="fa fa-facebook">&nbsp;</i></a></div>
<h4 style="box-sizing: inherit; font-family: Poppins, sans-serif; line-height: normal; color: #252525; margin: 0px 0px 20px; font-size: 21px; border: 0px; outline: 0px; vertical-align: baseline; clear: both; -webkit-font-smoothing: antialiased; padding: 10px !important 0px 5px !important 0px;">HORARIOS DE ATENCION</h4>
<div style="box-sizing: inherit; border: 0px; font-family: Roboto, sans-serif; font-size: 15px; font-weight: normal; margin: 0px 0px 35px; outline: 0px; padding: 0px; vertical-align: baseline; color: #7d7d7d; line-height: 26px; text-transform: none;">
	<div style="box-sizing: inherit; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;">
		<p style="box-sizing: inherit; margin: 0px; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; padding: 0px; vertical-align: baseline; line-height: 1.7; outline: 0px !important;"><span style="box-sizing: inherit; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; width: 180px; display: inline-block;">Lunes a Viernes:</span>&nbsp;<span style="box-sizing: inherit; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; margin: 0px; padding: 0px; vertical-align: baseline; color: #252525; outline: 0px !important;">8:30 am - 18:30 pm</span></p>
		<p style="box-sizing: inherit; margin: 0px 0px 1.6em; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 1.7;"><span style="box-sizing: inherit; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; width: 180px; display: inline-block;">Sabados:</span>&nbsp;<span style="box-sizing: inherit; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; color: #252525;">8:00 am - 12:00 pm<br />
	  </span>	</p>
	</div>
</div>