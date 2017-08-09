(function(){
  App.Views.UserItem = Backbone.View.extend({
    tagName       : "tr",
    template      : _.template($("#template-user-item").html()),
    render        : function(){
      html = this.template( this.model.toJSON());
      this.$el.html(html);
      return this;
    },
    events        : {"click" : "clickHandler"},
    clickHandler  : function(){
      App.router.navigate("userEdit/"+this.model.get("id"),{trigger : true});
    }
  });
})();
