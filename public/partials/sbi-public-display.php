<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://tsz.co.il
 * @since      1.0.0
 *
 * @package    Sbi
 * @subpackage Sbi/public/partials
 */
 
	function sbi_shortcode() {
		return get_post_meta(get_the_ID(), 'sbi_Value', true);
	}
	add_shortcode('sbi-shortcode', 'sbi_shortcode');

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
