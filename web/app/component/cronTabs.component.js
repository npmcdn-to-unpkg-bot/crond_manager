var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
/**
 * Created by Administrator on 2016/7/1.
 */
var core_1 = require('@angular/core');
var CronTabsComponent = (function () {
    function CronTabsComponent(cronService, crondSvrService, route) {
        this.cronService = cronService;
        this.crondSvrService = crondSvrService;
        this.route = route;
        this.cronTabs = [];
        this.tags = [];
        this.selectedTag = null;
        this.searchKey = '';
        this.error = null;
        this.navigated = false;
        this.svrId = null;
        this.selectedAll = false;
        this.editModel = {}; //当前编辑对象
        this.scriptsList = []; //脚本文件列表
        this.scriptContent = ''; //脚本文件内容
        this.crondServerInfo = null;
    }
    CronTabsComponent.prototype.ngOnInit = function () {
        var _this = this;
        //this.cronTabs = this.cronService.getCronTabs();
        this.sub = this.route.params.subscribe(function (params) {
            if (params['id'] !== undefined) {
                var id = +params['id'];
                _this.svrId = id;
                _this.navigated = true;
                _this.cronService.getCronTabs(id, '', '')
                    .then(function (r) { return _this.cronTabs = r; });
                _this.cronService.getTags(id)
                    .then(function (r) { return _this.tags = (r == null || r.length == 0) ? [] : r; });
                _this.crondSvrService.getCrondScripts(id)
                    .then(function (r) { return _this.scriptsList = r; });
            }
            else {
                _this.navigated = false;
                _this.cronTabs = [];
            }
        });
    };
    CronTabsComponent.prototype.filter = function () {
        var _this = this;
        var tag = this.selectedTag ? this.selectedTag.tag : {};
        var key = this.searchKey;
        this.cronService.getCronTabs(this.svrId, tag, key)
            .then(function (r) { return _this.cronTabs = r; });
    };
    CronTabsComponent.prototype.ngOnDestroy = function () {
        this.sub.unsubscribe();
    };
    CronTabsComponent.prototype.onSelectTag = function (tag) {
        this.selectedTag = tag;
        this.searchKey = '';
        this.filter();
    };
    CronTabsComponent.prototype.onSelectScript = function () {
        var _this = this;
        var file = document.getElementById('idCronFile').value;
        this.crondSvrService.getCrondScriptContent(this.svrId, file)
            .then(function (r) { return _this.scriptContent = r; });
    };
    CronTabsComponent.prototype.selectAll = function () {
        var m = this;
        this.cronTabs.forEach(function (o) {
            o.selected = !m.selectedAll;
        });
    };
    CronTabsComponent.prototype.enable = function () {
        var ids = this.getSelectedIds();
        this.cronService.enable(ids);
    };
    CronTabsComponent.prototype.disable = function () {
        var ids = this.getSelectedIds();
        this.cronService.disable(ids);
    };
    CronTabsComponent.prototype.delete = function () {
        var ids = this.getSelectedIds();
        this.cronService.deleteByIds(ids);
    };
    CronTabsComponent.prototype.getSelectedIds = function () {
        var ids = [];
        this.cronTabs.forEach(function (o) {
            if (o.selected === true) {
                console.info(o.id);
                ids.push(o.id);
            }
        });
        console.info(JSON.stringify(ids));
        return ids;
    };
    CronTabsComponent.prototype.openModel = function ($model) {
        this.editModel = $model;
    };
    CronTabsComponent.prototype.saveModel = function () {
        this.cronService.save(this.editModel);
    };
    CronTabsComponent = __decorate([
        core_1.Component({
            selector: 'my-crontabs',
            templateUrl: 'app/template/cronTabs.component.html',
            styleUrls: ['css/tools/app.component.css']
        })
    ], CronTabsComponent);
    return CronTabsComponent;
})();
exports.CronTabsComponent = CronTabsComponent;
//# sourceMappingURL=cronTabs.component.js.map