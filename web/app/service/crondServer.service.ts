/**
 * Created by Administrator on 2016/7/1.
 */
import { Injectable }    from '@angular/core';
import { Headers, Http} from '@angular/http';
import 'rxjs/add/operator/toPromise';

import {CrondServerModel} from "../model/crondServerModel";

@Injectable()
export class CrondServerService {

    private cronUrl = '/index.php?r=tools/get-crondservers';
    private getCrondScriptUrl = '/index.php?r=tools/get-crond-scripts';
    private getCrondScriptContentUrl = '/index.php?r=tools/get-crond-script-content';
    constructor(private http: Http) { }

    getCrondServers(): Promise<CrondServerModel[]>{

        let headers = new Headers();
        headers.append('Content-Type', 'application/json');
        let tmp = [];
        return this.http.get(this.cronUrl, headers)
            .toPromise()
            .then(r=> r.json());
    }

    getCrondScripts($id): Promise<string[]>{

        let headers = new Headers();
        headers.append('Content-Type', 'application/json');
        let tmp = [];
        return this.http.get(this.getCrondScriptUrl+"&id="+$id, headers)
            .toPromise()
            .then(r=> r.json());
    }
    getCrondScriptContent(id,file):Promise<string>{
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');
        let tmp = [];
        return this.http.get(this.getCrondScriptContentUrl+"&id="+id+"&file="+file, headers)
            .toPromise()
            .then(r=> r.json());
    }

    getServersNum(){
        return 123;
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