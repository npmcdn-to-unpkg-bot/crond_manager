/**
 * Created by Administrator on 2016/7/1.
 */
import { Component, EventEmitter, Input, OnInit, OnDestroy, Output } from '@angular/core';

import { ActivatedRoute } from '@angular/router';

import{OperLogModel} from '../model/operLogModel';
import{OperLogService} from '../service/operLog.service';

@Component({
    selector: 'my-crontabs',
    templateUrl: 'app/template/cronTabs.component.html',
    styleUrls: ['css/tools/app.component.css']
})

export class OperLogComponent implements OnInit{
    logs = [];
    searchKey='';
    sub: any;

    constructor(
        private cronService: OperLogService,
        private route: ActivatedRoute
    ) {
    }

    ngOnInit(){
        //this.cronTabs = this.cronService.getCronTabs();
        this.sub = this.route.params.subscribe(params => {
            this.cronService.getLogs('')
                .then(r => this.logs = r);
        });
    }

    filter(){
        let key = this.searchKey;
        this.cronService.getLogs( key)
            .then(r=>this.logs = r);
    }

    ngOnDestroy() {
        this.sub.unsubscribe();
    }

}