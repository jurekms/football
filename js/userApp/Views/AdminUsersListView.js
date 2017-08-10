(function(){
  App.Views.AdminUsersList = Backbone.View.extend({
    initialize    : function(options){
      this.options = options
      this.listenTo(this.collection, "reset", this.render);
    },
    tagName       : "div",
    template      : _.template($("#template-users-list").html()),
    render        : function(){

      var listPaginationView = new App.Views.ListPagination({ 'collectionName' : 'users',
                                                              'nbItems'        : this.collection.nbUsers,
                                                              'page'           : this.options.page
                                                            });
      this.$el.append(this.template()); //wyrenderuj pusta tabela i umiesc ja w $el

      if(this.collection.nbUsers <= 5) {
        listPaginationView.remove();
      } else {
        this.$el.find("#list-pagination").append(listPaginationView.render().el); //umies paginacje
      };
      this.collection.each(this.addModel, this);
      App.Regions.appEditDashboard.html(this.el);
      return this;
    },
    addModel      : function(user){
      var userView = new App.Views.UserItem({model : user});
      this.$el.find("#users-list-table-items").append( userView.render().el ); //wyrenderuj wiersz i dodaj go do wyszukanego elementu  <tbody id="#users-list-table-items" >... w this->$el
    },
    events        : {
      "click #btn-add"  : "addNewUser",
      "click #btn-exit" : "exitEdit"
    },
    addNewUser  : function(){
      App.router.navigate("adminUserAdd",{trigger : true});
    },
    exitEdit    : function(){
      App.router.navigate("/",{trigger : true});
    }
  });
})();
