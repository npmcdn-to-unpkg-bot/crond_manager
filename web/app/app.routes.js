var router_1 = require('@angular/router');
var dashboard_component_1 = require('./dashboard.component');
var heroes_component_1 = require('./heroes.component');
var hero_detail_component_1 = require('./hero-detail.component');
var crondServer_component_1 = require("./component/crondServer.component");
var cronTabs_component_1 = require("./component/cronTabs.component");
var operLog_component_1 = require("./component/operLog.component");
exports.routes = [
    {
        path: '',
        redirectTo: '/crondservers',
        terminal: true
    },
    {
        path: 'dashboard',
        component: dashboard_component_1.DashboardComponent
    },
    {
        path: 'detail/:id',
        component: hero_detail_component_1.HeroDetailComponent
    },
    {
        path: 'heroes',
        component: heroes_component_1.HeroesComponent
    },
    {
        path: 'crondservers',
        component: crondServer_component_1.CrondServerComponent
    },
    {
        path: 'crontabs/:id',
        component: cronTabs_component_1.CronTabsComponent
    },
    {
        path: 'operlogs',
        component: operLog_component_1.OperLogComponent
    }
];
exports.APP_ROUTER_PROVIDERS = [
    router_1.provideRouter(exports.routes)
];
/*
Copyright 2016 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/ 
//# sourceMappingURL=app.routes.js.map