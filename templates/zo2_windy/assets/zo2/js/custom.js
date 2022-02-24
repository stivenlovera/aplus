/* Here you can include your additional Javascript code */

jQuery(document).ready(function() {
	// Add attribute in form
	jQuery(".jvformcontactcontact input[name='name']").attr("placeholder","Your name ...");
	jQuery(".jvformcontactcontact input[name='email']").attr("placeholder","Your Email ...");
	jQuery(".jvformcontactcontact input[name='address']").attr("placeholder","Your Website ...");
	jQuery(".jvformcontactcontact textarea[name='message']").attr("placeholder","Your Message ...");

	jQuery("#comments-form input#comments-form-name").attr("placeholder","Your name ...");
	jQuery("#comments-form input#comments-form-email").attr("placeholder","Your Email ...");
	jQuery("#comments-form input#comments-form-homepage").attr("placeholder","Your Website ...");
	jQuery("#comments-form textarea#comments-form-comment").attr("placeholder","Your Comment ...");

});