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
var CronTabDetailComponent = (function () {
    function CronTabDetailComponent(cronService) {
        this.cronService = cronService;
        this.cronTabs = [];
        this.error = null;
    }
    CronTabDetailComponent.prototype.ngOnInit = function () {
        //this.cronTabs = this.cronService.getCronTabs();
        var _this = this;
        this.cronService
            .getCronTabs()
            .then(function (r) { return _this.cronTabs = r; })
            .catch(function (error) { return _this.error = error; });
    };
    CronTabDetailComponent = __decorate([
        core_1.Component({
            selector: 'my-crontabs',
            templateUrl: 'template/tools/cronTabs/crondServer.component.html',
            styleUrls: ['css/tools/app.component.css']
        })
    ], CronTabDetailComponent);
    return CronTabDetailComponent;
})();
exports.CronTabDetailComponent = CronTabDetailComponent;
//# sourceMappingURL=cronTab.detail.component.js.map