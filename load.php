<?php
/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Andreas Gohr <gohr@cosmocode.de>
 */

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../../').'/');
define('NOSESSION',true);
require_once(DOKU_INC.'inc/init.php');
require_once(DOKU_INC.'inc/pageutils.php');
require_once(DOKU_INC.'inc/io.php');

$xmlid = $_REQUEST['xmlid'];
$cache = getcachename($md5,'graphgear');
$time = @filemtime($cache);
if(!$time){
    header("HTTP/1.0 404 Not Found");
    echo 'Not Found';
    exit;
}

header('Content-Type: text/xml; charset=utf-8');
header('Expires: '.gmdate("D, d M Y H:i:s", time()+max($conf['cachetime'], 3600)).' GMT');
header('Cache-Control: public, proxy-revalidate, no-transform, max-age='.max($conf['cachetime'], 3600));
header('Pragma: public');
http_conditionalRequest($time);
echo io_readFile($cache);

//Setup VIM: ex: et ts=4 enc=utf-8 :
