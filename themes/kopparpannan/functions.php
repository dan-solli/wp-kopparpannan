<?php

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

// Make sure custom post types are added by default to The Loop
function add_custom_post_type_to_the_loop( $query ) {
	if ($query->is_home() && $query->is_main_query() ) {
		$query->set('post_type', array('post', 'kopparpannan-whisky', 'kopparpannan-event'));
	}
}
add_action('pre_get_posts', 'add_custom_post_type_to_the_loop');

// Make sure Semantic is added to the pages
function setup_semantic_ui () {
  wp_enqueue_style( 'semantic', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css' );
  wp_enqueue_style( 'kopparpannan', get_stylesheet_uri() );
  wp_enqueue_style( 'lightbox2', get_template_directory_uri() . "/assets/css/lightbox.min.css");

  wp_enqueue_script( 'semantic', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js', array( 'jquery', 'jquery-ui-core' ), '1.0.0', true );
  wp_enqueue_script( 'kopparpannan', get_template_directory_uri() . "/assets/js/kopparpannan.js", array('jquery'), true);
  wp_enqueue_script('lightbox2', get_template_directory_uri() . "/assets/js/lightbox.min.js", array('jquery'), true);
}
add_action( 'wp_enqueue_scripts', 'setup_semantic_ui' );

// Make sure we can add widgets or menus to the sidebars.
function kopparpannan_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Left Sidebar', 'kopparpannan' ),
        'id'            => 'left',
        'before_widget' => '<aside id="%1$s" class="widget %2$s grid-sidebar-left">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
 
    register_sidebar( array(
        'name'          => __( 'Right Sidebar', 'kopparpannan' ),
        'id'            => 'right',
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s grid-sidebad-right">',
        'after_widget'  => '</li></ul>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'kopparpannan_widgets_init' );

// Make sure we can have featured images on all post-types
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 140, 140, true );

// Make sure we can have a menu
function register_menus() {
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'register_menus');

// Draw menu
function clean_custom_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
    
        $menu_list  = '<nav class="ui stackable menu">' ."\n";
        $submenu = false;
        $store = array();

        foreach ($menu_items as $mi) {
            $parent_id = $mi->menu_item_parent;
            $id = $mi->ID;

            if (!$parent_id) {
                $store[strval($id)] = array();
            } else {
                array_push($store[strval($parent_id)], $id);
            }
        }
        foreach($menu_items as $menu_item ) {
            $link = $menu_item->url;
            $title = $menu_item->title;
            $parent_id = $menu_item->menu_item_parent;
            $id = $menu_item->ID;

            if (array_key_exists($id, $store)) {
                if ($submenu) {
                    $menu_list .= '</div></div>' ."\n";              
                    $submenu = false;
                }
                if (sizeof($store[strval($id)])) {
                    $submenu = true;
                    $menu_list .= '<div class="ui dropdown item">'.$title."\n".
                                    '<i class="dropdown icon"></i>'."\n".
                                    '<div class="ui vertical menu">' ."\n";
                } else {
                    if ($title == 'Profil') {
                        $menu_list .= '<a class="item" href="'.$link.'"><i class="child icon"></i> Profil ' ."</a>\n";
                    } else {
                        $menu_list .= '<a class="item" href="'.$link.'">' .$title. "</a>\n";
                    }
                }
            } else {
                if ($title == 'Divider') {
                    $menu_list .= '<div class="divider"></div>';
                } else {
                    $menu_list .= '<a class="item" href="'.$link.'">' .$title. "</a>\n";
                }
            }
        }
        $menu_list .= '<div class="ui category search right item">'.
                      '<div class="ui transparent icon input">'.
                      '<input placeholder="Sök..." type="text">'.
                      '<i class="search link icon"></i>'.
                      '</div>'.
                      '<div class="results"></div>';
        if ($submenu) {
            $menu_list .= '</div></div>' ."\n";              
        }
        $menu_list .= '</nav>' ."\n";  
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
    echo $menu_list;
}

// Enable custom logo
add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
) );


/////////////////////////////////////////////////////////////

/*
add_action('wp_ajax_signup_event', 'signup_event_callback');
add_action('wp_enqueue_scripts', 'add_signup_scripts');

function add_signup_scripts()
{
    wp_enqueue_script('signups-script', get_template_directory_uri() . '/assets/js/signups.js', array('jquery'));
    wp_localize_script('signups-script', 'signups_data', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('signups-nonce')) 
    );
}

function signup_event_callback() {
    check_ajax_referer('signups-nonce', 'security');

    $event_id = intval($_POST['event_id']);
    add_event_anmalan($event_id);
    die();
}
*/

/////////////////////////////////////////////////////////
// Attachments 
/////////////////////////////////////////////////////////

function my_attachments($attachments) {
    $fields = array(
        array(
            'name' => 'bildtext',
            'type' => 'text',
            'label' => __('Bildtext', 'attachments'),
            'default' => 'Bildtext'
        )
    );

    $args = array(
        'label' => 'Bilagor',
        'post_type' => array('post', 'page', 'kopparpannan-event', 'kopparpannan-whisky'),
        'position' => 'normal',
        'priority' => 'high',
        'filetype' => null,
        'note' => 'Lägg till bilaga här.',
        'append' => true,
        'button_text' => __('Bilägg filer', 'attachments'),
        'modal_text' => __('Bilägg', 'attachments'),
        'router' => 'browse',
        'post_parent' => false,
        'fields' => $fields
    );
    
    $attachments->register('my_attachments', $args);
}

add_action('attachments_register', 'my_attachments');


    /*

        while ($attachment = $attachments->get()) {
            echo "ID: ". $attachments->id() . "<br />";
            echo "Type: " . $attachments->type() . "<br />";
            echo "Subype: " . $attachments->subtype() . "<br />";
            echo "URL: " . $attachments->url() . "<br />"; 
            echo "TN: " . $attachments->image( 'thumbnail' ) . "<br />";
            echo "FullSrc: " . $attachments->src( 'full' ) . "<br />"; 
            echo "Filesize: " . $attachments->filesize() . "<br />"; 
            echo "Title: " . $attachments->field( 'title' ) . "<br />"; 
            echo "Caption: " . $attachments->field( 'caption' ) . "<br />"; 
        }
    */

function __get_attachments($id, $type) {
    $attachments = new Attachments();

    $search_args = array(
        'post_id' => $id,
        'instance' => 'my_attachments',
        'filetype' => $type
    );

    $attachments->search('', $search_args);

    if ($attachments->exist()) {
        return $attachments;
    }
    else {
        return null;
    }
}

function get_other_attachments($id) {
    return __get_attachments($id, 'application');
}


function get_image_attachments($id) {
    return __get_attachments($id, 'image');
}


function images_in_gallery($id) {
    $result = get_image_attachments($id);
    if ($result == null) {
        return 0;
    } else {
        return $result->total();
    }
}

function the_attachment_icon($subtype) {
    // print_r($subtype);
    switch($subtype) {
        case 'pdf':
            echo "red file pdf";
            break;
        case 'msword':
            echo "blue file word";
            break;
        default:
            echo "file outline";
    }
}