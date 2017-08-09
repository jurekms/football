(function(){
App.Routers.Router = Backbone.Router.extend({
  routes      : {
    ""                              : "initialView",
    "users(/page/:page)"            : "showUsersList",
    "userEdit/:id"                  : "showUserEdit",
    "userAdd"                       : "showUserAdd"
  },
  initialView   : function(){
    App.Regions.appEditDashboard.empty();
  },
  showUsersList : function(page){
    var users = new App.Collections.Users(),
        page = page || 1,
        usersList = new App.Views.UsersList({collection : users, page : page});

    App.showEditRegionViews(usersList);
    users.fetch({ reset : true,
                  data  : {
                    page : page
                  }
    });
  },
  showUserEdit  : function(_id){
    var user = new App.Models.User({
      id : _id
    }),
    userEdit = new App.Views.UserEdit({model : user});
    App.showEditRegionViews(userEdit);
    user.fetch();
  },
  showUserAdd   : function(){
    var user = new App.Models.User(),
        userNew = new App.Views.UserNew({model : user});
    App.showEditRegionViews(userNew);
  }


})
})();
