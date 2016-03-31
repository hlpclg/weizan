<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<style>
.template .item{position:relative;display:block;float:left;border:1px #ddd solid;border-radius:5px;background-color:#fff;padding:5px;width:190px;margin:0 10px 10px 0;}
.template .title{margin:5px auto;line-height:2em;}
.template .title .theme-title {overflow:hidden; height:30px;}
.template .item img{width:178px;height:270px;}
.template .item.active img{width:178px;height:270px;border:3px #009cd6 solid;padding:1px;}
.template .fa{}
.template .fa.fa-times{display:inline-block;position:absolute;bottom:33px;right:6px;color:#FFF;background:#009CD6;padding:5px;font-size:14px;border-radius:0 0 6px 0;text-decoration:none}
.update-bg{width:178px; height:270px; background:#000; position:absolute; z-index:1; opacity:0.5; top:38px;}
.update-div{width:178px; height:270px; position:absolute; z-index:2; top:38px; text-align:center;}
.update-btn{position:relative; top:85px; display:inline-block; width: 60px; height:60px; text-align:center; line-height:60px; text-decoration:none; border-width:1px; border-style:solid; cursor:pointer;}
.template-form{position:absolute; z-index:2; bottom:38px; right:10px;}
</style>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('extension/theme-tabs', TEMPLATE_INCLUDEPATH)) : (include template('extension/theme-tabs', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix template">
	<?php  if($do == 'installed') { ?>
		<h5 class="page-header">已安装的微站模板</h5>
		<nav role="navigation" class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="javascript:;" class="navbar-brand">微站模板类型</a>
				</div>
				<ul class="nav navbar-nav nav-btns">
					<li <?php  if($_GPC['type'] == 'all' || empty($_GPC['type'])) { ?> class="active" <?php  } ?>>
						<a href="<?php  echo url('extension/theme/installed', array('type' => 'all'));?>">全部</a>
					</li>
					<?php  if(is_array($temtypes)) { foreach($temtypes as $type) { ?>
						<li <?php  if($_GPC['type'] == $type['name']) { ?> class="active" <?php  } ?>>
							<a href="<?php  echo url('extension/theme/installed', array('type' => $type['name']));?>"><?php  echo $type['title'];?></a>
						</li>
					<?php  } } ?>
				</ul>
			</div>
		</nav>
		<div id="batch-contain" style="clear:both;height:50px;line-height:50px;margin-top:-20px;display:none">
			<a href="<?php  echo url('extension/theme/upgrade', array('check' => 1, 'batch' => 1));?>" class="btn btn-primary">一键更新模板</a>
		</div>
		<?php  if(is_array($templates)) { foreach($templates as $item) { ?>
			<div class="item">
				<div class="title">
					<div class="theme-title"><?php  echo $item['title'];?> (<?php  echo $item['name'];?>)</div>
					<img src="../app/themes/<?php  echo $item['name'];?>/preview.jpg" class="img-rounded" />
					<span class="upgrade-label" theme="<?php  echo $item['name'];?>" version="<?php  echo $item['version'];?>"></span>
					<span class="hide-form" id="<?php  echo $item['name'];?>" style="display:none"></span>
				</div>
				<div class="btn-group  btn-group-justified">
					<a title="卸载" onclick="return confirm('确定卸载此模板吗？')" href="<?php  echo url('extension/theme/uninstall', array('id' => $item['id']))?>" class="btn btn-default btn-xs">卸载</a>
				</div>
			</div>
		<?php  } } ?>
		<script type="text/javascript">
			var upgrade = [];
			$.post('<?php  echo url('extension/theme/check');?>', {foo: 'upgrade'},function(dat){
				try {
					var ret = $.parseJSON(dat);
					$('.upgrade-label').each(function(){
						var n = $(this).attr('theme');
						var v = $(this).attr('version');
						if(ret[n]) {
							$('.hide-form[id="' + n + '"]').html('<span class="label label-warning template-form">来自云平台安装</span>').show();
							if(ret[n].version > v) {
								upgrade.push(n);
								$(this).html('<div class="img-rounded update-bg"></div><div class="update-div"><a href="<?php  echo url('extension/theme/upgrade')?>&templateid=' + n + '" class="btn-danger img-circle update-btn" title="来自系统云服务更新">更新</a></div>');
							}
						}
					});
					if(upgrade.length > 0) {
						$('#batch-contain').show();
					}
				} catch(err) {}
			});
		</script>
	<?php  } ?>
	<?php  if($do == 'prepared') { ?>
		<h5 class="page-header">已购买的微站模板</h5>
		<div class="form clearfix" ng-controller="listInstallThemes">
			<div class="item" id="templates-{{m.name}}" ng-repeat="m in templates">
				<div class="title">
					<div class="theme-title">{{m.title}} ({{m.name}})</div>
					<img src="<?php echo ADDONS_URL;?>/resource/attachment/{{m.logo}}" class="img-rounded" />
				</div>
				<div class="btn-group  btn-group-justified">
					<a  href="<?php  echo url('extension/theme/install')?>templateid={{m.name.toLowerCase()}}" class="btn btn-default btn-xs">安装</a>
				</div>
			</div>
		</div>
		<?php  if($uninstallTemplates) { ?>
			<div class="form">
				<h5 class="page-header">未安装的微站模板(本地模板)</h5>
			</div>
		
			<div class="alert alert-info form-horizontal" style="display:none" id="install-info">
				<dl class="dl-horizontal">
					<dt>整体进度</dt>
					<dd id="pragress"></dd>
					<dt>正在安装的模板</dt>
					<dd id="m_name"></dd>
				</dl>
				<dl class="dl-horizontal" style="display:none">
					<dt>安装失败的模板</dt>
					<dd>
						<p class="text-danger" id="fail" style="margin:0;"></p>
					</dd>
				</dl>
			</div>
	
			<?php  if(is_array($uninstallTemplates)) { foreach($uninstallTemplates as $item) { ?>
				<div class="item" id="templates-<?php  echo $item['name'];?>">
					<div class="title">
						<div class="theme-title"><?php  echo $item['title'];?> (<?php  echo $item['name'];?>)</div>
						<img src="../app/themes/<?php  echo $item['name'];?>/preview.jpg" class="img-rounded" />
					</div>
					<div class="btn-group  btn-group-justified">
						<a  href="<?php  echo url('extension/theme/install', array('templateid' => $item['name']))?>" class="btn btn-default btn-xs">安装</a>
					</div>
				</div>
			<?php  } } ?>
			<div style="clear:both;height:50px;line-height:50px">
				<span class="btn btn-primary" id="batch-install">一键安装所有本地模板</span>
			</div>
		<?php  } else { ?>
			<div class="form">
				<h5 class="page-header">未安装的微站模板(本地模板)</h5>
				<div class="alert alert-danger">
					目前没有未安装的本地模板
				</div>
			</div>
		<?php  } ?>
		<script type="text/javascript">
			require(['angular'], function(angular){
				angular.module('app', []).controller('listInstallThemes', function($scope, $http) {
					$.post('<?php  echo url('extension/theme/check');?>', {foo: 'install'},function(dat){
						try {
							var ret = $.parseJSON(dat);
							if(!$.isArray(ret)) {
								return;
							}
							$.each(ret, function(){
								$('div.item[templates-name=' + this.name + ']').remove();
							});
							$scope.$apply(function(){
								$scope.templates = ret;
							});
						} catch(err) {}
					});
				});
				angular.bootstrap(document, ['app']);
				//处理批量安装模块
				var templates = <?php  echo $prepare_templates;?>;
				var templates_title = <?php  echo $prepare_templates_title;?>;
				var total = templates.length;
				
				var i = 1;
				var fail = [];
				var success = [];
						
				var insta = function(){
					var m_name = templates.pop();
					if(!m_name) {
						util.message('本次成功安装' + success.length + '个模板.<br>安装失败' + fail.length + '个模板', "<?php  echo url('extension/theme/installed')?>", 'info');
						return;
					}
					var pragress = i + '/' + total;
					$('#m_name').html(templates_title[m_name]);
					$('#pragress').html(pragress);
				
					$.post("<?php  echo url('extension/theme/batch-install')?>", {'templateid' : m_name}, function(data){
						if(data == 'success') {
							i++;
							$('#templates-' + m_name).slideUp();
							success.push(templates_title[m_name]);
							setTimeout(function(){insta()}, 2000);
						} else {
							i++;
							fail.push(templates_title[m_name]);
							$('#fail').html(fail.join('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')).parent().parent().show();
							setTimeout(function(){insta()}, 2000);
						}
					});
	
				}
				
				$('#batch-install').click(function(){
					$('#install-info').show();
					insta();
				});
			});
		</script>
	<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>
