(function(){
  App.Views.ListPagination = Backbone.View.extend({
    tagName       : "div",
    template      : _.template($("#template-list-pagination").html()),
    initialize    : function(options){
      this.options = options;

    },
    render        : function(){
      var nbPages = Math.ceil(this.options.nbItems/5),
          startPage = 1,
          endPage = nbPages > 4 ? 4 : nbPages,
          page = Number(this.options.page),
          activePage = page ? page : 1;
          if(activePage > 3){
            startPage = activePage == nbPages  ? nbPages - 3 : activePage  - 2 ;
            endPage =   activePage == nbPages  ? nbPages : activePage + 1;
          }
          this.$el.html( this.template({ nbPages : nbPages, activePage : activePage, startPage : startPage, endPage : endPage }) );
          return this;
    },
    events      : {"click a"  : "gotoPage"
    },
    gotoPage    : function(e){
      e.preventDefault();
      var page = $(e.target).data("page");
      var url = this.options.collectionName+"/page/"+page;
      App.router.navigate(url, {trigger : true});
    }
  })
})();
