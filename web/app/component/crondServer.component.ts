/**
 * Created by Administrator on 2016/6/28.
 */
import { Component, OnInit } from '@angular/core';
import { Router }            from '@angular/router';

import{CrondServerService} from '../service/crondServer.service';

@Component({
    selector: 'my-crontabs',
    templateUrl: 'app/template/crondServer.component.html',
    styleUrls: ['css/tools/app.component.css']
})

export class CrondServerComponent implements OnInit{
    crondServers = [];
    error = null;
    constructor(
        private router: Router,
        private cronService: CrondServerService
    ) {
    }

    ngOnInit(){
        this.cronService
            .getCrondServers()
            .then(r => this.crondServers = r)
            .catch(error => this.error = error);
    }

    gotoDetail(model) {
        this.router.navigate(['/crontabs', model.id]);
    }

    viewOperLog(){
        this.router.navigate(['/operlogs']);
    }
}