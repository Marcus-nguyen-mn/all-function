<?php
/**
 * Plugin Name: Plugin Save Parameters Cookie
 * Plugin URI: https://vienthammydiva.vn/
 * Description: Plugin created by Marcus(Nam Nguyen) - Diva IT Team
 * Version: 1.0
 * Author: Nam Nguyen
 * Author URI: https://wolfactive.dev/
 * License: GPLv2
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {die( 'Invalid request, please check your plugin dir path. ');}
function getCurURL(){
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL = "https://";
    } else {
      $pageURL = 'http://';
    }
    if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
        // $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
function marcus_cookie(){
  $url = getCurURL();
  $url_components = parse_url($url);
  parse_str($url_components['query'], $params);
?>
  <script>
      jQuery(document).ready(function(){
        checkCookie();
      });
      function Replace(valcookie) {
        var pathName = window.location.pathname;
        var hostname = window.location.hostname;
        var linkPath = pathName + hostname
            location.replace(linkPath + '?' + valcookie);
       }
      function setCookie(cname,cvalue) {
        var d = new Date();
        d.setTime(d.getTime() + (60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
      function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      }
      function updateURLParameter(url, param){
       	var newAdditionalURL = "";
       	var tempArray = url.split("?");
       	var baseURL = tempArray[0];
       	var additionalURL = tempArray[1];
       	var temp = "";
       	var rows_txt = temp + "" + param;
       	return baseURL + rows_txt;
       }
      function checkCookie(){
        var divaCookie=getCookie("mcDivaCookie");
        var mcCookie = window.location.search;
        var divaCookieNew = mcCookie;
        if(divaCookieNew != divaCookie && divaCookieNew != ''){
          window.history.replaceState('', '', updateURLParameter(window.location.href, divaCookieNew));
          setCookie("mcDivaCookie", divaCookieNew);
        }else if(divaCookieNew == '' || divaCookieNew == null){
          window.history.replaceState('', '', updateURLParameter(window.location.href, divaCookie));
        }else if(divaCookieNew != '' && divaCookie == ''){
          window.history.replaceState('', '', updateURLParameter(window.location.href, divaCookieNew));
          setCookie("mcDivaCookie", divaCookieNew);
        }
      }
  </script>
<?php
}
add_action( 'wp_footer', 'marcus_cookie' );
?>
