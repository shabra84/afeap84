<?php
global $Post_Type_Chronosly, $wp_query;
$timezone = date_default_timezone_get();
$offset = get_option("gmt_offset");
if($offset[0] != "-") $offset = "-".$offset;
else $offset = "+".substr($offset, 1);
date_default_timezone_set("Etc/GMT$offset");
$limit = (isset($_REQUEST["chcount"]) and $_REQUEST["chcount"])?$_REQUEST["chcount"]:3;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if($_REQUEST["page"]) $paged = $_REQUEST["page"];
if($_REQUEST["js_render"]) $_REQUEST["shortcode"] = 1;
if(!isset($_REQUEST["shortcode"]) or !$_REQUEST["shortcode"]){
    get_header();
}


$args = array('orderby'=>"name" , 'order'=> $Post_Type_Chronosly->settings["chronosly_category_orderdir"],'hide_empty'=>true);

if($_REQUEST["category"]){
    if(stripos($_REQUEST["category"], ",")) $include = explode(",", $_REQUEST["category"]);
    else $include = array($_REQUEST["category"]);
    $args["include"] = $include;
}

$custom_terms = get_terms("chronosly_category", $args);
//reorder
if($Post_Type_Chronosly->settings["chronosly_category_order"] !== "name"){
    foreach ($custom_terms as $term) {
        $meta = unserialize(get_option('chronosly-taxonomy_'.$term->term_id));
        $reordered[$meta["order"]] = $term;
    }
    if($Post_Type_Chronosly->settings["chronosly_category_orderdir"] == "ASC") ksort($reordered);
    else krsort($reordered);
}


if(!isset($_REQUEST["shortcode"]) or !$_REQUEST["shortcode"]){
    ?>
    <section id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

<?php
}

echo '<div class="chronosly-closure">';


$Post_Type_Chronosly->template->templates_tabs("dad1", 1);

$stilo = "margin:auto;padding:30px;";
if($Post_Type_Chronosly->settings["chronosly_template_max"]) $stilo .= "max-width:".$Post_Type_Chronosly->settings["chronosly_template_max"]."px;";
if($Post_Type_Chronosly->settings["chronosly_template_min"]) $stilo .= "min-width:".$Post_Type_Chronosly->settings["chronosly_template_min"]."px;";
if(!isset($_REQUEST["shortcode"]) or !$_REQUEST["shortcode"] or (isset($_REQUEST["navigation"]) and $_REQUEST["navigation"])){

    ?>

    <div class="ch-header ch-<?php echo $Post_Type_Chronosly->settings["chronosly_titles_template_default"];?>" style="<?php echo $stilo;?>">
   <?php if(!$Post_Type_Chronosly->settings["chronosly_hide_navigation_title"]) {?>
        <span class="title"><?php _e("Categories", "chronosly"); ?></span>
    <?php }
    if(!$Post_Type_Chronosly->settings["chronosly_hide_navigation_calendar"]) {?>
        <?php   if($Post_Type_Chronosly->settings["chronosly-calendar-url"]){ ?>
                     <a href="<?php  echo $Post_Type_Chronosly->settings["chronosly-calendar-url"]; ?>" class="icon-calendar"></a>

                <?php } else { ?>
                        <a href="<?php  echo (get_option('permalink_structure')?Post_Type_Chronosly_Calendar::get_permalink()."year_".date("Y")."/month_".date("n")."/":get_site_url()."/?post_type=chronosly_calendar&y=".date("Y")."&mo=".date("n")); ?>" class="icon-calendar"></a>
    <?php    }
         }  ?>
    </div>

    <?php
}
if(!$_REQUEST["shortcode"] or ($_REQUEST["shortcode"] and $_REQUEST["before_events"])) do_action("chronosly-before-events", $stilo);
echo "<div class='chronosly-content-block' style='".$stilo.";clear:both;'>";
if ( count($custom_terms ) ) {
    foreach($custom_terms as $term){

        $tax = $term->slug;
        $extra = array("chronosly_category" => $tax);
        $feats = 0;

        if(!has_action( 'posts_orderby', array("Post_Type_Chronosly",'add_custom_orderby') )) add_action( 'posts_orderby', array("Post_Type_Chronosly",'add_custom_orderby') );
        if(!has_action( 'pre_get_posts', array("Post_Type_Chronosly",'add_custom_post_vars') )) add_action( 'pre_get_posts', array("Post_Type_Chronosly",'add_custom_post_vars')  );

        $wp_query->query("chronosly_category=$tax&posts_per_page=$limit&numberposts=$limit");
        if(has_action( 'posts_orderby', array("Post_Type_Chronosly",'add_custom_orderby') )) remove_action( 'posts_orderby', array("Post_Type_Chronosly",'add_custom_orderby') );
        if(has_action( 'pre_get_posts', array("Post_Type_Chronosly",'add_custom_post_vars') )) remove_action( 'pre_get_posts', array("Post_Type_Chronosly",'add_custom_post_vars') );

        $repeated = Post_Type_Chronosly::get_events_repeated_by_date($limit, $paged, $extra);
        $elementos = Post_Type_Chronosly::get_days_by_date($wp_query, $repeated, $limit, $paged);
        $elements = $elementos[0];
            if ( count($elements) ) {




            $wp_query_orig = $wp_query;
            $post_orig = $post;
            $tax_ob =get_term_by("slug", $tax, "chronosly_category");
            ob_start();
            $Post_Type_Chronosly->template->print_template($tax_ob->term_id, "dad11", "", "", "front");

            $content = ob_get_clean();
            $wp_query = $wp_query_orig;
            if(stripos($content, "#event_list#")){

                $res = "";

                $repeats = array();

                    foreach($elements as $el){
                        $xid = $ide = 0;
                        if(is_array($el)){
                            $xid = $ide =  $el["id"];
                            ob_start();
                            if(isset($repeats[$xid])) $ide .= "_".$repeats[$xid];
                            $evs = array("id" => $ide,"start" => $el["start"], "end" => $el["end"]);
                            if($el["h"] && $el["eh"]) $evs = array("id" => $ide, "start" => $el["start"], "end" => $el["end"], "h" => $el["h"], "m" => $el["m"], "eh" => $el["eh"], "em" => $el["em"]);
                            $Post_Type_Chronosly->template->print_template($el["id"], "dad4", "", "", "front", $evs);
                            $events_list[$ide]= ob_get_clean();
                        }
                        else {
                            $xid = $ide = $el;
                            ob_start();
                            $Post_Type_Chronosly->template->print_template($el, "dad4", "", "", "front");
                            $events_list[$ide]= ob_get_clean();
                        }
                        if(isset($repeats[$xid])) ++$repeats[$xid];
                        else $repeats[$xid] = 1;




                        $is_feat = stripos($events_list[$ide], " ch-featured ");
                        if($feats and !$is_feat){
                            $res .= "<span class='feat-sep'></span>";
                            $feats = 0;
                        }
                        else if($is_feat) $feats = 1;
                        $res .= $events_list[$ide];

                }
                echo str_replace("#event_list#", $res, $content);

            } else echo $content;

            if(!$_REQUEST['page'] and (!isset($_REQUEST["shortcode"]) or $_REQUEST["pagination"])) {
                echo "<div class='pagination'  style='$stilo'>";
                echo "<a class='cat-more' href='".(get_option('permalink_structure')?get_term_link($term):"/index.php?chronosly_category=".$term->slug)."'>".__("More", "chronosly")." ". $term->name." ".__("events", "chronosly")."</a>";
                echo "</div>";
            }
            else if($_REQUEST['page']) {
                echo "<div class='pagination'  style='$stilo'>";
                if(!$_REQUEST["ch_code"]) $_REQUEST["ch_code"] = json_encode(array("type"=>'category', "category" => $term->term_id , "pagination" => 1));
                if($elementos[1]) echo '<a onclick="javascript:ch_prev_page('.$limit.','.$paged.', \''. urlencode($_REQUEST["ch_code"]) .'\', this)"><< '.__("Previous page").'</a> &nbsp;&nbsp;&nbsp;';
                if($elementos[2]) echo '<a onclick="javascript:ch_next_page('.$limit.','.$paged.', \''. urlencode($_REQUEST["ch_code"]) .'\', this)">'.__("Next page").' >></a>';
                echo "</div>";
            }
        }
    }

} else {
    echo '<div class="ch-error" style="'.$stilo.'">';
    _e("No events found", "chronosly");
    echo '</div>';
}
echo "</div>"; //close chronosly block
if(!$_REQUEST["shortcode"] or ($_REQUEST["shortcode"] and $_REQUEST["after_events"])) do_action("chronosly-after-events");
echo "</div>"; //close chronosly closure

// ini_set('date.timezone', $timezone);
date_default_timezone_set($timezone);
if(!isset($_REQUEST["shortcode"]) or !$_REQUEST["shortcode"]){

    ?>
    </div><!-- #content -->
    </section><!-- #primary -->

    <?php

    wp_reset_postdata();

    get_footer();
}else{

    global $post, $wp_query;
    $post = "";
    $wp_query->post = $post;
    $wp_query->posts = $post;
    $wp_query->post_count = 0;
}
