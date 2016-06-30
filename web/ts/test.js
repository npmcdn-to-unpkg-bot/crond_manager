/**
 * Created by Administrator on 2016/6/7.
 */
var mytest;
(function (mytest) {
    var webtool;
    (function (webtool) {
        var app;
        (function (app) {
            var myClass = (function () {
                function myClass() {
                }
                myClass.prototype.sayHello = function () {
                    return 'hello';
                };
                return myClass;
            })();
            app.myClass = myClass;
        })(app = webtool.app || (webtool.app = {}));
    })(webtool = mytest.webtool || (mytest.webtool = {}));
})(mytest || (mytest = {}));
window.onload = function () {
    var cls1 = new mytest.webtool.app.myClass();
    cls1.sayHello();
};
//# sourceMappingURL=test.js.map