(function(){
App.Routers.Router = Backbone.Router.extend({
  routes      : {
    ""                              : "initialView",
    "users(/page/:page)"            : "showUsersList",
    "adminUserEdit/:id"             : "showAdminUserEdit",
    "adminUserAdd"                  : "showAdminUserAdd",
    "userEdit"                      : "showUserEdit"

  },
  initialView   : function(){
    App.Regions.appEditDashboard.empty();
  },
  showUsersList : function(page){
    var users = new App.Collections.Users(),
        page = page || 1,
        adminUsersList = new App.Views.AdminUsersList({collection : users, page : page});

    App.showEditRegionViews(adminUsersList);
    users.fetch({ reset : true,
                  data  : {
                    page : page
                  }
    });
  },
  showAdminUserEdit  : function(_id) {
    var user = new App.Models.User({ id : _id }),
    adminUserEdit = new App.Views.AdminUserEdit({model : user});

    App.showEditRegionViews(adminUserEdit);
    user.fetch();
  },
  showAdminUserAdd   : function() {
    var user = new App.Models.User(),
        adminUserNew = new App.Views.AdminUserEdit({model : user});
    App.showEditRegionViews(adminUserNew);
  },
  showUserEdit  : function() {
    var user = new App.Models.User({id : 0}),
    userEdit = new App.Views.UserEdit({model : user});

    App.showEditRegionViews(userEdit);
    user.fetch();
  }



})
})();
