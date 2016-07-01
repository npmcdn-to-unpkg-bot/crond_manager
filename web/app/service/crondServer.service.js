var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
/**
 * Created by Administrator on 2016/7/1.
 */
var core_1 = require('@angular/core');
var http_1 = require('@angular/http');
require('rxjs/add/operator/toPromise');
var CrondServerService = (function () {
    function CrondServerService(http) {
        this.http = http;
        this.cronUrl = '/index.php?r=tools/get-crondservers';
    }
    CrondServerService.prototype.getCrondServers = function () {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        var tmp = [];
        return this.http.get(this.cronUrl, headers)
            .toPromise()
            .then(function (r) { return r.json(); });
    };
    CrondServerService.prototype.getServersNum = function () {
        return 123;
    };
    CrondServerService.prototype.handleError = function (error) {
        console.error('An error occurred', error);
        return Promise.reject(error.message || error);
    };
    CrondServerService = __decorate([
        core_1.Injectable()
    ], CrondServerService);
    return CrondServerService;
})();
exports.CrondServerService = CrondServerService;
/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */ 
//# sourceMappingURL=crondServer.service.js.map