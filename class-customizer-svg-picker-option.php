<?php
class Customizer_SVG_Picker_Option extends WP_Customize_Control {
	public $type = 'svg';

	/**
	 * Create a option list with URLs to SVG files. The SVG files are defined in svg.json
	 *
	 * @author soderlind
	 * @param   string    $selected_value The SVG selected.
	 * @return  string                    select tag with options.
	 */
	private function _list_svg( $selected_value = '' ) {
		$ret = '';
		$svg_data_file = dirname( __FILE__ ) . '/svg.json';
		if ( file_exists( $svg_data_file ) ) {
			$svg_data = file_get_contents( $svg_data_file );
			$svgs = json_decode( $svg_data,true );
			// TODO: add error control for `if ( null === $svgs && json_last_error() !== JSON_ERROR_NONE ) {}`

			$ret = '<select class="image-picker">';
			foreach ( $svgs as $svg ) {
				if ( '' !== $selected_value && sprintf( '%s/%s', get_stylesheet_directory_uri(), $svg['file'] ) === $selected_value ) {
					$ret .= sprintf( '<option selected data-img-class="svg-logo"  data-img-src="%1$s/%2$s" value="%1$s/%2$s" >%2$s</option>', get_stylesheet_directory_uri(), $svg['file'] );
				} else {
					$ret .= sprintf( '<option data-img-class="svg-logo"  data-img-src="%1$s/%2$s" value="%1$s/%2$s" >%2$s</option>', get_stylesheet_directory_uri(), $svg['file'] );
				}
			}
			$ret .= '</select>';
		}
		return $ret;
	}

	/**
	 * Enqueue the image-picker jQuery plugin (https://rvera.github.io/image-picker/)
	 */
	function enqueue() {
		wp_enqueue_style( 'image-picker', get_stylesheet_directory_uri() . '/js/image-picker/image-picker.css' );
		$css = '
			.svg-logo {
				width: 55px;
				/*text-align: center;*/
			}
			.svg-logo img {
				background-color: #ffffff;
			}
		';
		wp_add_inline_style( 'image-picker', $css );

		wp_enqueue_script( 'image-picker', get_stylesheet_directory_uri() . '/js/image-picker/image-picker.js', array( 'jquery' ), '1.0.11', true );
		wp_add_inline_script( 'image-picker', 'jQuery(document).ready(function($){
			$("select.image-picker").imagepicker({
				selected : function(){
					$("#selected_svg").val( $(this).val() ); // save selected svg logo in hidden field
					$("#selected_svg").change(); // trigger Save & Publish  change in customizer
				}
			});
		});', 'after' );
	}

	public function render_content() {
	?>
	<label>
		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>
		<?php echo $this->_list_svg( esc_attr( $this->value() ) ); ?>
		<input type="hidden" id="selected_svg" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
	</label>
	<?php
	}
}
