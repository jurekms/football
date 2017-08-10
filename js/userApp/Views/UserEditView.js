(function() {
  App.Views.UserEdit = Backbone.View.extend({
    initialize    : function(){
      this.listenToOnce(this.model, 'change', this.render);

    },
    template      : _.template($('#template-user-edit').html()),
    render        : function(){
      var html = this.template();
      this.$el.html(html);
      App.Regions.appEditDashboard.html(this.el);
      this.stickit();

      this.$el.find('#form-user-edit').form(App.FormsValidators.userEditFV);
      this.$el.find('#form-user-edit').form('validate form');
      return this;
    },
    bindings      : {
      '#form-username'      : 'username',
      '#form-email'         : 'email',
      '#form-first-name'    : 'first_name',
      '#form-last-name'     : 'last_name',
      '#form-password'      : 'new_password',
      '#form-re-password'   : 're_new_password'
    },
    events      : {'submit form'      : 'saveUser',
                   'click #btn-exit'  : 'exitEdit'
    },
    saveUser    : function(e){
      e.preventDefault();
      this.model.set('validate', this.$el.find('#form-user-edit').form('validate form'));
      this.model.save();
    },
    exitEdit   : function(){
      App.router.navigate('/',{trigger : true});
    }
  })
})()
