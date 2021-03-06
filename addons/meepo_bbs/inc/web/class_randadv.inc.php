<?php /*折翼天使资源社区 www.zheyitianshi.com*/
global $_W,$_GPC;

$typeid = $_GPC['typeid'];

if(empty($typeid)){
	message('请先选择分类');
}

load()->func('tpl');
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
	$lists = pdo_fetchall("SELECT * FROM " . tablename('meepo_bbs_adv') . " WHERE uniacid = '{$_W['uniacid']}' AND typeid = '{$typeid}' ORDER BY displayorder DESC");
	foreach ($lists as $li){
		$sql = "SELECT name FROM ".tablename('meepo_bbs_threadclass')." WHERE typeid = :typeid";
		$params = array(':typeid'=>$li['typeid']);
		$li['typetitle'] = pdo_fetchcolumn($sql,$params);
		$list[] = $li;
	}
} elseif ($operation == 'post') {
	$id = intval($_GPC['id']);
	if (checksubmit('submit')) {
		$data = array(
				'uniacid' => $_W['uniacid'],
				'advname' => $_GPC['advname'],
				'link' => $_GPC['link'],
				'enabled' => intval($_GPC['enabled']),
				'displayorder' => intval($_GPC['displayorder']),
				'thumb'=>$_GPC['thumb'],
				'typeid'=>$typeid
		);
		if (!empty($id)) {
			pdo_update('meepo_bbs_adv', $data, array('id' => $id));
		} else {
			pdo_insert('meepo_bbs_adv', $data);
			$id = pdo_insertid();
		}
		message('更新幻灯片成功！', $this->createWebUrl('class_randadv', array('op' => 'display','typeid'=>$typeid)), 'success');
	}
	$adv = pdo_fetch("select * from " . tablename('meepo_bbs_adv') . " where id=:id and uniacid=:weid limit 1", array(":id" => $id, ":weid" => $_W['uniacid']));
} elseif ($operation == 'delete') {
	$id = intval($_GPC['id']);
	pdo_delete('meepo_bbs_adv', array('id' => $id));
	message('广告删除成功！', $this->createWebUrl('class_randadv', array('op' => 'display','typeid'=>$typeid)), 'success');
} else {
	message('请求方式不存在');
}

include $this->template('class_randadv');