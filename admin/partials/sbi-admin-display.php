<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://tsz.co.il
 * @since      1.0.0
 *
 * @package    Sbi
 * @subpackage Sbi/admin/partials
 */
 
function sbi_image_uploader_field( $name, $value = '' ) {
     
    $image = 'Upload Image';
    $button = 'button';
    $image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display = 'none'; // display state of the "Remove image" button
     
    ?>
     
    <p><?php
        _e( '<i>Set Images for Featured Image Gallery</i>', 'sbi' );
    ?></p>
     
    <label>
        <div class="gallery-screenshot clearfix">
            <?php
            {
                $ids = explode(',', $value);
                foreach ($ids as $attachment_id) {
                    $img = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                    echo '<div class="screen-thumb"><img src="' . esc_url($img[0]) . '" /></div>';
                }
            }
            ?>
        </div>
         
        <input id="edit-gallery" class="button upload_gallery_button" type="button"
               value="<?php esc_html_e('Add/Edit Gallery', 'sbi') ?>"/>
        <input id="clear-gallery" class="button upload_gallery_button" type="button"
               value="<?php esc_html_e('Clear', 'sbi') ?>"/>
        <input type="hidden" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" class="gallery_values" value="<?php echo esc_attr($value); ?>">
    </label>
<?php   
}
 
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
