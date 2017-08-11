(function(){

  App.Views.DropdownElement = Backbone.View.extend({
      tagName   : "option",
      render    : function(){
        this.$el.attr("value",this.model.get("id"));
        this.$el.append(this.model.get("name"));
        return this;
      }
  });


  App.Views.Dropdown = Backbone.View.extend({
    tagName       : "select",
    className     : "ui fluid dropdown",
    initialize    : function(){ //collection z lista do wyboru // selected tablica z wybranymi opcjami
      this.listenTo(this.collection, "reset", this.render);
      this.collection.fetch({reset : true});
    },
    render        : function(){
      //this.$el.attr("multiple","multiple");
      this.collection.each(this.addListElement, this);
      $('.ui.dropdown').dropdown();
      return this;
    },
    addListElement(listElement){
      var dropdownElementView = new App.Views.DropdownElement({model : listElement});
      console.log(listElement.toJSON());
      this.$el.append(dropdownElementView.render().el);
    }
  });




})();
