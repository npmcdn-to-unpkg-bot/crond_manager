/**
 * Created by Administrator on 2016/7/1.
 */
import { Component, OnInit } from '@angular/core';

import{CronTabModel} from '../model/cronTabModel';
import{CronTabService} from '../service/cronTab.service';
import {HeroService} from "../hero.service";

@Component({
    selector: 'my-crontabs',
    templateUrl: 'template/tools/cronTabs/cronTabs.component.html',
    styleUrls: ['css/tools/app.component.css']
})

export class CronTabsComponent implements OnInit{
    cronTabs = [];
    error = null;
    constructor(
        private cronService: CronTabService
    ) {debugger
    }

    ngOnInit(){
        //this.cronTabs = this.cronService.getCronTabs();
debugger
        this.cronService
            .getCronTabs()
            .then(r => this.cronTabs = r)
            .catch(error => this.error = error);
    }
}