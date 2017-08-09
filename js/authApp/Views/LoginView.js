(function(){
  App.Views.Login = Backbone.View.extend({
    initialize    : function(){
      this.listenTo(this.model, "invalid", this.showErrorInfo);
    },
    template      : _.template($("#template-user-login").html()),
    render        : function(){
      var html = this.template();
      this.$el.html(html);
      App.Regions.appLoginDashboard.html(this.el);
      this.stickit();
    },
    bindings      : {
      "#form-username"      : "username",
      "#form-password"      : "password"
    },
    events        : {
      "click #btn-login"          : "login",
      "click #btn-password-reset" : "passwordReset"
    },
    login         : function(){
      this.model.save({}, {
          wait: true,
        success: function() {
            App.router.navigate('/loadApp',{trigger : true});
          }
      })
    },
    passwordReset : function(){
      alert("PASSWORD RESET");
    },
    showErrorInfo : function(){
      alert(this.model.validationError);
    }

  });
})();
