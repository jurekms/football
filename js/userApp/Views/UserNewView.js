(function(){
  App.Views.UserNew = Backbone.View.extend({
    initialize    : function(){
      this.groupCollection = new App.Collections.Groups({});
      this.groupCollection.fetch({reset:true});
      this.listenTo(this.model, "invalid", this.showErrorInfo);
      this.listenToOnce(this.groupCollection, "reset", this.render());
    },
    template      : _.template($("#template-user-edit").html()),
    render        : function(){
      var html = this.template();
      this.groupCollection.add([{id : '',name:'Wybierz grupę dla użytkownika'}]);
      this.$el.html(html);
      App.Regions.appEditDashboard.html(this.el);
      this.stickit();
      this.$el.find('.ui.dropdown').dropdown();
    },
    bindings      : {
      "#form-username"      : "username",
      "#form-email"         : "email",
      "#form-first-name"    : "first_name",
      "#form-last-name"     : "last_name",
      "#form-password"      : "new_password",
      "#form-re-password"   : "re_new_password",
      "#dropdown-groups"    : {observe : 'group',
                               selectOptions: {
                                  collection: 'this.groupCollection',
                                  labelPath: 'name',
                                  valuePath: 'id'}
                              }
    },
    events      : {"submit form"      : "saveUser",
                   "click #btn-exit"  : "exitEdit"
    },
    saveUser    : function(e){
      e.preventDefault();
      this.model.save();
      if(!this.model.isNew()) {
      App.router.navigate("userEdit/"+this.model.get("id"),{trigger : true});
      };
    },
    exitEdit   : function(){
      App.router.navigate("/users",{trigger : true});
    },
    showErrorInfo(){
      $("#msg-error").removeClass("hidden").empty().append(this.model.validationError);
    }
  });


})();
