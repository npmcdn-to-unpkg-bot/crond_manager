import { Injectable }    from '@angular/core';
import { Headers, Http, Request,RequestMethod } from '@angular/http';
import 'rxjs/add/operator/toPromise';

import { Hero } from './hero';
import {OperLogModel} from "../model/operLogModel";

@Injectable()
export class OperLogService {

    private getLogUrl = '/index.php?r=tools/get-oper-logs';

    constructor(private http: Http) { }

    getLogs(key): Promise<OperLogModel[]>{
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        return this.http.get(this.getLogUrl+"&key="+key,headers)
            .toPromise()
            .then(r=> r.json());
    }


    private handleError(error: any) {
        console.error('An error occurred', error);
        return Promise.reject(error.message || error);
    }
}


/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */