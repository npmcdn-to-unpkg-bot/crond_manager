/**
 * Created by Administrator on 2016/6/28.
 */
import { Component, OnInit } from '@angular/core';
import { Router }           from '@angular/router-deprecated';

import{CronTabModel} from '../model/cronTabModel';
import{CronTabService} from '../service/cronTab.service';
import {HeroService} from "../hero.service";

@Component({
    selector: 'my-crontabs',
    templateUrl: 'template/tools/cronTabs/cronTabs.component.html',
    styleUrls: ['css/tools/dashboard.component.css']
})

export class CronTabComponent implements OnInit{
    cronTabs = [];
    error = null;
    constructor(
        private router: Router,
        private cronService: CronTabService
    ) {
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