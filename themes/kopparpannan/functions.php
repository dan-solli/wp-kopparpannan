<?php

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

////////////////////////////////////////////////////
// Signing up 
////////////////////////////////////////////////////

add_action('admin_post_signup_for_event', 'signup_user_for_event');
add_action('admin_post_unsignup_for_event', 'unsignup_user_for_event');
add_action('admin_post_signup_guest_for_event', 'signup_guest_for_event');

function signup_user_for_event()
{
    if (isset($_POST['event_id']) and
        isset($_POST['signup_nonce']) and 
        wp_verify_nonce($_POST['signup_nonce'], 
                        'signup-event-' . $_POST['event_id']))
    {
        $postargs = array(
            'post_author' => $_POST['user_id'],
            'post_title' => '',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type'   => 'medlemsanmalning',
            'comment_status' => 'closed',
            'meta_input' => array(
                'event' => $_POST['event_id'],
                'user'  => $_POST['user_id']
            ),
        );
        $post_id = wp_insert_post($postargs, true);
        if (is_wp_error($post_id)) {
            echo $post_id->get_error_message();
        }
    }
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

function unsignup_user_for_event() 
{
    if (isset($_POST['event_id']) and
        isset($_POST['signup_nonce']) and 
        wp_verify_nonce($_POST['signup_nonce'], 
                        'signup-event-' . $_POST['event_id']))
    {
        $args = array(
            'post_type' => 'medlemsanmalning',
            'post_status' => 'publish', 
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'user',
                    'value' => $_POST['user_id'],
                ),
                array(
                    'key' => 'event',
                    'value' =>$_POST['event_id']
                ),
            ),
        );
        $result = new WP_Query($args);
        $result->the_post();
        $id = get_the_ID();
        wp_delete_post($id, false);
        wp_reset_postdata();
    }
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

function toggle_signup_guest_for_event()
{
    echo "<pre>" + var_dump($_POST) + "</pre>";
}

function is_user_signed_up($event_id) {
    $user_id = get_current_user_id();

    $args = array(
        'post_type' => 'medlemsanmalning',
        'post_status' => 'publish', 
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'user',
                'value' => $user_id
            ),
            array(
                'key' => 'event',
                'value' => $event_id
            ),
        ),
    );
    $result = new WP_Query($args);
    $bool = ($result->post_count != 0 ? true : false);
    wp_reset_postdata();
    return $bool;
}

function calculate_signups($id) {
    $arr = calculate_signup_count($id);

    if ($arr['guests'] > 0) {
        echo $arr['members'] + " + " + $arr['guests'];
    } else {
        echo $arr['members'];
    }

}

function calculate_signup_count($id) {
    $mem_cnt = 0;
    $gue_cnt = 0;

    $args = array(
        'post_type' => 'medlemsanmalning',
        'post_status' => 'publish', 
        'meta_query' => array(
            array(
                'key' => 'event',
                'value' => $id
            ),
        ),
    );
    $result = new WP_Query($args);
    $mem_cnt = $result->post_count;
    wp_reset_postdata();

    $args = array(
        'post_type' => 'gastanmalning',
        'post_status' => 'publish', 
        'meta_query' => array(
            array(
                'key' => 'event',
                'value' => $id
            ),
        ),
    );
    $result = new WP_Query($args);
    $gue_cnt = $result->post_count;
    wp_reset_postdata();

    return array(
        'members' => $mem_cnt, 
        'guests' => $gue_cnt
    );

}

function is_future_event()
{
    $event_time = strtotime(get_field('tid'));
    $now = time();

    return $event_time > $now;
}

///////////////////////////////////////////////////////
// has_ ?
///////////////////////////////////////////////////////

function has_summary() {
    return (strlen(get_field('summering')) > 0);
}

function has_whisky() {
    $args = array( 
        'post_type' => 'kp-whiskybetyg',
        'posts_per_page' => -1,
        'meta_key' => 'prov',
        'meta_value' => get_the_ID(),
    );
    $queue = new WP_Query($args);
    $bool = ($queue->post_count > 0); 
    wp_reset_postdata();
    return $bool;
}

function has_anmalning() {
    $arr = calculate_signup_count(get_the_ID());
    return (arr['guests'] + arr['members'] > 0);
}

function has_citat() {
    $args = array( 
        'post_type' => 'citat',
        'posts_per_page' => -1,
        'meta_key' => 'whisky',
        'meta_value' => get_the_ID(),
    );
    $queue = new WP_Query($args);
    $bool = ($queue->post_count > 0); 
    wp_reset_postdata();
    return $bool;
}

///////////////////////////////////////
// Handle columns in Admin view
///////////////////////////////////////

// Whisky
add_filter( 'manage_kopparpannan-whisky_posts_columns', 'add_kp_whisky_columns', 5 );
add_action( 'manage_kopparpannan-whisky_posts_custom_column', 'add_kp_whisky_column_content', 5, 2 );

function add_kp_whisky_columns( $columns ) {
   $columns['alcohol'] = 'Styrka';
   $columns['age'] = 'Ålder';
   $columns['omrade'] = 'Område';
   $columns['price'] = 'Pris/Volym';
   return $columns;
}

function add_kp_whisky_column_content( $column, $id ) {
  if( 'alcohol' == $column ) {
    $whisky = get_post($id);
    echo get_field('alkoholhalt', $whisky) . "%";
  }
  else if( 'age' == $column ) {
    $whisky = get_post($id);
    echo get_field('age', $whisky);
  }
  else if( 'omrade' == $column ) {
    $whisky = get_post($id);
    echo get_field('alkoholhalt', $whisky) . "%";
  }
  else if( 'price' == $column ) {
    $whisky = get_post($id);
    echo get_field('pris', $whisky) . "/" . get_field('volym', $whisky) . "ml";
  }
}

// Medlemsanmälan
add_filter( 'manage_medlemsanmalning_posts_columns', 'add_medlemsanmalning_columns', 5 );
add_action( 'manage_medlemsanmalning_posts_custom_column', 'add_medlemsanmalning_column_content', 5, 2 );


function add_medlemsanmalning_columns( $columns ) {
   $columns['user'] = 'Anmäld';
   $columns['event'] = 'Evenemang';
   $columns['when'] = 'Tidpunkt';
   return $columns;
}

function add_medlemsanmalning_column_content( $column, $id ) {
  if( 'user' == $column ) {
    $anm = get_post($id);
    $user = get_field('user', $anm);
    $user_ob = get_userdata($user);

    echo $user_ob->display_name;
  }
  else if( 'event' == $column ) {
    $anm = get_post($id);
    $event = get_field('event', $anm);
    echo get_the_title($event);
  }
  else if( 'when' == $column ) {
    $anm = get_post($id);
    echo $anm->post_date;
  }
}

// Event
// Skippar event, eftersom det ändå inte är otydligt.

// Gästanmälan
add_filter( 'manage_gastanmalning_posts_columns', 'add_gastanmalning_columns', 5 );
add_action( 'manage_gastanmalning_posts_custom_column', 'add_gastanmalning_column_content', 5, 2 );


function add_gastanmalning_columns( $columns ) 
{
    $columns['event'] = 'Evenemang';
    $columns['inbjuden'] = 'Gäst';

    $columns['telefon'] = 'Telefon';
    $columns['epost'] = 'Epost';
    $columns['inbjuden_av'] = 'Inbjuden av';
    return $columns;
}

function add_gastanmalning_column_content( $column, $id ) {
  if( 'inbjuden_av' == $column ) {
    $user = get_field('inbjuden_av', get_post($id));
    echo $user['display_name'];
  }
  else if( 'event' == $column) {
    $ev = get_field('event', get_post($id));
    echo $ev->post_title;
  }
  else if( 'inbjuden' == $column ) {
    echo get_field('inbjuden', get_post($id));
  }
  else if( 'telefon' == $column ) {
    echo get_field('telefon', get_post($id));
  }
  else if( 'epost' == $column ) {
    echo get_field('epost', get_post($id));
  }
}

// Betyg
add_filter( 'manage_kp-whiskybetyg_posts_columns', 'add_betyg_columns', 5 );
add_action( 'manage_kp-whiskybetyg_posts_custom_column', 'add_betyg_column_content', 5, 2 );


function add_betyg_columns( $columns ) 
{
    $columns['event'] = 'Prov';
    $columns['whisky'] = 'Whisky';
    $columns['betyg'] = 'Betyg';
    return $columns;
}

function add_betyg_column_content( $column, $id ) {
  if( 'whisky' == $column ) {
    $ev = get_field('whisky', get_post($id));
    echo $ev->post_title;
  }
  else if( 'event' == $column) {
    $ev = get_field('prov', get_post($id));
    //print_r($ev);
    echo $ev->post_title;
  }
  else if( 'betyg' == $column ) {
    echo get_field('betyg', get_post($id));
  }
}

// Citat
add_filter( 'manage_citat_posts_columns', 'add_citat_columns', 5 );
add_action( 'manage_citat_posts_custom_column', 'add_citat_column_content', 5, 2 );


function add_citat_columns( $columns ) 
{
    $columns['event'] = 'Prov';
    $columns['whisky'] = 'Whisky';
    $columns['user'] = 'Upphovsperson';
    return $columns;
}

function add_citat_column_content( $column, $id ) {
  if( 'whisky' == $column ) {
    $ev = get_field('whisky', get_post($id));
    echo $ev->post_title;
  }
  else if( 'event' == $column) {
    $ev = get_field('event', get_post($id));
    //print_r($ev);
    echo $ev->post_title;
  }
  else if( 'user' == $column ) {
    $user = get_field('user', get_post($id));
    echo $user['display_name'];
  }
}

// Hantera flaggor vid whisky.
function the_flag($whisky_id) {
    //echo "Got: $whisky_id\n";
    $term = get_field('omrade', $whisky_id);
    //echo "Term has name: " . $term->name;
    switch ($term->name) {
        case 'Finland':
            $country = 'finland';
            break;
        case 'Frankrike':
            $country = 'france';
            break;
        case 'Indien':
            $country = 'india';
            break;
        case 'Japan':
            $country = 'japan';
            break;
        case 'Kanada':
            $country = 'canada';
            break;
        case 'Skottland':
        case 'Campbeltown':
        case 'Islay':
        case 'Islands':
        case 'Highlands':
        case 'Lowland':
        case 'Speyside':
            $country = 'scotland';
            break;
        case 'Sverige':
            $country = 'sweden';
            break;
        case 'Tyskland':
            $country = 'germany';
            break;
        case 'USA':
            $country = 'us';
            break;
        default:
            $country = null;
            break;
    }
    //echo "Countryflag is: $country";
    if ($country != null) {
        echo "<i class=\"$country flag\"> </i>";
    }
}