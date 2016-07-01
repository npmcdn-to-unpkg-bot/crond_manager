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
    function CronTabsComponent(cronService, route) {
        this.cronService = cronService;
        this.route = route;
        this.cronTabs = [];
        this.error = null;
        this.navigated = false;
    }
    CronTabsComponent.prototype.ngOnInit = function () {
        var _this = this;
        //this.cronTabs = this.cronService.getCronTabs();
        this.sub = this.route.params.subscribe(function (params) {
            if (params['id'] !== undefined) {
                var id = +params['id'];
                _this.navigated = true;
                _this.cronService.getCronTabs(id)
                    .then(function (r) { return _this.cronTabs = r; });
            }
            else {
                _this.navigated = false;
                _this.cronTabs = [];
            }
        });
    };
    CronTabsComponent.prototype.ngOnDestroy = function () {
        this.sub.unsubscribe();
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