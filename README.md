# WordPress Customizer SVG Picker Control

An SVG Picker Custom Control for the WordPress Customizer

<img src="assets/svg-logo.gif" />

## Demo

I've added this control to my [customizer demo theme](https://github.com/soderlind/2016-customizer-demo).

## Installing the control

Clone this repository and include the class:

```php
/**
 * Check for WP_Customizer_Control existence before adding custom control because WP_Customize_Control
 * is loaded on customizer page only
 *
 * @see _wp_customize_include()
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	require_once( dirname(__FILE) . '/class-customizer-svg-picker-option.php' );
}
```

## Adding the control

```php
$wp_customize->add_control( new Customizer_SVG_Picker_Option( $wp_customize, 'my_svg_url', array(
		'section'     => 'my_section',
		'settings'    => 'my_settings',
		'type'        => 'svg',
) ) );
```

## Additional configuration

The SVG files are defined in [`svg.json`](svg.json):

```json
[
	{ "file" : "svg/logo01.svg" },
	{ "file" : "svg/logo02.svg" }
]
```

## Credits

The Image Picker is  copyright (c) 2016 by Rodrigo Vera

You can see his demo at [https://rvera.github.io/image-picker/](https://rvera.github.io/image-picker/)

The Image Pickert is [licensed](https://github.com/rvera/image-picker/blob/master/LICENSE) under the terms of the [MIT license](http://opensource.org/licenses/MIT)

## Copyright and License

WordPress Customizer SVG Picker Control is copyright 2016 Per Soderlind

WordPress Customizer SVG Picker Control is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.

WordPress Customizer SVG Picker Control is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along with the Extension. If not, see http://www.gnu.org/licenses/.
