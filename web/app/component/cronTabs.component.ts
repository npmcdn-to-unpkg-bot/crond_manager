/**
 * Created by Administrator on 2016/7/1.
 */
import { Component, EventEmitter, Input, OnInit, OnDestroy, Output } from '@angular/core';

import { ActivatedRoute } from '@angular/router';

import{CronTabModel} from '../model/cronTabModel';
import{CronTabService} from '../service/cronTab.service';

@Component({
    selector: 'my-crontabs',
    templateUrl: 'app/template/cronTabs.component.html',
    styleUrls: ['css/tools/app.component.css']
})

export class CronTabsComponent implements OnInit{
    cronTabs = [];
    error = null;
    sub: any;
    navigated = false;
    constructor(
        private cronService: CronTabService,
        private route: ActivatedRoute
    ) {
    }

    ngOnInit(){
        //this.cronTabs = this.cronService.getCronTabs();
        this.sub = this.route.params.subscribe(params => {
            if (params['id'] !== undefined) {
                let id = +params['id'];
                this.navigated = true;
                this.cronService.getCronTabs(id)
                    .then(r => this.cronTabs = r);
            } else {
                this.navigated = false;
                this.cronTabs = [];
            }
        });
    }

    ngOnDestroy() {
        this.sub.unsubscribe();
    }
}