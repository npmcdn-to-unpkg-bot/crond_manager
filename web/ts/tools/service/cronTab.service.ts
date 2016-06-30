import { Injectable }    from '@angular/core';
import { Headers, Http, Request,RequestMethod } from '@angular/http';
import 'rxjs/add/operator/toPromise';

import { Hero } from './hero';
import {CronTabModel} from "../model/cronTabModel";

@Injectable()
export class CronTabService {

    private heroesUrl = 'app/heroes';  // URL to web api
    private cronUrl = '/index.php?r=tools/get-crontabs';
    constructor(private http: Http) { }

    getCronTabs(): Promise<CronTabModel[]>{
debugger;
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');
        let tmp = [];
        return this.http.get(this.cronUrl, headers)
            .toPromise()
            .then(r=> r.json());
debugger;
        return tmp;
        let data = [
            {id: 11, name: 'Mr. Nice'},
            {id: 12, name: 'Narco'},
        ];
        return data;
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

    save(hero: Hero): Promise<Hero>  {
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