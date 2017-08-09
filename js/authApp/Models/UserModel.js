(function(){
  App.Models.User = Backbone.Model.extend({
    idAttribute   : "id",

    defaults: {
      username          : "administrator",
      password          : "password"
    },

    initialize:   function(){
      this.listenTo(this, "error",  App.showMsgServerError);
    },

    validate: function(attrs, options) {

      if(attrs.username === "") {
          return "Musisz podać nazwę użytkownika.";
      }

      if(attrs.password === "") {
          return "Hasło nie może być puste";
      }

    },
    url           : function(){
        return "http://football.org/login/login/";
    }
  });
})();
