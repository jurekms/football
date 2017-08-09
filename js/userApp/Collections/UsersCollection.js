(function(){
  App.Collections.Users = Backbone.Collection.extend({
    model:  App.Models.User,
    parse: function(response){
      this.nbUsers = response.options.nbUsers;
      return response.data;
    },
    initialize:   function(){
      this.listenTo(this, "error", App.showMsgServerError);
    },
    url:    "http://football.org/users/list/"
  });
})();
