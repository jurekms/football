(function(){
  App.Collections.Groups = Backbone.Collection.extend({
    model:  App.Models.Group,
    parse: function(response){
      this.nbGroups = response.options.nbGroups;
      return response.data;
    },
    initialize:   function(){
      this.listenTo(this, "error", App.showMsgServerError);
    },
    url:    "http://football.org/group/list/"
  })
})();
