(function(){
  App.Models.User = Backbone.Model.extend({
    idAttribute   : "id",

    defaults: {
      validate          : false,
      username          : "",
      email             : "",
      new_password      : "",
      re_new_password   : "",
      first_name        : "",
      last_name         : "",
      group             : []
    },
    initialize:   function(){
      this.listenTo(this, "error",  App.showMsgServerError);
    },


    url           : function(){
      if(this.isNew()) {
        return "user/add";
      }
        return "http://football.org/user/edit/id/"+this.get("id");
    }
  });
})();
