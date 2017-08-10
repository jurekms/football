(function(){
  App.Views.AdminUserEdit = Backbone.View.extend({
    initialize    : function(){
      this.isNew = this.model.isNew();
      this.groupCollection = new App.Collections.Groups();
      //this.groupCollection.add([{id : '',name:'Wybierz grupę dla użytkownika'}]);
      this.groupCollection.fetch({remove : false, cache : true, expires : 10});
      if(this.isNew) {
        this.render();
      } else {
        this.listenToOnce(this.model, "change", this.render);
      }
    },
    template      : _.template($("#template-user-edit").html()),
    render        : function(){
      var html = this.template();
      this.$el.html(html);
      App.Regions.appEditDashboard.html(this.el);
      this.stickit();
      this.$el.find('#dropdown-groups').dropdown({'placeholder' : 'Wybierz rolę dla użytkownika...'});
      this.$el.find('#form-user-edit').form(App.FormsValidators.userEditFV);
      if(!this.isNew) {
        this.$el.find('#form-user-edit').form('validate form');
      }
      return this;
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
      this.$el.find('#form-user-edit').form('validate form');
      this.model.save();
    },
    exitEdit   : function(){
      App.router.navigate("/users",{trigger : true});
    }
  });



/*
  this.$el.find('#form-date').datetimepicker({
    timepicker:false,
    todayButton : false,
    minDate : 0,
    format : 'd.m.Y',
    home : false
  });
  this.$el.find('#form-time').datetimepicker({
    datepicker:false,
    format : 'H:i'
  });
*/


})();
