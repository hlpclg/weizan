<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<style>
	.pad-left {padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -545px;}
	.pad-bottom {padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -595px;}
	.add{cursor:pointer;padding-top:5px}
	.system{cursor:pointer}
</style>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active"><?php  if($do == 'display') { ?>菜单列表<?php  } else if($do == 'module') { ?>模块权限<?php  } ?></li>
</ol>
<ul class="nav nav-tabs">
	<li<?php  if($do == 'display') { ?> class="active"<?php  } ?>><a href="<?php  echo url('extension/menu');?>">菜单列表</a></li>
	<li<?php  if($do == 'module') { ?> class="active"<?php  } ?>><a href="<?php  echo url('extension/menu/module');?>">模块菜单</a></li>
</ul>
<div class="clearfix template">
	<h5 class="page-header">菜单列表</h5>
	<form action="" method="post" class="form-horizontal">
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i>
		系统内置的菜单不允许修改 "链接地址"，不允许切换 "显示状态", 不允许 "删除"
	</div>
	<div class="panel">
		<div class="panel-body table-responsive">
			<table class="table">
				<thead>
				<th width="80">排序</th>
				<th width="250">名称</th>
				<th width="100">标识</th>
				<th width="80">类型</th>
				<th width="180">权限标识</th>
				<th width="80">显示</th>
				<th width="100">系统</th>
				<th width="350">链接地址</th>
				<th width="160" style="text-align:center">子标题</th>
				<th width="300">子链接</th>
				<th width="120">操作</th>
				</thead>
				<tbody>
					<?php  if(is_array($menus)) { foreach($menus as $k => $v) { ?>
						<input type="hidden" name="id[]" value="<?php  echo $v['id'];?>">
						<input type="hidden" name="url[]" value="">
						<input type="hidden" name="append_url[]" value="">
						<input type="hidden" name="is_system[]" value="<?php  echo $v['is_system'];?>">
						<input type="hidden" name="permission_name[]" value="<?php  echo $v['permission_name'];?>">
						<tr>
							<td><input type="text" name="displayorder[]" value="<?php  echo $v['displayorder'];?>" class="form-control"></td>
							<td>
								<input type="text" class="form-control" style="width:120px;display:inline-block" name="title[]" value="<?php  echo $v['title'];?>">
							</td>
							<td><?php  echo $v['name'];?></td>
							<td></td>
							<td align="center">
								<div class="input-group">
									<input type="text" class="form-control" name="append_title[]" value="<?php  echo $v['append_title'];?>"/>
									<span class="input-group-addon"><i class="<?php  echo $v['append_title'];?>"></i></span>
									<span class="input-group-btn">
										<button class="btn btn-default showIconDialog" type="button">图标</button>
									</span>
								</div>
							</td>
							<td>
								<?php  if($v['is_display']) { ?>
								<span class="btn btn-success system" data-system="<?php  echo $v['is_system'];?>" data-id="<?php  echo $v['id'];?>" data-value="<?php  echo $v['is_display'];?>" title="点击切换">显示</span>
								<?php  } else { ?>
								<span class="btn btn-danger system" data-system="<?php  echo $v['is_system'];?>" data-id="<?php  echo $v['id'];?>" data-value="<?php  echo $v['is_display'];?>" title="点击切换">隐藏</span>
								<?php  } ?>
							</td>
							<td>
								<?php  if($v['is_system']) { ?> <span class="label label-danger">系统内置</span><?php  } else { ?> <span class="label label-success">自定义</span><?php  } ?>
							</td>
							<td></td><td></td><td></td>
							<td>
								<?php  if(!$v['is_system']) { ?>
									<a title="删除" href="<?php  echo url('extension/menu/del', array('id' => $v['id']))?>" onclick="if(!confirm('删除后不可恢复，确定删除?')) return false;" class="btn btn-danger">删除</a>
								<?php  } ?>
							</td>
						</tr>
						<?php  if(!empty($v['child'])) { ?>
							<?php  if(is_array($v['child'])) { foreach($v['child'] as $k1 => $v1) { ?>
							<input type="hidden" name="id[]" value="<?php  echo $v1['id'];?>"/>
							<input type="hidden" name="url[]" value="">
							<input type="hidden" name="append_url[]" value="">
							<input type="hidden" name="append_title[]" value="">
							<input type="hidden" name="is_system[]" value="<?php  echo $v1['is_system'];?>">
							<input type="hidden" name="permission_name[]" value="<?php  echo $v1['permission_name'];?>">
							<tr class="level1 p_<?php  echo $v1['pid'];?>">
								<td><input type="text" name="displayorder[]" value="<?php  echo $v1['displayorder'];?>" class="form-control"></td>
								<td>
									<div class="pad-left">&nbsp; <input type="text" style="width:120px;display:inline-block" name="title[]" value="<?php  echo $v1['title'];?>" class="form-control"> <i class="fa fa-chevron-down" data-id="<?php  echo $v1['id'];?>"> </i></div>
								</td>
								<td><?php  echo $v1['name'];?></td>
								<td></td>
								<td></td>
								<td>
									<?php  if($v1['is_display']) { ?>
									<span class="btn btn-success system" data-system="<?php  echo $v1['is_system'];?>" data-id="<?php  echo $v1['id'];?>" data-value="<?php  echo $v1['is_display'];?>" title="点击切换">显示</span>
									<?php  } else { ?>
									<span class="btn btn-danger system" data-system="<?php  echo $v1['is_system'];?>" data-id="<?php  echo $v1['id'];?>" data-value="<?php  echo $v1['is_display'];?>" title="点击切换">隐藏</span>
									<?php  } ?>
								</td>
								<td>
									<?php  if($v1['is_system']) { ?> <span class="label label-danger">系统内置</span><?php  } else { ?> <span class="label label-success">自定义</span><?php  } ?>
								</td>
								<td></td><td></td><td></td>
								<td>
									<?php  if(!$v1['is_system']) { ?>
									<a title="删除" href="<?php  echo url('extension/menu/del', array('id' => $v1['id']))?>" onclick="if(!confirm('删除后不可恢复，确定删除?')) return false;" class="btn btn-danger">删除</a>
									<?php  } ?>
								</td>
							</tr>
							<?php  if(!empty($v1['grandchild'])) { ?>
								<?php  if(is_array($v1['grandchild'])) { foreach($v1['grandchild'] as $k2 => $v2) { ?>
								<input type="hidden" name="id[]" value="<?php  echo $v2['id'];?>"/>
								<input type="hidden" name="is_system[]" value="<?php  echo $v2['is_system'];?>">
								<input type="hidden" name="permission_name[]" value="<?php  echo $v2['permission_name'];?>">
								<tr class="p_<?php  echo $v2['pid'];?> p_<?php  echo $v['id'];?>">
									<td><input type="text" name="displayorder[]" value="<?php  echo $v2['displayorder'];?>" class="form-control"></td>
									<td><div class="pad-left" style="margin-left:30px"> &nbsp; <input type="text" style="width:120px;display:inline-block" name="title[]" value="<?php  echo $v2['title'];?>" class="form-control"></div></td>
									<td><?php  echo $v2['name'];?></td>
									<td>
										<?php  if($v2['type'] == 'url') { ?>
										<span class="label label-success">菜单</span>
										<?php  } else { ?>
										<span class="label label-danger">权限验证</span>
										<?php  } ?>
									</td>
									<td><?php  echo $v2['permission_name'];?></td>
									<td>
										<?php  if($v2['is_display']) { ?>
										<span class="btn btn-success system" data-system="<?php  echo $v2['is_system'];?>" data-type="<?php  echo $v2['type'];?>" data-id="<?php  echo $v2['id'];?>" data-value="<?php  echo $v2['is_display'];?>" title="点击切换">显示</span>
										<?php  } else { ?>
										<span class="btn btn-danger system" data-system="<?php  echo $v2['is_system'];?>" data-type="<?php  echo $v2['type'];?>" data-id="<?php  echo $v2['id'];?>" data-value="<?php  echo $v2['is_display'];?>" title="点击切换">隐藏</span>
										<?php  } ?>
									</td>
									<td>
										<?php  if($v2['is_system']) { ?> <span class="label label-danger">系统内置</span><?php  } else { ?> <span class="label label-success">自定义</span><?php  } ?>
									</td>
									<?php  if(!$v2['is_system'] && $v2['type'] == 'url') { ?>
										<td><input type="text" name="url[]" value="<?php  echo $v2['url'];?>" class="form-control"></td>
										<td align="center">
											<div class="input-group">
												<input type="text" class="form-control" name="append_title[]" value="<?php  echo $v2['append_title'];?>"/>
												<span class="input-group-addon"><i class="<?php  echo $v2['append_title'];?>"></i></span>
												<span class="input-group-btn">
													<button class="btn btn-default showIconDialog" type="button">图标</button>
												</span>
											</div>
										</td>
										<td><input type="text" name="append_url[]" value="<?php  echo $v2['append_url'];?>" class="form-control"></td>
									<?php  } else { ?>
										<td colspan="3">
											<input type="hidden" name="url[]" value="<?php  echo $v2['url'];?>">
											<input type="hidden" name="append_url[]" value="<?php  echo $v2['append_url'];?>">
											<input type="hidden" name="append_title[]" value="<?php  echo $v2['append_title'];?>">
										</td>
									<?php  } ?>
									<td>
										<?php  if(!$v2['is_system']) { ?>
										<a title="删除" href="<?php  echo url('extension/menu/del', array('id' => $v2['id']))?>" onclick="if(!confirm('删除后不可恢复，确定删除?')) return false;" class="btn btn-danger">删除</a>
										<?php  } ?>
									</td>
								</tr>
								<?php  } } ?>
							<?php  } ?>
							<tr class="p_<?php  echo $v1['id'];?> p_<?php  echo $v['id'];?>">
								<td colspan="11">
									<div class="pad-bottom pull-left" style="margin-left:110px"></div>
									<div class="pull-left add add_level2" data-pid="<?php  echo $v1['id'];?>" data-name="<?php  echo $v['name'];?>"> &nbsp;&nbsp;<i class="fa fa-plus-circle"></i> 添加菜单</div>
									<div class="hide pull-left add add_permission" data-pid="<?php  echo $v1['id'];?>" data-name="<?php  echo $v['name'];?>"> &nbsp;&nbsp;<i class="fa fa-plus-circle"></i> 添加权限验证</div>
								</td>
							</tr>
						<?php  } } ?>
					<?php  } ?>
					<tr class="level1 p_<?php  echo $v['id'];?>">
						<td></td>
						<td colspan="10"><div class="pad-bottom pull-left"></div> <div class="pull-left add add_level1" data-pid="<?php  echo $v['id'];?>" data-name="<?php  echo $v['name'];?>"> &nbsp;&nbsp;<i class="fa fa-plus-circle"></i> 添加菜单组</div></td>
					</tr>
					<?php  } } ?>
					<tr>
						<td></td>
						<td colspan="9"><div class="add add_level0"><i class="fa fa-plus-circle"></i> 添加顶级分类</div></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1" />
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</div>
	</form>
</div>
<script>
	$(function(){
		$('.fa-chevron-down').click(function(){
			var id = $(this).attr('data-id');
			$('tr.p_' + id).slideToggle('fast');
		});
		$('.add_level0').click(function(){
			var pid = $(this).attr('data-pid');
			var name = $(this).attr('data-name');
			var html = '<tr>' +
					'<td><input type="text" name="add_parent_displayorder[]" value="0" class="form-control"></td>' +
					'<td> <input style="width:120px;" placeholder="名称" type="text" name="add_parent_title[]" value="" class="form-control"></td>' +
					'<td> <input style="width:80px;" placeholder="标识" type="text" name="add_parent_name[]" value="" class="form-control"></td>' +
					'<td></td>' +
					'<td>' +
						'<div class="input-group">' +
							'<input type="text" class="form-control" name="add_parent_append_title[]" value="fa fa-link"/>' +
							'<span class="input-group-addon"><i class="fa fa-link"></i></span>' +
							'<span class="input-group-btn">' +
								'<button class="btn btn-default showIconDialog" type="button">图标</button>' +
							'</span>' +
						'</div>' +
					'</td>' +
					'<td><i class="fa fa-times-circle" onclick="$(this).parents(\'tr\').remove()"></i></td>' +
					'<td colspan="5"></td>' +
					'</tr>';
			$(this).parents('tr').before(html)
		});

		$('.add_level1').click(function(){
			var pid = $(this).attr('data-pid');
			var name = $(this).attr('data-name');
			var html = '<tr class="level1 p_'+pid+'">' +
					'<td><input type="text" name="add_displayorder[]" value="0" class="form-control"></td>' +
					'<input type="hidden" name="add_pid[]" value="'+pid+'">' +
					'<input type="hidden" name="add_name[]" value="'+name+'">' +
					'<td><div class="pad-left"> &nbsp;&nbsp;<input style="width:120px;display:inline-block" type="text" name="add_title[]" value="" placeholder="菜单组名称" class="form-control"></div></td>' +
					'<td>'+name+'</td>' +
					'<td><i class="fa fa-times-circle" onclick="$(this).parents(\'tr\').remove()"></i></td><td></td><td></td>' +
					'<td colspan="5"></td>' +
					'</tr>';
			$(this).parents('tr').before(html)
		});

		$('.add_level2').click(function(){
			var pid = $(this).attr('data-pid');
			var name = $(this).attr('data-name');
			var html = '<tr class="level1 p_'+pid+'">' +
					'<input type="hidden" name="add_child_pid[]" value="'+pid+'">' +
					'<input type="hidden" name="add_child_name[]" value="'+name+'">' +
					'<td><input type="text" name="add_child_displayorder[]" value="0" class="form-control"></td>' +
					'<td><div class="pad-left" style="margin-left:30px"> &nbsp;&nbsp;<input style="width:120px;display:inline-block" type="text" name="add_child_title[]" value="" placeholder="菜单名称" class="form-control"></div></td>' +
					'<td>'+name+'</td>' +
					'<td></td>' +
					'<td><input type="text" name="add_child_permission[]" value="" class="form-control" placeholder="权限标识"></td>' +
					'<td colspan="2"></td>' +
					'<td><input type="text" name="add_child_url[]" value="" class="form-control" placeholder="菜单链接"></td>' +
					'<td>' +
						'<div class="input-group">' +
							'<input type="text" class="form-control" name="add_child_append_title[]" value="fa fa-link"/>' +
							'<span class="input-group-addon"><i class="fa fa-link"></i></span>' +
							'<span class="input-group-btn">' +
								'<button class="btn btn-default showIconDialog" type="button">图标</button>' +
							'</span>' +
						'</div>' +
					'</td>' +
					'<td><input type="text" name="add_child_append_url[]" value="" class="form-control" placeholder="子菜单链接"></td>' +
					'<td><i class="fa fa-times-circle" onclick="$(this).parents(\'tr\').remove()"></i></td>' +
					'</tr>';
			$(this).parents('tr').before(html)
		});

		$('.add_permission').click(function(){
			var pid = $(this).attr('data-pid');
			var name = $(this).attr('data-name');
			var html = '<tr class="level1 p_'+pid+'">' +
					'<input type="hidden" name="add_permission_pid[]" value="'+pid+'">' +
					'<input type="hidden" name="add_permission_flag[]" value="'+name+'">' +
					'<td><div class="pad-left" style="margin-left:30px"> &nbsp;&nbsp;<input style="width:120px;display:inline-block" type="text" name="add_permission_title[]" value="" placeholder="权限名称" class="form-control"></div></td>' +
					'<td>'+name+'</td>' +
					'<td><input type="text" name="add_permission_name[]" value="" placeholder="权限标识" class="form-control"></td>' +
					'<td><input type="text" name="add_permission_displayorder[]" value="" placeholder="排序" class="form-control"></td>' +
					'<td><i class="fa fa-times-circle" onclick="$(this).parents(\'tr\').remove()"></i></td><td></td><td></td>' +
					'<td colspan="4"></td>' +
					'</tr>';
			$(this).parents('tr').before(html)
		});


		require(['util'], function(u){
			$('.table').on('click', '.showIconDialog', function(){
				var btn = $(this);
				var spview = btn.parent().prev();
				var ipt = spview.prev();
				if(!ipt.val()){
					spview.css("display", "none");
				}
				u.iconBrowser(function(ico){
					ipt.val(ico);
					spview.show();
					spview.find("i").attr("class","");
					spview.find("i").addClass("fa").addClass(ico);
				});
			});
		});

		$('.system').click(function(){
			var id = $(this).attr('data-id');
			var value = $(this).attr('data-value');
			var system = $(this).attr('data-system');
			var type = $(this).attr('data-type');
			if(system == 1) {
				util.message('系统菜单不允许切换显示状态');
				return false;
			}
			if(type && type == 'permission') {
				util.message('权限标识只能隐藏');
				return false;
			}
			$.post("<?php  echo url('extension/menu/ajax')?>", {'id' : id, 'value' : value}, function(){
				location.reload();
				return false;
			});
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>
