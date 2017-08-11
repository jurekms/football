(function(){
  App.Models.Role = Backbone.Model.extend({
    idAttribute   : "id",
    defaults: {
      name        : "",
      description : ""
    },
    initialize:   function(){
      this.listenTo(this, "error",  App.showMsgServerError);
    },

    validate: function(attrs, options) {

      if(attrs.name === "") {
          return "Musisz podać nazwę roli.";
      };

    },

    url           : function(){
      if(this.isNew()) {
        return "role/add";
      }
        return "http://football.org/role/edit/id/"+this.get("id");
    }
  });
})();
