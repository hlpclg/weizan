<?php defined('IN_IA') or exit('Access Denied');?><div class="fe-panel-editor-title">单图设置<span class="tips">Tips:图片最低高度为40像素</span></div>
<div ng-repeat="picture in Edit.data" class="fe-panel-editor-relative">
    <div class="fe-panel-editor-del" title="移除" ng-click="delItemChild(Edit.id, picture.id)">×</div>
    <div class="fe-panel-editor-line2">
        <div class="fe-panel-editor-goodimg" ng-click="uploadImgChild(Edit.id, picture.id)">
            <img ng-src="{{picture.imgurl}}" width="100%" ng-show="picture.imgurl" />
            <div class="fe-panel-editor-goodimg-t1" ng-show="!picture.imgurl"><i class="fa fa-plus-circle"></i> 选择图片</div>
            <div class="fe-panel-editor-goodimg-t2" ng-show="picture.imgurl">重新选择图片</div>
        </div>
        <div class="fe-panel-editor-line2-right">
            <div class="fe-panel-editor-line">
                <div class="fe-panel-editor-name">链接地址</div>
                <div class="fe-panel-editor-con">
                    <input class="fe-panel-editor-input3"  value="" ng-model="picture.hrefurl" placeholder="请手动输入链接(请以http://开头)或选择系统链接" />
                    <div class="fe-panel-editor-input4" ng-click="chooseUrl(Edit.id, picture.id)">系统连接</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fe-panel-editor-sub1" ng-click="addItemChild('picture', Edit.id)"><i class="fa fa-plus-circle"></i> 添加一个单图</div>