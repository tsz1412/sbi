<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tsz.co.il
 * @since      1.0.0
 *
 * @package    Sbi
 * @subpackage Sbi/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sbi
 * @subpackage Sbi/admin
 * @author     Tsviel Zaikman <tsviel@tsz.co.il>
 */
class Sbi_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		require_once( plugin_dir_path( dirname(__FILE__ ) ) . 'admin/partials/sbi-admin-display.php');
		add_action('save_post', array($this, 'sbi_img_gallery_save' ) );
		add_action( 'add_meta_boxes', array($this, 'sbi_meta_box_add'), 10, 2 );
		

	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sbi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sbi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sbi-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sbi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sbi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sbi-admin.js', array('jquery'), null, false );

	}
	/*
	 * Add a meta box
	 */
	public function sbi_meta_box_add( $post_type, $post ) {
		add_meta_box('sbi_feat_img_slider', // meta box ID
			'Featured Image Gallery', // meta box title
			array($this , 'sbi_print_box'), // callback function that prints the meta box HTML
			'post', // post type where to add it
			'side', // priority
			'default' ); // position
	}
	/*
	 * Meta Box HTML
	 */
	public function sbi_print_box( $post ) {
		wp_nonce_field( 'save_feat_gallery', 'sbi_feat_gallery_nonce' );
		$meta_key = 'second_featured_img';
		echo sbi_image_uploader_field( $meta_key, get_post_meta($post->ID, $meta_key, true) );
	}
 
	/*
	 * Save Meta Box data
	 */
	public function sbi_img_gallery_save( $post_id ) {
		if ( !isset( $_POST['sbi_feat_gallery_nonce'] ) ) {
			return $post_id;
		}
		if ( !wp_verify_nonce( $_POST['sbi_feat_gallery_nonce'], 'save_feat_gallery') ) {
			return $post_id;
		} 
		if ( isset( $_POST[ 'second_featured_img' ] ) ) {
			update_post_meta( $post_id, 'second_featured_img', esc_attr($_POST['second_featured_img']) );
		} else {
			update_post_meta( $post_id, 'second_featured_img', '' );
		}
	}
	
}
