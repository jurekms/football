(function(){
  App.Collections.Roles = Backbone.Collection.extend({
    model:  App.Models.Role,
    parse: function(response){
      this.nbRoles = response.options.nbRoles;
      return response.data;
    },
    initialize:   function(){
      this.listenTo(this, "error", App.showMsgServerError);
    },
    url:    "http://football.org/role/list/"
  })
})();
