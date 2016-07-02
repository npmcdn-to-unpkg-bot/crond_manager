/**
 * Created by Administrator on 2016/7/1.
 */
import { Component, EventEmitter, Input, OnInit, OnDestroy, Output } from '@angular/core';

import { ActivatedRoute,Router } from '@angular/router';

import{CronTabModel} from '../model/cronTabModel';
import{CronTabService} from '../service/cronTab.service';
import{CrondServerService} from '../service/crondServer.service';

@Component({
    selector: 'my-crontabs',
    templateUrl: 'app/template/cronTabs.component.html',
    styleUrls: ['css/tools/app.component.css']
})

export class CronTabsComponent implements OnInit{
    cronTabs = [];
    tags = [];
    selectedTag = null;
    searchKey = '';
    error = null;
    sub: any;
    navigated = false;
    svrId = null;
    selectedAll = false;
    editModel={}; //当前编辑对象
    scriptsList = [];//脚本文件列表
    scriptContent = '';//脚本文件内容
    crondServerInfo=null;
    constructor(
        private cronService: CronTabService,
        private crondSvrService: CrondServerService,
        private route: ActivatedRoute,
        private router:Router
    ) {
    }

    ngOnInit(){
        //this.cronTabs = this.cronService.getCronTabs();
        this.sub = this.route.params.subscribe(params => {
            if (params['id'] !== undefined) {
                let id = +params['id'];
                this.svrId = id;
                this.navigated = true;
                this.cronService.getCronTabs(id,'','')
                    .then(r => this.cronTabs = r);
                this.cronService.getTags(id)
                    .then(r=>this.tags = (r==null || r.length==0)?[]:r);
                this.crondSvrService.getCrondScripts(id)
                    .then(r=>this.scriptsList = r);


            } else {
                this.navigated = false;
                this.cronTabs = [];
            }
        });
    }

    filter(){
        let tag  = this.selectedTag ? this.selectedTag.tag : '';
        let key = this.searchKey;
        this.cronService.getCronTabs(this.svrId, tag, key)
            .then(r=>this.cronTabs = r);
    }

    ngOnDestroy() {
        this.sub.unsubscribe();
    }

    onSelectTag(tag){
        this.selectedTag = tag;
        this.searchKey = '';
        this.filter();
    }

    onSelectScript(){
        var file = document.getElementById('idCronFile').value;
        this.crondSvrService.getCrondScriptContent(this.svrId, file)
            .then(r=>this.scriptContent = r);

    }

    selectAll(){
        let m = this;
        this.cronTabs.forEach(function(o){
            o.selected = !m.selectedAll;
        })
    }

    enable(){
        let ids = this.getSelectedIds();
        this.cronService.enable(ids)
            .then(r=>{this.filter()});
    }
    disable(){
        let ids = this.getSelectedIds();
        this.cronService.disable(ids)
            .then(r=>{this.filter()});
    }
    delete(){
        let ids = this.getSelectedIds();
        this.cronService.deleteByIds(ids)
            .then(r=>{this.filter()});
    }

    getSelectedIds(){
        let ids = [];
        this.cronTabs.forEach(function(o){
            if(o.selected ===true){
                console.info(o.id);
                ids.push(o.id);
            }
        })
        console.info(JSON.stringify(ids))
        return ids;
    }
    openModel(model){
        this.scriptContent = '';
        this.editModel = model;
        var file = model.cron_file;//document.getElementById('idCronFile').value;
        this.crondSvrService.getCrondScriptContent(this.svrId, file)
            .then(r=>this.scriptContent = r);
    }
    addCronTab(){
        this.editModel = {'server_id':this.svrId,'jog_guid':'','cron_user':'www','status':'启用'};
    }
    saveModel(){
        this.cronService.save(this.editModel)
            .then(r=>{
            });
        $('#myModal').modal('hide');
        this.filter();
        //this.router.navigate(['/crontabs',this.svrId]);
    }

}