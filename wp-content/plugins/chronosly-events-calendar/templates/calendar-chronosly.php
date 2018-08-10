<?php

//$timezone = date_default_timezone_get();
//ini_set('date.timezone', 'UTC');
//date_default_timezone_set("UTC");
// ini_set('date.timezone', $timezone);
// date_default_timezone_set($timezone);
$timezone = date_default_timezone_get();
$offset = intval(get_option("gmt_offset"));

if($offset >= 0) $offset = "-".$offset;
else $offset = "+".substr($offset, 1);
date_default_timezone_set("Etc/GMT$offset");

$anio = get_query_var("y");
if(!$anio and isset($_REQUEST["y"])) $anio = $_REQUEST["y"];
if(!$anio or $anio < 0 or $anio == "current") $anio = date("Y");
$mes = get_query_var("mo");
if(!$mes and isset($_REQUEST["mo"])) $mes = $_REQUEST["mo"];
if($mes == "current") $mes = date("n");
$week = get_query_var("week");
if(!$week and isset($_REQUEST["week"])) $week = $_REQUEST["week"];
if($week == "current") $week = date("W");



$calendar_url = Post_Type_Chronosly_Calendar::get_permalink();
if(stripos($calendar_url, "?") === FALSE ) $calendar_url1 = $calendar_url."?";
else $calendar_url1 = $calendar_url."&";




if(!$_REQUEST["js_render"] and !$_REQUEST["action"]) {
    if(!isset($_REQUEST["shortcode"]) or !$_REQUEST["shortcode"])  get_header();
    if(!isset($_REQUEST["shortcode"]) or !$_REQUEST["shortcode"])  {

        ?>
        <section id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
    <?php
    }
    echo '<div class="chronosly-closure">';

    $params = "";
    foreach($_REQUEST as $k=>$r){
        if($k == "y") $r = $anio;
        else if($k == "mo") $r = $mes;
        else if($k == "week") $r = $week;
        if($k != "page_id" and $k != "p" and $k != "ch_code" and $k != "post_type" and $k != "chronosly" ) $params .= "&$k=$r";
    }
    $calendarId = rand();
    echo "<script> jQuery( document ).ready(function(){
                        var url =  '$calendar_url1".substr($params,1)."&js_render=1';
                        ch_load_calendar(url, ".$calendarId.");
                    });
         </script>";

    echo "<div class='ch_js_loader id$calendarId'></div>";
    echo "</div>"; //close chronosly closure

    if(!isset($_REQUEST["shortcode"]) or !$_REQUEST["shortcode"])  {

        ?>
        </div><!-- #content -->
        </section><!-- #primary -->

    <?php
    }

    if(!isset($_REQUEST["shortcode"]) or !$_REQUEST["shortcode"])  {

        get_footer();
    }


} else {
    $calendarId = $_REQUEST["calendarid"];

    $query = Post_Type_Chronosly_Calendar::get_events_by_date($anio, $mes, $week);
    $repeated = Post_Type_Chronosly_Calendar::get_events_repeated_by_date($anio, $mes, $week);
    $settings =  unserialize(get_option("chronosly-settings"));
    $calendar = $settings["chronosly_calendar_template_default"];
    if(isset($_REQUEST["small"]) and $_REQUEST["small"]) $calendar .=" small";



    echo "<div class='chronosly-calendar-block'>";
    // echo "<pre>";print_r($query);
    if(!$_REQUEST["shortcode"] or ($_REQUEST["shortcode"] and $_REQUEST["before_events"])) do_action("chronosly-before-events", $stilo);
    echo "<div class='chronosly-content-block' style='".$stilo.";clear:both;'>";

    if($_REQUEST["from"]){
        echo "<div style='display:none'>
            <div class='ch_from'>".$_REQUEST["from"]."</div>
            <div class='ch_to'>".$_REQUEST["to"]."</div>
            <input type='hidden' name='y' value='$anio'/>
            <input type='hidden' name='mo' value='$mes'/>
            <input type='hidden' name='w' value='$week'/>
        </div>";
    }

        $back = __($Post_Type_Chronosly->settings["chronosly-event-list-title"],"chronosly");
       if(!$Post_Type_Chronosly->settings["chronosly_hide_navigation_title"]) {
        ?>
         <div class="ch-header">
        <?php
        if($Post_Type_Chronosly->settings["chronosly-event-list-url"]){ ?>
            <a href="<?php  echo $Post_Type_Chronosly->settings["chronosly-event-list-url"];?>" class="back"><i class="fa fa-chevron-left"></i> <?php echo $back; ?></a>

        <?php } else { ?>
            <a href="<?php  echo (get_option('permalink_structure')?get_post_type_archive_link( 'chronosly' ):get_site_url()."/index.php?post_type=chronosly") ;?>" class="back"><i class="fa fa-chevron-left"></i> <?php echo $back; ?></a>
        <?php } ?>
        <div>
        <?php }

    if(isset($Post_Type_Chronosly->template)) $template = $Post_Type_Chronosly->template;
    else $template = new Chronosly_Templates();

    $template->templates_tabs("dad1", 1);

    $hide1 = $hide2 = "";
    if($Post_Type_Chronosly->settings["chronosly_hide_navigation_calendar_left"]) $hide1 = "hidde";
    if($Post_Type_Chronosly->settings["chronosly_hide_navigation_calendar_right"]) $hide2 = "hidde";




                $days = Post_Type_Chronosly_Calendar::get_days_by_date($anio, $mes, $week, $query, $repeated);

                            // echo "<pre>";print_r($days);
                $events = $repeats = array();
                $type = "year";
                $week_in_sunday = 0;
                if($Post_Type_Chronosly->settings["chronosly_week_start"] == 1) $week_in_sunday = 1;
                if($mes) $type = "month";
                else if($week) $type = "week";
                $i = $mi = 0;
                $m = array(__("January"), __("February"),__("March"), __("April"),__("May"), __("June"),__("July"),__("August"),__("September"),__("October"),__("November"),__("December"));
                if($week_in_sunday) $d = array(__("Sun"), __("Mon"),__("Tue"), __("Wed"),__("Thu"), __("Fri"),__("Sat"));
                else  $d = array( __("Mon"),__("Tue"), __("Wed"),__("Thu"), __("Fri"),__("Sat"),__("Sun"));
                $slug = $Post_Type_Chronosly->settings['chronosly-calendar-slug'];
                $params = "&js_render=1&before_events=1";
                foreach($_REQUEST as $k=>$r){
                    if($k != "y" and $k != "mo" and $k != "week" and $k != "ch_code") $params .= "&$k=$r";
                }
                // $params = str_replace(array('"', ' ', '\\\\"'),array('\"', '','\"'), $params);


                // echo "Etc/GMT$offset";
                // print_r(date_default_timezone_get());
                switch($type){
                    case "year":
                        if($anio == date("Y"))$mes = date("n");
                        else $mes = date("n", strtotime($anio));
                        if($anio == date("Y")) $week =date("W", strtotime($anio."-".$mes."-".date("d")));
                        else $week = date("W", strtotime($anio."-".$mes));
                        echo "<div class='chronosly-cal year ch-$calendar'>";
                        if(!isset($_REQUEST["shortcode"])){
                            echo "<div class='ch-navigate'>
                                <span class='ch-current'>$anio</span>
                                <span class='ch-links $hide1'>
                                     <a href='".(get_option('permalink_structure')?$calendar_url."year_".($anio+1)."/":"index.php?post_type=chronosly_calendar&y=".($anio+1))."' class='ch-next'><div class='arrow-up'></div>".($anio+1)."</a>
                                     <a href='".(get_option('permalink_structure')?$calendar_url."year_".($anio-1)."/":"index.php?post_type=chronosly_calendar&y=".($anio-1))."' class='ch-prev'><div class='arrow-down'></div>".($anio-1)."</a>
                                 </span>


                            <div class='ch-navigate-type $hide2'>
                                <a href='".(get_option('permalink_structure')?$calendar_url."year_".date("Y"):"index.php?post_type=chronosly_calendar&y=".date("Y"))."' >".__("today", "chronosly")."</a>
                                <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/":"index.php?post_type=chronosly_calendar&y=$anio")."' class='ch-current'>".__("year", "chronosly")."</a>
                                <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/month_$mes":"index.php?post_type=chronosly_calendar&y=$anio&mo=$mes")."' >".__("month", "chronosly")."</a>
                                <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/week_$week":"index.php?post_type=chronosly_calendar&y=$anio&week=$week")."' >".__("week", "chronosly")."</a>


                          </div>
                        </div>
                         ";
                        } else {
                            echo "<div class='ch-navigate'>
                                <span class='ch-current'>$anio</span>
                                <span class='ch-links $hide1'>
                                     <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".($anio+1)."$params\", $calendarId)' class='ch-next'><div class='arrow-up'></div>".($anio+1)."</a>
                                     <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".($anio-1)."$params\", $calendarId)' class='ch-prev'><div class='arrow-down'></div>".($anio-1)."</a>
                                 </span>


                            <div class='ch-navigate-type $hide2'>
                                <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".date("Y")."$params\", $calendarId)' >".__("today", "chronosly")."</a>
                                <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio$params\", $calendarId)' class='ch-current'>".__("year", "chronosly")."</a>
                                <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio&mo=$mes$params\", $calendarId)' >".__("month", "chronosly")."</a>
                                <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio&week=$week$params\", $calendarId)' >".__("week", "chronosly")."</a>


                          </div>
                        </div>
                         ";
                        }
                        if(!isset($_REQUEST["shortcode"])){
                            echo "<div class='ch-frame'>
                                    <div class='ch-month'>
                                        <div class='m_tit'><span class='back'>< </span><a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/month_1":"index.php?post_type=chronosly_calendar&y=$anio&mo=1")."'>".$m[0]."</a></div>";
                        } else {
                            echo "<div class='ch-frame'>
                                    <div class='ch-month'>
                                        <div class='m_tit'><span class='back'>< </span><a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio&mo=1$params\", $calendarId)'>".$m[0]."</a></div>";

                        }
                                 echo "<div class='m_names'>";
                        ++$mi;
                        foreach($d as $n) echo "<span>".$n."</span>";
                        echo "</div>";
                        echo "<div class='m_grid'><div class='ch-line'>";

                        foreach($days as $day=>$ev){
                            ++$i;
                            if(date("n",strtotime($day)) == $mi+1){ //is new month
                                echo "</div></div></div>";
                                if(!isset($_REQUEST["shortcode"])){
                                    echo "<div class='ch-month'><div class='m_tit'><span class='back'>< </span><a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/month_".($mi+1):"index.php?post_type=chronosly_calendar&y=$anio&mo=".($mi+1))."'>".$m[$mi]."</a><span class='mday'></span></div>";
                                } else {
                                    echo "<div class='ch-month'><div class='m_tit'><span class='back'>< </span><a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio&mo=".($mi+1)."$params\", $calendarId)'>".$m[$mi]."</a><span class='mday'></span></div>";
                                }
                                echo "<div class='m_names'>";
                                foreach($d as $n) echo "<span>".$n."</span>";
                                echo "</div>";
                                echo "<div class='m_grid'><div class='ch-line'>";
                                for($j = 0;$j < ($i-1)%7;++$j){
                                    echo "<div class='ch-foot no_show' ></div>";
                                }
                                $mi++;

                            }
                            //hide days from other year
                            $c = "";
                            if(is_array($ev)) $c = "withevents";
                            echo "<div  class='ch-content $c' >";
                            $cont = "";
                            $cant = 0;
                            if(is_array($ev)){ //print the calendar view template for each event
                                ksort($ev);
                                $cont = "with_events";
                                foreach($ev as $e){
                                    ++$cant;
                                    $xid = 0;
                                    if(is_array($e)){
                                        // print_r($e);
                                        $xid = $ide =  $e["id"];
                                        if(isset($repeats[$xid])) $ide .= "_".$repeats[$xid];
                                        $evs = array("id" => $ide,"start" => $e["start"], "end" => $e["end"]);
                                        if($e["h"] && $e["eh"]) $evs = array("id" => $ide, "start" => $e["start"], "end" => $e["end"], "h" => $e["h"], "m" => $e["m"], "eh" => $e["eh"], "em" => $e["em"]);
                                        $template->print_template($e["id"], "dad3", "", "", "front", $evs);
                                    }
                                    else {
                                        $xid = $e;
                                        $template->print_template($e, "dad3", "", "", "front");
                                    }
                                    if(isset($repeats[$xid])) ++$repeats[$xid];
                                    else $repeats[$xid] = 1;


                                }
                            }
                            if(date("Y",strtotime($day)) != $anio ) $cont .= " no_show";
                            if(date("d-m-Y", strtotime($day)) == date("d-m-Y") ) $cont .= " today";
                            echo "</div><div class='ch-foot $cont'";
                            if($cant) echo "title='".__("view")." +$cant'";
                            echo "><div class='cont2'>".date_i18n("j",strtotime($day))."</div></div>";

                            if($i%7 == 0 and date("n",strtotime($day)) == $mi) echo "</div><div class='ch-line'>";//is new week

                        }
                        echo "</div></div></div></div>";

                        echo "</div>";

                    break;
                    case "month":
                        echo "<div class='chronosly-cal ch-month ch-$calendar'>";
                        if($anio == date("Y")) $week = date("W", strtotime($anio."-".$mes."-".date("d")));
                        else $week = date("W", strtotime($anio."-".$mes));
                        $next = strtotime($anio."-".$mes." +1 month");
                        $prev = strtotime($anio."-".$mes." -1 month");

                        if(!isset($_REQUEST["shortcode"])){
                            echo "<div class='ch-navigate'>
                                <span class='ch-current'>".__(date("F", strtotime($anio."-".$mes))).", $anio</span>
                                 <span class='ch-links $hide1'>
                                     <a href='".(get_option('permalink_structure')?$calendar_url."year_".date("Y", $next)."/month_".date("n", $next):"index.php?post_type=chronosly_calendar&y=".date("Y", $next)."&mo=".date("n", $next))."' class='ch-next'><div class='arrow-up'></div>".__(date("F", $next)).", ".date("Y", $next)."</a>
                                    <a href='".(get_option('permalink_structure')?$calendar_url."year_".date("Y", $prev)."/month_".date("n", $prev):"index.php?post_type=chronosly_calendar&y=".date("Y", $prev)."&mo=".date("n", $prev))."' class='ch-prev'><div class='arrow-down'></div>".__(date("F", $prev)).", ".date("Y", $prev)."</a>
                                </span>


                               <div class='ch-navigate-type $hide2'>
                                    <a href='".(get_option('permalink_structure')?$calendar_url."year_".date("Y")."/month_".date("n"):"index.php?post_type=chronosly_calendar&y=".date("Y")."&mo=".date("n"))."' >".__("today", "chronosly")."</a>

                                        <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio":"index.php?post_type=chronosly_calendar&y=$anio")."' >".__("year", "chronosly")."</a>
                                        <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/month_$mes":"index.php?post_type=chronosly_calendar&y=$anio&mo=$mes")."' class='ch-current' >".__("month", "chronosly")."</a>

                                        <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/week_$week":"index.php?post_type=chronosly_calendar&y=$anio&week=$week")."' >".__("week", "chronosly")."</a>

                                  </div>
                          </div>
                          ";
                        } else {
                            echo "<div class='ch-navigate'>
                                <span class='ch-current'>".__(date("F", strtotime($anio."-".$mes))).", $anio</span>
                                 <span class='ch-links $hide1'>
                                     <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".date("Y", $next)."&mo=".date("n", $next)."$params\", $calendarId)' class='ch-next'><div class='arrow-up'></div>".__(date("F", $next)).", ".date("Y", $next)."</a>
                                    <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".date("Y", $prev)."&mo=".date("n", $prev)."$params\", $calendarId)' class='ch-prev'><div class='arrow-down'></div>".__(date("F", $prev)).", ".date("Y", $prev)."</a>
                                </span>


                               <div class='ch-navigate-type $hide2'>
                                    <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".date("Y")."&mo=".date("n").", $calendarId)' >".__("today", "chronosly")."</a>

                                        <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio$params\", $calendarId)' >".__("year", "chronosly")."</a>
                                        <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio&mo=$mes$params\", $calendarId)' class='ch-current' >".__("month", "chronosly")."</a>

                                        <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio&week=$week$params\", $calendarId)' >".__("week", "chronosly")."</a>

                                  </div>
                          </div>
                          ";
                        }

                        echo "<div class='m_names'>";
                        foreach($d as $n) echo "<span>".$n."</span>";
                        echo "</div>";
                        echo "<div class='m_grid'><div class='ch-line'>";
                        // print_r($days);
                        foreach($days as $day=>$ev){
                            $cont = "";
                            if(is_array($ev)) $cont = "with_events";
                            if(date("n",strtotime($day)) != $mes ) $cont .= " no_show";

                            if(date("d-m-Y", strtotime($day)) == date("d-m-Y") ) $cont .= " today";
                            echo "<div class='ch-content $cont'>";
                            if(is_array($ev)){
                                ksort($ev);

                                echo "<div class='cont'>";
                                foreach($ev as $e){
                                    $xid = 0;
                                    if(is_array($e)){
                                        $xid = $ide =  $e["id"];
                                       if(isset($repeats[$xid])) $ide .= "_".$repeats[$xid];
                                       // echo $e["start"];
                                        $evs = array("id" => $ide,"start" => $e["start"], "end" => $e["end"]);
                                        if($e["h"] && $e["eh"]) $evs = array("id" => $ide, "start" => $e["start"], "end" => $e["end"], "h" => $e["h"], "m" => $e["m"], "eh" => $e["eh"], "em" => $e["em"]);
                                        $template->print_template($e["id"], "dad3", "", "", "front", $evs);
                                    }
                                    else {
                                        $xid = $e;
                                        $template->print_template($e, "dad3", "", "", "front");
                                    }
                                    if(isset($repeats[$xid])) ++$repeats[$xid];
                                    else $repeats[$xid] = 1;

                                }
                                echo "</div>";
                            }
                            if(count($ev)) $cont1 = __("view+", "chronosly")." ".count($ev);


                            echo "<div class='ch-foot'><div class='cont1'>$cont1</div><div class='cont11'>".__("close", "chronosly")."</div><div class='cont2'>".date_i18n("j",strtotime($day))."</div></div></div>";
                            ++$i;

                            if($i%7 == 0) echo "</div><div class='ch-line'>";

                        }
                        echo "</div></div>";

                        echo "</div>";

                    break;
                    case "week":
                       echo "<div class='chronosly-cal week  ch-$calendar'>";
                        $w =strtotime($anio."W".str_pad($week, 2, '0', STR_PAD_LEFT));
                        $next =$next1 = strtotime($anio."W".str_pad($week, 2, '0', STR_PAD_LEFT)." +1 week");
                        $prev = $prev1 = strtotime($anio."W".str_pad($week, 2, '0', STR_PAD_LEFT)." -1 week");


                        if($settings["chronosly_week_start"] == 1) {
                            $w -= (60*60*24);
                            $next -= (60*60*24);
                            $prev -= (60*60*24);
                        }
                        $mes = date("n", $w);
                        if(!isset($_REQUEST["shortcode"])){
                            $tit = "";
                            if(date("d", $w) > date("d", strtotime("+6 day",$w))) $tit = __(substr(date("F", $w), 0, 3))." ";
                            $tit .= date("d", $w)." - ".date("d", strtotime("+6 day",$w))." ";
                            if(date("d", $w) > date("d", strtotime("+6 day",$w))) $tit .= __(substr(date("F", strtotime("+6 day",$w)), 0, 3));
                            else $tit .= __(date("F", strtotime("+6 day",$w)));
                            echo "<div class='ch-navigate'>
                            <div class='cal-left'>
                                <span class='ch-current'>".$tit.", $anio</span>
                                <span class='ch-links $hide1'>";
                                    if(date("W", $next1) < 10) echo "<a href='".(get_option('permalink_structure')?$calendar_url."year_".date("Y", strtotime("+6 day",$next1))."/week_".date("W", $next1):"index.php?post_type=chronosly_calendar&y=".date("Y", strtotime("+6 day",$next))."&week=".date("W", $next1))."' class='ch-next'><div class='arrow-up'></div>".date("d", $next)." - ".date("d", strtotime("+6 day", $next))." ".__(date("F", strtotime("+6 day", $next))).", ".date("Y", strtotime("+6 day", $next))."</a>";
                                    else echo "<a href='".(get_option('permalink_structure')?$calendar_url."year_".date("Y", $next1)."/week_".date("W", $next1):"index.php?post_type=chronosly_calendar&y=".date("Y", $next)."&week=".date("W", $next1))."' class='ch-next'><div class='arrow-up'></div>".date("d", $next)." - ".date("d", strtotime("+6 day", $next))." ".__(date("F", strtotime("+6 day", $next))).", ".date("Y", strtotime("+6 day", $next))."</a>";
                                    echo "<a href='".(get_option('permalink_structure')?$calendar_url."year_".date("Y", $prev)."/week_".date("W", $prev1):"index.php?post_type=chronosly_calendar&y=".date("Y", $prev)."&week=".date("W", $prev1))."' class='ch-prev'><div class='arrow-down'></div>".date("d", $prev)." - ".date("d", strtotime("+6 day", $prev))." ".__(date("F", $prev)).", ".date("Y", $prev)."</a>
                                </span></div>
                                <div class='ch-navigate-type cal-right $hide2'>
                                    <a href='".(get_option('permalink_structure')?$calendar_url."year_".date("Y")."/week_".date("W"):"index.php?post_type=chronosly_calendar&y=".date("Y")."&week=".date("W"))."' >".__("today", "chronosly")."</a>
                                    <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio":"index.php?post_type=chronosly_calendar&y=$anio")."' >".__("year", "chronosly")."</a>
                                    <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/month_$mes":"index.php?post_type=chronosly_calendar&y=$anio&mo=$mes")."' >".__("month", "chronosly")."</a>
                                    <a href='".(get_option('permalink_structure')?$calendar_url."year_$anio/week_$week":"index.php?post_type=chronosly_calendar&y=$anio&week=$week")."' class='ch-current'>".__("week", "chronosly")."</a>

                                 </div>
                             </div>
                            ";
                         } else {
                            echo "<div class='ch-navigate'>
                                <span class='ch-current'>".date("d", $w)." - ".date("d", strtotime("+6 day",$w))." ".__(date("F", strtotime("+6 day",$w))).", $anio</span>
                                <span class='ch-links $hide1'>";
                                   if(date("W", $next1) < 10) echo "<a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".date("Y", strtotime("+6 day",$next))."&week=".date("W", $next1)."$params\", $calendarId)' class='ch-next'><div class='arrow-up'></div>".date("d", $next)." - ".date("d", strtotime("+6 day", $next))." ".__(date("F", strtotime("+6 day", $next))).", ".date("Y", strtotime("+6 day", $next))."</a>";
                                    else echo "<a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".date("Y",$next)."&week=".date("W", $next1)."$params\", $calendarId)' class='ch-next'><div class='arrow-up'></div>".date("d", $next)." - ".date("d", strtotime("+6 day", $next))." ".__(date("F", strtotime("+6 day", $next))).", ".date("Y", strtotime("+6 day", $next))."</a>";
                                    echo "<a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".date("Y", $prev)."&week=".date("W", $prev1)."$params\", $calendarId)' class='ch-prev'><div class='arrow-down'></div>".date("d", $prev)." - ".date("d", strtotime("+6 day", $prev))." ".__(date("F", $prev)).", ".date("Y", $prev)."</a>
                                </span>
                                <div class='ch-navigate-type $hide2'>
                                    <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=".date("Y")."&week=".date("W")."$params\", $calendarId)' >".__("today", "chronosly")."</a>
                                    <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio$params\", $calendarId)' >".__("year", "chronosly")."</a>
                                    <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio&mo=$mes$params\", $calendarId)' >".__("month", "chronosly")."</a>
                                    <a href='javascript:ch_load_calendar(\"". (stripos($calendar_url, "?") !== FALSE?"$calendar_url":"$calendar_url?"). "&y=$anio&week=$week$params\", $calendarId)' class='ch-current'>".__("week", "chronosly")."</a>

                                 </div>
                             </div>
                            ";
                        }
                        echo "<div class='m_names'>";
                        foreach($d as $n) echo "<span>".$n."</span>";
                        echo "</div>";
                        echo "<div class='m_grid'><div class='line'>";
                        $i = 0;
                        foreach($days as $day=>$ev){
                            $cont = "";
                            if(is_array($ev)) $cont = "with_events";
                            if(date("d-m-Y", strtotime($day)) == date("d-m-Y") ) $cont .= " today";
                            echo "<div class='ch-content $cont'>";
                            if(is_array($ev)){
                                ksort($ev);

                                echo "<div class='cont'>";
                                foreach($ev as $e){
                                    $xid = 0;
                                    if(is_array($e)){
                                        $xid = $ide =  $e["id"];
                                       if(isset($repeats[$xid])) $ide .= "_".$repeats[$xid];
                                        $evs = array("id" => $ide,"start" => $e["start"], "end" => $e["end"]);
                                        if($e["h"] && $e["eh"]) $evs = array("id" => $ide, "start" => $e["start"], "end" => $e["end"], "h" => $e["h"], "m" => $e["m"], "eh" => $e["eh"], "em" => $e["em"]);
                                        $template->print_template($e["id"], "dad3", "", "", "front", $evs);
                                    }
                                    else {
                                        $xid = $e;
                                        $template->print_template($e, "dad3", "", "", "front");
                                    }
                                    if(isset($repeats[$xid])) ++$repeats[$xid];
                                    else $repeats[$xid] = 1;

                                }
                                echo "</div>";
                            }


                            echo "<div class='ch-foot'><div class='cont1'>".$d[$i]."</div><div class='cont2'>".date_i18n("j",strtotime($day))."</div></div></div>";

                            ++$i;
                        }
                        echo "</div></div>";

                        echo "</div>";

                    break;

                }
                // date_default_timezone_set($timezone);

    if(!$_REQUEST["shortcode"] or ($_REQUEST["shortcode"] and $_REQUEST["after_events"])) do_action("chronosly-after-events");
    echo "</div>"; //close chronosly block
    echo "</div>"; //close chronosly clanedar block

    wp_reset_postdata();


}

date_default_timezone_set($timezone);
