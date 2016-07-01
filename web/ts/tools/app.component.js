var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var core_1 = require('@angular/core');
var router_deprecated_1 = require('@angular/router-deprecated');
var dashboard_component_1 = require('./dashboard.component');
var heroes_component_1 = require('./heroes.component');
var hero_detail_component_1 = require('./hero-detail.component');
var hero_service_1 = require('./hero.service');
var cronTabs_component_1 = require('./component/cronTabs.component');
var cronTab_service_1 = require('./service/cronTab.service');
var AppComponent = (function () {
    function AppComponent() {
        this.title = 'Tour of Heroes0';
    }
    AppComponent = __decorate([
        core_1.Component({
            selector: 'my-app',
            template: "\n    <h1>{{title}}</h1>\n    <nav>\n      <a [routerLink]=\"['Dashboard']\">Dashboard</a>\n      <a [routerLink]=\"['Heroes']\">Heroes</a>\n      <a [routerLink]=\"['CronTabs']\">CronTabs</a>\n    </nav>\n    <router-outlet></router-outlet>\n  ",
            styleUrls: ['css/tools/app.component.css'],
            directives: [router_deprecated_1.ROUTER_DIRECTIVES],
            providers: [
                router_deprecated_1.ROUTER_PROVIDERS,
                hero_service_1.HeroService,
                cronTab_service_1.CronTabService
            ]
        }),
        router_deprecated_1.RouteConfig([
            { path: '/dashboard', name: 'Dashboard', component: dashboard_component_1.DashboardComponent },
            { path: '/detail/:id', name: 'HeroDetail', component: hero_detail_component_1.HeroDetailComponent },
            { path: '/heroes', name: 'Heroes', component: heroes_component_1.HeroesComponent },
            { path: '/contabs', name: 'CronTabs', component: cronTabs_component_1.CronTabComponent, useAsDefault: true }
        ])
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