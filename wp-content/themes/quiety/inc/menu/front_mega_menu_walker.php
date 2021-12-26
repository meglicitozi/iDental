<?php

if ( ! class_exists( 'Quiety_Nav_Menu_Walker' ) ) {
	class Quiety_Nav_Menu_Walker extends Walker_Nav_Menu {
		private $_last_ul = '';
		
		function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			
			if ( is_object( $args[0]) ) {
				$args[0]->has_children = !empty( $children_elements[$element->$id_field] );
				$args[0]->wide_menu = ( $depth == 0 && !empty( $element->tt_wide_menu_enabled ) && $element->tt_wide_menu_enabled==1 );
				$args[0]->full_width_menu = ( $depth == 0 && !empty( $element->tt_full_width_menu_enabled ) && $element->tt_full_width_menu_enabled==1 );
				$args[0]->Quiety_Mega_Menu_image = ( $depth == 0 && !empty( $element->Quiety_Mega_Menu_image ) ) ? $element->Quiety_Mega_Menu_image : '';
				$args[0]->Quiety_Mega_Menu_bg_position = ( $depth == 0 && !empty( $element->Quiety_Mega_Menu_bg_position ) ) ? $element->Quiety_Mega_Menu_bg_position : '';
				$args[0]->Quiety_Mega_Menu_bg_repeat = ( $depth == 0 && !empty( $element->Quiety_Mega_Menu_bg_repeat ) ) ? $element->Quiety_Mega_Menu_bg_repeat : '';
			}

			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function start_lvl( &$output, $depth = 0, $args = array( ) ) {
			// depth dependent classes
			$indent = ( $depth > 0 ? str_repeat("\t", $depth ) : '' ); // code indent
			$display_depth = ( $depth + 1 ); // because it counts the first submenu as 0

			$classes = array(
				'menu-depth-' . $display_depth
			);

			if ( $display_depth==1 ) {
				$classes[] = 'sub-menu';
				
				if ( $args->wide_menu ) {
					$classes[] = 'sub-menu-wide';
				}
				
				if ( $args->full_width_menu ) {
					$classes[] = 'sub-menu-full-width';
				}
				
			} else if ( $display_depth >= 2 ) {
				$classes[] = 'sub-menu';
			}
		
		
			
			$class_names = implode( ' ', $classes );
			
			// build html output
			$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
		}
		
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth );
			$postfix = '';
			// $postfix = '</div>';
			
			$output .= "{$indent}</ul>{$postfix}\n";
		}
		
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;
			
			// code indent
			$indent = ( $depth > 0 ? str_repeat("\t", $depth ) : '' );

			// depth dependent classes
			$depth_classes = array(
				( $depth == 0 ? 'nav-item' : 'sub-nav-item' ),
				'menu-item-depth-' . $depth,
			);

			if (!empty( $item->_Quiety_Mega_Menu_subtitle )  && ( $depth>0 ) ) {
				$depth_classes[] = 'mega-menu-item-has-subtitle';
			}
			
			if ( is_array( $item->classes ) ) {
				if( in_array("current-menu-ancestor", $item->classes ) ) {
					$depth_classes[] = 'current-menu-ancestor';
				}
				
				if( in_array("current-menu-item", $item->classes ) ) {
					$depth_classes[] = 'current-menu-item';
				}
				
				if( in_array("current-menu-parent", $item->classes ) ) {
					$depth_classes[] = 'current-menu-parent';
				}
			}

			$btnPlus = '';
			// build html
			if ( is_object( $args ) && $args->has_children ) {
				$depth_classes[] = 'has-submenu';

				// $btnPlus = '<div class="has-submenu-icon"><i class="ti-plus"></i></div>';
			}
			
			if ( $depth == 0 ) {

				if ( $args->wide_menu ) {
					$depth_classes[] = 'mega-menu';
				}

				if ( is_object( $args ) && $args->full_width_menu ) {
					$depth_classes[] = 'sub-menu-full-width';
				}
				
			}

			$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

			$custom_class_names = '';

			if (is_array($item->classes)) {
				foreach ( $item->classes as $class ) {
					if ( $class == 'menu-item' ) {
						break;
					}
					$custom_class_names .= ' ' . $class;
				}
			}


			$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '-' . uniqid() . '" class="mega-menu-item ' . $depth_class_names . $custom_class_names . '">';

			// link attributes
			$attributes  = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= !empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
			$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link item-title' ) . '"';
			
			$icon = !empty( $item->_Quiety_Mega_Menu_icon ) ? '<i class="'.$item->_Quiety_Mega_Menu_icon.'"></i>' : '';
			if (!empty( $item->_Quiety_Mega_Menu_subtitle ) && ( $depth>0 ) ) {
				$subtitle = !empty( $item->_Quiety_Mega_Menu_icon ) ? '<span class="menu-subtitle has-icon">'.$item->_Quiety_Mega_Menu_subtitle.'</span>' : '<span class="menu-subtitle">'.$item->_Quiety_Mega_Menu_subtitle.'</span>';
			} else {
				$subtitle = '';
			}

			switch( true ) {
				case ( $depth == 0 ):
					$item_output = sprintf( '%1$s<a%2$s><span>',
						( ( is_object( $args )) ? $args->before : '' ), $attributes
					);

					$item_output .= sprintf( '%s'.$subtitle,
						apply_filters( 'the_title', $icon.$item->title, $item->ID )
					);

					$item_output .= sprintf( '</span>%2$s</a>%1$s', 
						( ( is_object( $args ) ) ? $args->after : '' ), $btnPlus
					);
					$item_output .= sprintf( '%s'.$subtitle,
						$indent
					);
					break;
				default: 
					$item_output = sprintf( '%1$s<a%2$s><span>%3$s%4$s%5$s</span>%7$s</a>%6$s',
						$args->before, 
						$attributes, 
						$args->link_before,
						apply_filters( 'the_title', $icon.$item->title, $item->ID ).$subtitle,
						$args->link_after, 
						$args->after,
						$btnPlus
					);
			}

			if ( $depth == 0 ) {
				
				
			} else {
				
			}

			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
		}
	}
}