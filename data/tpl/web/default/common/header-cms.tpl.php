<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php  if(isset($title)) $_W['page']['title'] = $title?><?php  if(!empty($_W['page']['title'])) { ?><?php  echo $_W['page']['title'];?> - <?php  } ?><?php  if(empty($_W['page']['copyright']['sitename'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>微赞<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['sitename'];?><?php  } ?></title>
	<meta name="keywords" content="<?php  if(empty($_W['page']['copyright']['keywords'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>微赞<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['keywords'];?><?php  } ?>" />
	<meta name="description" content="<?php  if(empty($_W['page']['copyright']['description'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>微赞<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['description'];?><?php  } ?>" />
<script src="./resource/weidongli/js/html5.js"></script>
	<link rel="stylesheet" type="text/css" href="./resource/weidongli/css/cs.css" />
	<link rel="stylesheet" type="text/css" href="./resource/weidongli/css/donban.css" />
	<link rel="stylesheet" type="text/css" href="./resource/weidongli/css/page-good.css" />
	<link href="./resource/weidongli/css/style.css" rel="stylesheet" type="text/css" />
	<script src="./resource/weidongli/js/index.js" type="text/javascript"></script>
	<script type="text/javascript" src="./resource/weidongli/js/jquery.min.js"></script>
			<!--[if IE 6]>
	<script src="./resource/weidongli/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script>
  DD_belatedPNG.fix('#index img');
  DD_belatedPNG.fix('#headbgg img');
  DD_belatedPNG.fix('#footerLogo img');
</script>
<![endif]-->
	<script type="text/javascript">
  jq = jQuery.noConflict();
//以后jquery中的$都用jq代替即可。
jq(function(){});
</script>
 <!--[if IE]>
<style type="text/css">
.color-block {
background:transparent;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#4B7D0000,endColorstr=#4B7D0000);
zoom: 1;
}
</style>
<![endif]-->

</head>

<body id="nv_portal" class="pg_index" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<div id="workpop"></div>
<div class="index" id="index">

<div class="headbg">
<div class="head" id="headbgg">
<div class="mo" style=" left:-200px; padding-top:15px; position:absolute">
</div>
<h1 class="logo" <?php  if(!empty($_W['setting']['copyright']['flogo'])) { ?>style="background:url('<?php  echo tomedia($_W['setting']['copyright']['flogo']);?>') no-repeat;"<?php  } else { ?>style="background:url('./resource/images/logo.png') no-repeat;"<?php  } ?>></h1>
<div class="nav" id="nav">
<ul >
				<li class="active" onClick="navmove('#index','0')"><a href="javascript:void(0);" title="网站首页">网站首页</a></li>
				<li onClick="navmove('#services','1')"><a href="./#services" title="功能介绍">功能介绍</a></li>
				<li onClick="navmove('#about','3')"><a href="<?php  echo url('article/news-show/list');?>">新闻动态</a></li>
				<li onClick="navmove('#services','2')"><a href="<?php  echo url('article/case-show/list');?>">客户案例</a></li>
                <li onClick="navmove('#login','4')"><a href="<?php  echo url('user/login');?>" title="登陆">会员登陆</a></li>
				<li onClick="navmove('#login','4')"><a href="<?php  echo url('user/register');?>" title="注册">会员注册</a></li>            
			</ul>
		</div>
	</div>
</div>