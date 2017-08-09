(function(){

App.router = new App.Routers.Router();
Backbone.history.start({pushState : true});
App.router.navigate('/',{trigger : true});


})()
