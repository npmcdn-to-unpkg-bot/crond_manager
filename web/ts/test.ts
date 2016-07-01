/**
 * Created by Administrator on 2016/6/7.
 */

module mytest.webtool.app{
    export class myClass{
        sayHello(){
            return 'hello';
        }
    }
}

window.onload = function () {
    var cls1 = new mytest.webtool.app.myClass();
    cls1.sayHello();
}