(function(){
  App.Models.User = Backbone.Model.extend({
    idAttribute   : 'id',

    defaults: {
      validate          : false,
      username          : '',
      email             : '',
      new_password      : '',
      re_new_password   : '',
      first_name        : '',
      last_name         : '',
      roles             : []
    },
    initialize:   function(){
      this.listenTo(this, 'error',  App.showMsgServerError);
    },


    url           : function(){

      if(this.isNew()) {
        return 'user/add';
      } else if(this.get('id') > 0) {
        return 'http://football.org/user/adminEdit/id/'+this.get('id');
      } else {
        return 'http://football.org/user/edit/'
      }

    }
  });
})();
