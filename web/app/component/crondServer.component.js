var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
/**
 * Created by Administrator on 2016/6/28.
 */
var core_1 = require('@angular/core');
var CrondServerComponent = (function () {
    function CrondServerComponent(router, cronService) {
        this.router = router;
        this.cronService = cronService;
        this.crondServers = [];
        this.error = null;
    }
    CrondServerComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.cronService
            .getCrondServers()
            .then(function (r) { return _this.crondServers = r; })
            .catch(function (error) { return _this.error = error; });
    };
    CrondServerComponent.prototype.gotoDetail = function (model) {
        this.router.navigate(['/crontabs', model.id]);
    };
    CrondServerComponent.prototype.viewOperLog = function () {
        this.router.navigate(['/operlogs']);
    };
    CrondServerComponent = __decorate([
        core_1.Component({
            selector: 'my-crontabs',
            templateUrl: 'app/template/crondServer.component.html',
            styleUrls: ['css/tools/app.component.css']
        })
    ], CrondServerComponent);
    return CrondServerComponent;
})();
exports.CrondServerComponent = CrondServerComponent;
//# sourceMappingURL=crondServer.component.js.map