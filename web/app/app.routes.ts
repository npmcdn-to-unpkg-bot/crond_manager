import { provideRouter, RouterConfig }  from '@angular/router';

import { DashboardComponent } from './dashboard.component';
import { HeroesComponent } from './heroes.component';
import { HeroDetailComponent } from './hero-detail.component';
import {CrondServerComponent} from "./component/crondServer.component";
import {CronTabsComponent} from "./component/cronTabs.component";
import {OperLogComponent} from "./component/operLog.component";

export const routes: RouterConfig = [
  {
    path: '',
    redirectTo: '/crondservers',
    terminal: true
  },
  {
    path: 'dashboard',
    component: DashboardComponent
  },
  {
    path: 'detail/:id',
    component: HeroDetailComponent
  },
  {
    path: 'heroes',
    component: HeroesComponent
  }  ,
  {
    path: 'crondservers',
    component: CrondServerComponent,

  },
  {
    path: 'crontabs/:id',
    component: CronTabsComponent,

  },
  {
    path:'operlogs',
    component:OperLogComponent
  }
];

export const APP_ROUTER_PROVIDERS = [
  provideRouter(routes)
];


/*
Copyright 2016 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/