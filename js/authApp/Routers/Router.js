(function(){
App.Routers.Router = Backbone.Router.extend({
  routes      : {
    ''                              : 'initialView',
    'loadApp'                      : 'loadApplication'
  },
  initialView   : function(){
    App.Regions.appLoginDashboard.empty();
    var user = new App.Models.User()
        loginView = new App.Views.Login({model : user});
    loginView.render();
  },
  loadApplication : function() {
    App.router.navigate('welcome/loadApp/');
    window.location.reload(true);
  }
})
})();
