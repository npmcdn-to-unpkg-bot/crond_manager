import { Component }          from '@angular/core';
import { ROUTER_DIRECTIVES }  from '@angular/router';

import { HeroService }        from './hero.service';
import {CrondServerService} from "./service/crondServer.service";
import {CronTabService} from "./service/cronTab.service";

@Component({
  selector: 'my-app',

  template: `
    
    <nav style="display: none;">
      <a [routerLink]="['/dashboard']" routerLinkActive="active">Dashboard</a>
      <a [routerLink]="['/heroes']" routerLinkActive="active">Heroes</a>
      <a [routerLink]="['/crondservers']" routerLinkActive="active">Cronds</a>
    </nav>
    <router-outlet></router-outlet>
  `,
  styleUrls: ['app/app.component.css'],
  directives: [ROUTER_DIRECTIVES],
  providers: [
    HeroService,
      CrondServerService,
      CronTabService
  ]
})
export class AppComponent {
  title = 'Tour of Heroes';
}


/*
Copyright 2016 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/