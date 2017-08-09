(function(){
  App.Views.UserNewEdit = Backbone.View.extend({
    initialize    : function(){
      this.listenToOnce(this.model, "change", this.render);
    },
    template      : _.template($("#template-user-edit").html()),
    render        : function(){
      //var model = this.model;
      var html = this.template();
      this.$el.html(html);
      App.Regions.appEditDashboard.html(this.el);
      this.stickit();
    },
    bindings      : {
      "#form-username"    : "username",
      "#form-email"       : "email",
      "#form-first-name"  : "first_name",
      "#form-last-name"   : "last_name"
    },
    events      : {"submit form"      : "saveUser",
                   "click #btn-exit"  : "exitEdit"
    },
    saveUser    : function(e){
      e.preventDefault();
      this.model.save();
    },
    exitEdit   : function(){
      App.router.navigate("/users",{trigger : true});
    }
  });


})();
