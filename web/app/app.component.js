var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var core_1 = require('@angular/core');
var router_1 = require('@angular/router');
var hero_service_1 = require('./hero.service');
var crondServer_service_1 = require("./service/crondServer.service");
var cronTab_service_1 = require("./service/cronTab.service");
var operLog_service_1 = require("./service/operLog.service");
var AppComponent = (function () {
    function AppComponent() {
        this.title = 'Tour of Heroes';
    }
    AppComponent = __decorate([
        core_1.Component({
            selector: 'my-app',
            template: "\n    \n    <nav style=\"display: none;\">\n      <a [routerLink]=\"['/dashboard']\" routerLinkActive=\"active\">Dashboard</a>\n      <a [routerLink]=\"['/heroes']\" routerLinkActive=\"active\">Heroes</a>\n      <a [routerLink]=\"['/crondservers']\" routerLinkActive=\"active\">Cronds</a>\n    </nav>\n    <router-outlet></router-outlet>\n  ",
            styleUrls: ['app/app.component.css'],
            directives: [router_1.ROUTER_DIRECTIVES],
            providers: [
                hero_service_1.HeroService,
                crondServer_service_1.CrondServerService,
                cronTab_service_1.CronTabService,
                operLog_service_1.OperLogService
            ]
        })
    ], AppComponent);
    return AppComponent;
})();
exports.AppComponent = AppComponent;
/*
Copyright 2016 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/ 
//# sourceMappingURL=app.component.js.map