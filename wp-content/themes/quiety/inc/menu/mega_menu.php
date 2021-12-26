<?php

if ( ! class_exists( 'Quiety_Mega_Menu' ) ) {
	class Quiety_Mega_Menu {
		var $_options;

		public $_parsed_post_custom_options = [];
		public $_custom_options_is_parsed = false;

		public function __construct() {
			$this->_options = self::options();
			$this->_add_filters();
		}
		
		public static function options() {
			return array(
				'tt_wide_menu_enabled' => array(
					'type' 		=> 'select',
					'label' 	=> esc_html__( 'Enable Wide Menu', 'quiety' ),
					'default' => 0,
					'options' => array( 
						1 => esc_html__( 'Yes', 'quiety' ),
						0 => esc_html__( 'No', 'quiety' )
					),
					'size' => 'thin',
					'class' => 'tt-show-only-depth-0',
				)				
			);
		}

		private function _add_filters() {
			# Add custom options to menu
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_options' ) );

			# Update custom menu options
			add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_options' ), 10, 3 );

			# Set edit menu walker
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'apply_edit_walker_class' ), 10, 2 );

			# Addition style
			add_action('admin_enqueue_scripts', array( $this, 'add_menu_css' ) );
		}

		/**
		 * Register custom options and load options values
		 * 
		 * @param obj $item Menu Item
		 * @return obj Menu Item
		 */
		public function add_custom_options( $item ) {

			foreach( $this->_options as $option => $params ) {

				// For qTranslate
				$id = isset( $item->ID ) ? $item->ID : 0;

				$item->$option = get_post_meta( $id, $option, true );
				if ( $item->$option === false ) {
					$item->$option = $params['default'];
				}
			}

			return $item;
		}

		public function manual_custom_options_parsing() {
			if (!$this->_custom_options_is_parsed && isset($_REQUEST['nav-menu-data'])) {
				$data_object = json_decode(str_replace('\"', '"', $_REQUEST['nav-menu-data']));
				if ($data_object) {
					foreach ($data_object as $key => $value) {
						if (strpos($value->name, 'menu-item-tt_wide_menu_enabled') === 0) {
							$this->_parsed_post_custom_options[$value->name] = $value->value;
						}
					}
				}
				$this->_custom_options_is_parsed = true;
			}
		}

		public function update_custom_options( $menu_id, $menu_item_id, $args ) {
			$this->manual_custom_options_parsing();
			foreach( $this->_options as $option => $params ) {
				$key = 'menu-item-'. $option;
				$alt_key = $key . '[' . $menu_item_id . ']'; // for custom parsed data

				$option_value = '';

				if (isset( $this->_parsed_post_custom_options[$alt_key] )) {
					$option_value = wp_unslash($this->_parsed_post_custom_options[$alt_key]);
				} else {
					if ( isset( $_REQUEST[$key], $_REQUEST[$key][$menu_item_id] ) ) {
						$option_value = wp_unslash( $_REQUEST[$key][$menu_item_id] );
					}
				}

				update_post_meta( $menu_item_id, $option, $option_value );
			}

		}

		public function add_menu_css() {
			$css = ".menu-item-settings { overflow: hidden; }";
			wp_add_inline_style('wp-admin', $css);
		}

		public function apply_edit_walker_class( $walker, $menu_id ) {
			return STOCKIE_EDIT_MENU_WALKER_CLASS;
		}
	}
}
