import { Injectable }    from '@angular/core';
import { Headers, Http, Request,RequestMethod } from '@angular/http';
import 'rxjs/add/operator/toPromise';

import { Hero } from './hero';
import {CronTabModel} from "../model/cronTabModel";

@Injectable()
export class CronTabService {

    private heroesUrl = 'app/heroes';  // URL to web api
    private cronUrl = '/index.php?r=tools/get-crontabs';
    private getTagUrl = '/index.php?r=tools/get-tags';
    private enableUrl = '/index.php?r=tools/enable';
    private disableUrl='/index.php?r=tools/disable';
    private deleteUrl='/index.php?r=tools/delete';
    private deleteByIdsUrl = '/index.php?r=tools/delete-by-ids';
    private saveCronTabUrl = '/index.php?r=tools/save-cron-tab';
    private getScriptsFiles = '/index.php?r=cron-file/get-scripts';
    private getScriptsFileContent = '/index.php?r=cron-file/get-script-content';
    constructor(private http: Http) { }

    getCronTabs(id, tag, key): Promise<CronTabModel[]>{
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        return this.http.get(this.cronUrl+"&id="+id+"&tag="+tag+"&key="+key,headers)
            .toPromise()
            .then(r=> r.json());
    }

    getTags(id): Promise<string[]>{
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');
        let tmp = [];
        return this.http.get(this.getTagUrl+"&id="+id,headers)
            .toPromise()
            .then(r=> r.json());
    }

    getScripts($host):Promise<string[]>{
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');
        return this.http.get($host+this.getScriptsFiles, headers)
            .toPromise()
            .then(r=>r.json()['data']);
    }

    enable(ids){
        let sIds = JSON.stringify(ids);
        return this.http.get(this.enableUrl+"&ids="+sIds)
            .toPromise()
            .then(r=> r.json());
    }
    disable(ids){
        let sIds = JSON.stringify(ids);
        return this.http.get(this.disableUrl+"&ids="+sIds)
            .toPromise()
            .then(r=> r.json());
    }
    deleteByIds(ids){
        let sIds = JSON.stringify(ids);
        return this.http.get(this.deleteByIdsUrl+"&ids="+sIds)
            .toPromise()
            .then(r=> r.json());
    }
    save(model){
        let headers = new Headers();
        headers.append('Content-Type', 'multipart/form-data');
        return this.http
            .post(this.saveCronTabUrl, JSON.stringify(model), {headers: headers})
            .toPromise()
            .then(res => res.json().data)
            .catch(this.handleError);
    }



    getHeroes(): Promise<Hero[]> {
        return this.http.get(this.heroesUrl)
            .toPromise()
            .then(response => response.json().data)
            .catch(this.handleError);
    }

    getHero(id: number) {
        return this.getHeroes()
            .then(heroes => heroes.filter(hero => hero.id === id)[0]);
    }

    saveHero(hero: Hero): Promise<Hero>  {
        if (hero.id) {
            return this.put(hero);
        }
        return this.post(hero);
    }

    delete(hero: Hero) {
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        let url = `${this.heroesUrl}/${hero.id}`;

        return this.http
            .delete(url, headers)
            .toPromise()
            .catch(this.handleError);
    }

    // Add new Hero
    private post(hero: Hero): Promise<Hero> {
        let headers = new Headers({
            'Content-Type': 'application/json'});

        return this.http
            .post(this.heroesUrl, JSON.stringify(hero), {headers: headers})
            .toPromise()
            .then(res => res.json().data)
            .catch(this.handleError);
    }

    // Update existing Hero
    private put(hero: Hero) {
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        let url = `${this.heroesUrl}/${hero.id}`;

        return this.http
            .put(url, JSON.stringify(hero), {headers: headers})
            .toPromise()
            .then(() => hero)
            .catch(this.handleError);
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