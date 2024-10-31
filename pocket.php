<?php
/*
Plugin Name: Pocket Read It Later Links
Description: Automatically display Pocket 'Read It Later' links next to your blog posts.
Plugin URI:  http://lud.icro.us/wordpress-plugin-pocket/
Version:     1.0
Author:      John Blackbourn
Author URI:  http://johnblackbourn.com/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/

class PocketReadItLater {

	function __construct() {

		add_action( 'pocket_read_it_later', array( $this, 'read_later' ) );
		add_action( 'admin_menu',           array( $this, 'admin_menu' ) );
		add_action( 'init',                 array( $this, 'script' ) );
		add_action( 'wp_head',              array( $this, 'style' ) );
		add_action( 'admin_init',           array( $this, 'register_setting' ) );
		add_filter( 'the_excerpt',          array( $this, 'content' ) );
		add_filter( 'the_content',          array( $this, 'content' ) );

		$this->opt = get_option( 'pocket_read_it_later', array(
			'filter' => 'all',
			'css'    => "float: right;\nmargin: 0px 0px 10px 15px;"
		) );

	}

	function register_setting() {
		register_setting( 'pocket_read_it_later', 'pocket_read_it_later' );
	}

	function admin_menu() {
		add_options_page(
			__( 'Pocket Links', 'pocket_read_it_later' ),
			__( 'Pocket Links', 'pocket_read_it_later' ),
			'manage_options',
			'pocket_read_it_later',
			array( $this, 'settings' )
		);
	}

	function style() {
		if ( empty( $this->opt['css'] ) )
			return;
		?>
		<style type="text/css">

		.pocket_read_it_later {
		<?php echo $this->opt['css']; ?>
		}

		</style>
		<?php
	}

	function script() {
		wp_enqueue_script(
			'pocket_read_it_later',
			'http://readitlaterlist.com/button/multi_v1.js',
			null,
			null
		);
	}

	function code( $post_id = 0 ) {
		$post = get_post( $post_id );
		return '<span class="pocket_read_it_later"><script type="text/javascript">
			RIL_button( "' . get_permalink( $post->ID ) . '", "' . get_the_title( $post->ID ) . '" );
		</script></span>';
	}

	function read_later( $post_id = 0 ) {
		echo $this->code( $post_id );
	}

	function content( $content ) {
		if ( 'all' == $this->opt['filter'] )
			$content = $this->code() . $content;
		if ( ( is_single() or is_page() ) and ( 'single' == $this->opt['filter'] ) )
			$content = $this->code() . $content;
		else if ( !is_single() and !is_page() and ( 'nonsingle' == $this->opt['filter'] ) )
			$content = $this->code() . $content;
		return $content;
	}

	function settings() {
		?>

		<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e( 'Pocket Read It Later Links', 'pocket_read_it_later' ); ?></h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'pocket_read_it_later' ); ?>

			<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e( 'Automatic &#8216;Read It Later&#8217; Link Placement', 'pocket_read_it_later' ); ?></th>
				<td>
					<p><label><input type="radio" name="pocket_read_it_later[filter]" <?php checked( 'all', $this->opt['filter'] ); ?> value="all" /> <?php _e( 'I&#8217;d like them everywhere!', 'pocket_read_it_later' ); ?></label></p>
					<p><label><input type="radio" name="pocket_read_it_later[filter]" <?php checked( 'single', $this->opt['filter'] ); ?> value="single" /> <?php _e( 'Just on single posts and pages', 'pocket_read_it_later' ); ?></label></p>
					<p><label><input type="radio" name="pocket_read_it_later[filter]" <?php checked( 'nonsingle', $this->opt['filter'] ); ?> value="nonsingle" /> <?php _e( 'Just on my home page and archives', 'pocket_read_it_later' ); ?></label></p>
					<p><label><input type="radio" name="pocket_read_it_later[filter]" <?php checked( 'false', $this->opt['filter'] ); ?> value="false" /> <?php _e( 'Don&#8217;t automatically display them at all', 'pocket_read_it_later' ); ?></label><br />
					<span class="description"><?php printf( __( 'You&#8217;ll need to add the %s template tag inside the WordPress loop in this case.', 'pocket_read_it_later' ), "<code>&lt;?php do_action('pocket_read_it_later'); ?&gt;</code>" ); ?></span></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Custom CSS', 'pocket_read_it_later' ); ?></th>
				<td>
					<p><textarea name="pocket_read_it_later[css]" class="code" rows="4" cols="50"><?php echo esc_attr( $this->opt['css'] ); ?></textarea>
					<p class="description"><?php _e( 'You can specify your own CSS for the &#8216;Read It Later&#8217; links here. Note that the only CSS rules that will have real effect are margins and positions as the actual link is inside an iframe and therefore unstylable. If present, this CSS is applied regardless of the automatic placement setting.', 'pocket_read_it_later' ); ?></p>
					</p>
				</td>
			</tr>
			</table>

			<?php submit_button(); ?>
		</form>

		</div>

		<?php
	}

}

load_plugin_textdomain( 'pocket_read_it_later', false, dirname( plugin_basename( __FILE__ ) ) );

$pocket_read_it_later = new PocketReadItLater;

?>