var http_1 = require('@angular/http');
require('rxjs/add/operator/toPromise');
var CronTabService = (function () {
    function CronTabService(http) {
        this.http = http;
        this.heroesUrl = 'app/heroes'; // URL to web api
    }
    CronTabService.prototype.getHeroes = function () {
        return this.http.get(this.heroesUrl)
            .toPromise()
            .then(function (response) { return response.json().data; })
            .catch(this.handleError);
    };
    CronTabService.prototype.getHero = function (id) {
        return this.getHeroes()
            .then(function (heroes) { return heroes.filter(function (hero) { return hero.id === id; })[0]; });
    };
    CronTabService.prototype.save = function (hero) {
        if (hero.id) {
            return this.put(hero);
        }
        return this.post(hero);
    };
    CronTabService.prototype.delete = function (hero) {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        var url = this.heroesUrl + "/" + hero.id;
        return this.http
            .delete(url, headers)
            .toPromise()
            .catch(this.handleError);
    };
    // Add new Hero
    CronTabService.prototype.post = function (hero) {
        var headers = new http_1.Headers({
            'Content-Type': 'application/json' });
        return this.http
            .post(this.heroesUrl, JSON.stringify(hero), { headers: headers })
            .toPromise()
            .then(function (res) { return res.json().data; })
            .catch(this.handleError);
    };
    // Update existing Hero
    CronTabService.prototype.put = function (hero) {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        var url = this.heroesUrl + "/" + hero.id;
        return this.http
            .put(url, JSON.stringify(hero), { headers: headers })
            .toPromise()
            .then(function () { return hero; })
            .catch(this.handleError);
    };
    CronTabService.prototype.handleError = function (error) {
        console.error('An error occurred', error);
        return Promise.reject(error.message || error);
    };
    return CronTabService;
})();
exports.CronTabService = CronTabService;
/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */ 
//# sourceMappingURL=cronTab.service.js.map