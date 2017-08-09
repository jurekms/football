(function(){

    window.App = {
      Models      : {},
      Collections : {},
      Views       : {},
      Routers     : {},
      Regions: {
          appLoginDashboard:  $("#login-dashboard")
      },
      ViewInstances : {}

    };

    App.showEditRegionViews = function(view) {
      if(App.ViewInstances.editRegionViews) {
        App.ViewInstances.editRegionViews.remove();
      }
      App.ViewInstances.editRegionViews = view;

    };

    App.showMsgUnauthorizedError = function(){
      alert('NIEPOPRAWNA NAZWA UŻYTKOWNIKA LUB HASŁO');
      //App.router.navigate('/',{trigger : true});
      //window.location.reload(true);
    };

    App.showMsgServerError = function(colectionModel, response, options) {
      switch(response.status){
        case 401:
          App.showMsgUnauthorizedError();
          break;
        default:
      };

    };



})()
