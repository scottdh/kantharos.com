<?php
/**
 * Newsletter shortcode
 */
class ctNewsletterShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Newsletter';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'newsletter';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$id = rand(100, 1000);
		$js = 'jQuery(document).ready(function () {
					jQuery("#newsletterSubmit_' . $id . '").click(function(){
						var $email = jQuery("#newsletterEmail_' . $id . '").val();
						jQuery.ajax({
							type: "POST",
							  url: "' . get_site_url() . '/wp-admin/admin-ajax.php",
							  data: {
									action: "NewsletterAjax",
									email: $email,
									mailto: "' . $mailto . '",
									subject: "' . $subject . '"
							  },
							success: function (data, textStatus, XMLHttpRequest){
							    jQuery("#newsletterError_' . $id . '") . html("");
								jQuery("#newsletterInfo_' . $id . '") . html("");
								if(data=="true"){
									jQuery("#newsletterInfo_' . $id . '") . text("' . $success . '");
									jQuery("#newsletterEmail_' . $id . '").attr("value", "").hide();
									jQuery("#newsletterEmail_' . $id . '").parent("div.mailIcon").hide();
									jQuery("#newsletterSubmit_' . $id . '").hide();
								}else{
									jQuery("#newsletterError_' . $id . '") . text("' . $fail . '");
								}
							},
							error: function (MLHttpRequest, textStatus, errorThrown){
								jQuery("#newsletterInfo_' . $id . '") . html("");
								jQuery("#newsletterError_' . $id . '") . html("");
								jQuery("#newsletterError_' . $id . '") . text("' . $fail . '");
							}
						})
						return false;
					});
				});';

		$this->addInlineJS($js);
		$headerHtml = $header ? '<h4 class="light">' . $header . '</h4>' : '';
		return $headerHtml .  '<div'.$this->buildContainerAttributes(array('class'=>array('newsletterBox')),$atts).'>
											<p class="brighter">' . $info . '</p>
											<div class="stylishForm newsletter">
												<form>
													<fieldset>
														<div class="mailIcon">
							                                <input id="newsletterEmail_' . $id . '" type="text" class="span12" placeholder="' . $placeholder . '">
							                            </div>
							                            <div class="sendIcon">
							                                <input id="newsletterSubmit_' . $id . '" type="submit" class="btn btn-primary" value="' . $buttontext . '">
							                            </div>
													</fieldset>
													<p class="newsletterInfo brighter" id="newsletterInfo_' . $id . '"></p>
													<p class="newsletterError brighter" id="newsletterError_' . $id . '"></p>
												</form>
											</div>
										</div>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'widgetmode' => array('default' => 'false', 'type' => false),
			'header' => array('label' => __("header text", 'ct_theme'), 'default' => __('Newsletter', 'ct_theme'), 'type' => 'input'),
			'placeholder' => array('label' => __('placeholder', 'ct_theme'), 'default' => __('YOUR EMAIL', 'ct_theme'), 'type' => 'input', 'help' => __("Placeholder text for input", 'ct_theme')),
			'info' => array('label' => __("additional information", 'ct_theme'), 'type' => 'input', 'default' => ''),
			'buttontext' => array('label' => __("button text", 'ct_theme'), 'default' => __('SIGN UP', 'ct_theme'), 'type' => 'input'),
			'success' => array('label' => __('success message', 'ct_theme'), 'default' => __('Success!', 'ct_theme'), 'type' => 'input', 'help' => __("Success message", 'ct_theme')),
			'fail' => array('label' => __('fail message', 'ct_theme'), 'default' => __('Failed!', 'ct_theme'), 'type' => 'input', 'help' => __("Fail message", 'ct_theme')),
			'mailto' => array('default' => get_bloginfo('admin_email'), 'type' => 'input', 'help' => __("Subscription receiver mail", 'ct_theme'), 'label' => __('Mail to', 'ct_theme')),
			'subject' => array('label' => __('subject', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Subject of the admin mail", 'ct_theme')),
		);
	}
}

new ctNewsletterShortcode();


function NewsletterAjax() {
	$email = $_POST['email'];
	$mailto = $_POST['mailto'];
	$subject = $_POST['subject'];

	$message = __("Newsletter subscription", 'ct_theme') . ": " . $email;
	$headers_mail = "From: Newsletter subscription <".esc_attr($email)."> \r\n";

	if (is_email($mailto) && is_email($email)) {
		add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
		if (wp_mail($mailto, $subject, $message, $headers_mail)) {
			die('true');
		}
	} else {
		die('false');
	}
}

add_action('wp_ajax_nopriv_NewsletterAjax', 'NewsletterAjax');
add_action('wp_ajax_NewsletterAjax', 'NewsletterAjax');