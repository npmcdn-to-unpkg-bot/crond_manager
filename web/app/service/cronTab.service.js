var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var core_1 = require('@angular/core');
var http_1 = require('@angular/http');
require('rxjs/add/operator/toPromise');
var CronTabService = (function () {
    function CronTabService(http) {
        this.http = http;
        this.heroesUrl = 'app/heroes'; // URL to web api
        this.cronUrl = '/index.php?r=tools/get-crontabs';
        this.getTagUrl = '/index.php?r=tools/get-tags';
        this.enableUrl = '/index.php?r=tools/enable';
        this.disableUrl = '/index.php?r=tools/disable';
        this.deleteUrl = '/index.php?r=tools/delete';
        this.deleteByIdsUrl = '/index.php?r=tools/delete-by-ids';
        this.saveCronTabUrl = '/index.php?r=tools/save-cron-tab';
        this.getScriptsFiles = '/index.php?r=cron-file/get-scripts';
        this.getScriptsFileContent = '/index.php?r=cron-file/get-script-content';
    }
    CronTabService.prototype.getCronTabs = function (id, tag, key) {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        return this.http.get(this.cronUrl + "&id=" + id + "&tag=" + tag + "&key=" + key, headers)
            .toPromise()
            .then(function (r) { return r.json(); });
    };
    CronTabService.prototype.getTags = function (id) {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        var tmp = [];
        return this.http.get(this.getTagUrl + "&id=" + id, headers)
            .toPromise()
            .then(function (r) { return r.json(); });
    };
    CronTabService.prototype.getScripts = function ($host) {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        return this.http.get($host + this.getScriptsFiles, headers)
            .toPromise()
            .then(function (r) { return r.json()['data']; });
    };
    CronTabService.prototype.enable = function (ids) {
        var sIds = JSON.stringify(ids);
        return this.http.get(this.enableUrl + "&ids=" + sIds)
            .toPromise()
            .then(function (r) { return r.json(); });
    };
    CronTabService.prototype.disable = function (ids) {
        var sIds = JSON.stringify(ids);
        return this.http.get(this.disableUrl + "&ids=" + sIds)
            .toPromise()
            .then(function (r) { return r.json(); });
    };
    CronTabService.prototype.deleteByIds = function (ids) {
        var sIds = JSON.stringify(ids);
        return this.http.get(this.deleteByIdsUrl + "&ids=" + sIds)
            .toPromise()
            .then(function (r) { return r.json(); });
    };
    CronTabService.prototype.save = function (model) {
        var headers = new http_1.Headers();
        //headers.append('Content-Type', 'multipart/form-data');
        headers.append('Content-Type', 'application/json');
        return this.http
            .post(this.saveCronTabUrl, JSON.stringify(model), { headers: headers })
            .toPromise()
            .then(function (res) { return res.json(); })
            .catch(this.handleError);
    };
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
    CronTabService.prototype.saveHero = function (hero) {
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
    CronTabService = __decorate([
        core_1.Injectable()
    ], CronTabService);
    return CronTabService;
})();
exports.CronTabService = CronTabService;
/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */ 
//# sourceMappingURL=cronTab.service.js.map