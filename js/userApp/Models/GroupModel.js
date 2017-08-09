(function(){
  App.Models.Group = Backbone.Model.extend({
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
          return "Musisz podać nazwę grupy.";
      };

    },

    url           : function(){
      if(this.isNew()) {
        return "group/add";
      }
        return "http://football.org/group/edit/id/"+this.get("id");
    }
  });
})();
