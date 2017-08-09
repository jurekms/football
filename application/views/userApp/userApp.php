<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>FootBall</title>
    <link rel="stylesheet" href="../../assets/css/football.css">
    <link rel="stylesheet" href="../../assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="../../assets/css/jquery.datetimepicker.min.css">
</head>





<body id="box-warp1">

<div class="ui grid">

	<div class="row" >
		<div class="one wide column"></div>
		<div class="eight wide column" id="menu-items">


      <div class="ui compact menu">
        <a class="item" href="userEdit/-1" pushstate-link>
          <i class="settings icon"></i>
          Moje dane
        </a>
        <a class="item" href="users" pushstate-link>
          <i class="users icon"></i>
          Użytkownicy
        </a>
        <a class="item" href="userAdd" pushstate-link>
          <i class="soccer icon"></i>
          Mecze
        </a>
        <a class="item">
          <i class="refresh icon"></i>
          Odśwież
        </a>

        <a class="item" href="/" pushstate-link>
          <i class="sign out icon"></i>
          Wyloguj
        </a>
      </div>



    </div>
	</div>

	<div class="row">
		<div class="one wide column"></div>
		<div class="four wide column" id="edit-dashboard">

    </div>
	</div>

	<div class="row" id="match-dashboard">
		<div class="one wide column"></div>
		INFO O MECZACH
	</div>


	<div class="row" >
		<div class="twelve wide column" > </div>
		<div class="four wide column" id="login-dashboard">
			LOGIN
		</div>
	</div>


</div>









<script id="template-users-list" type="text/template">
  <div class="ui segments" >
    <div class="ui clearing segment">
      <table class = "ui fixed single line celled table very compact striped selectable">
        <thead>
          <tr>
            <th>Login</th>
            <th>Imie i nazwisko</th>
          </tr>
        </thead>
        <tbody id="users-list-table-items"></tbody>
        <tfoot>
          <tr>
            <th colspan = "2" id="list-pagination">
            </th>
          </tr>
          <tr>
             <th colspan="2">
              <div class="ui right floated tiny buttons">
                <button class="ui red button" id="btn-exit">WYJDŹ</button>
                <div class="or" data-text="lub"></div>
                <button class="ui positive button" id="btn-add">DODAJ</button>
              </div>

            </th>
          </tr>
        </tfoot>
      </table>
      </div>
    </div>
</script>





<script id="template-user-item" type="text/template">
      <td><%= username %></td>
      <td><%= first_name + " " + last_name %></td>
</script>



<script id="template-user-edit" type="text/template">
  <div class="ui segments" >
    <div class="ui clearing segment">
      <form  action="" class="ui form"  id="form-user-edit">
        <h4 class="ui dividing header">Dane użytkownika </h4>
          <div class="fields">
             <div class="six wide field error">
               <label>login</label>
               <input type="text" name="username" id="form-username" />

             </div>
             <div class="ten wide field">
               <label>email</label>
                <input type="text" name="email"  placeholder="adres email" id="form-email" />
             </div>
         </div>

         <div class="two fields">
           <div class="field">
             <label>Hasło</label>
               <input type="password" name="password"   id="form-password"/>
           </div>
           <div class="field">
             <label>Powtórz hasło</label>
               <input type="password" name="re-password"  id="form-re-password" />
           </div>
         </div>

         <div class="two fields">

           <div class="field error">
             <label>Imię</label>
               <input type="text" name='first_name' id="form-first-name"/>
           </div>

           <div class="field error">
             <label>Nazwisko</label>
               <input type="text" name="last_name" id="form-last-name" />
             </div>

         </div>

         <div class="fields">
           <select class="ui fluid dropdown" name="groups" multiple="multiple" id="dropdown-groups"></select>
         </div>
         <div class="field">
         <div class="ui error message"></div>
       </div>



         <div class="ui right floated tiny buttons">
           <button type="button" class="ui orange button" id="btn-exit">WYJDŹ </button>
           <div class="or" data-text="lub"></div>
           <button type="submit" class="ui positive submit button">ZAPISZ</button>
         </div>
      </form>
    </div>

      <div class="ui error small message hidden" id="msg-error"></div>
      <div class="ui success small message hidden " id="msg-success"></div>

  </div>
</script>


<script id="template-list-pagination" type="text/template">
  <div class="ui right floated pagination mini menu">

    <% if(startPage > 1) { %>
      <a href="#" class="item" data-page="1">1</a>
      <i  class="item">...</i>
    <% } %>



    <% for(var i = startPage; i <= endPage ; i++) { %>
    <a href="#" class="item <% i == activePage ? print("active") : "" %>" data-page="<%= i %>"><%= i %></a>
    <% } %>


    <% if(endPage < nbPages) { %>
      <i  class="item">...</i>
      <a href="#" class="item" data-page="<%= nbPages %>"><%= nbPages %></a>
    <% } %>


  </div>
</script>



<script src="../../assets/jquery.js"></script>
<script src="../../assets/underscore.js"></script>
<script src="../../assets/backbone.js"></script>
<script src="../../assets/semantic/semantic.min.js"></script>
<script src="../../assets/backbone.stickit.js"></script>
<script src="../../assets/jquery.datetimepicker.full.min.js"></script>
<script src="../../js/userApp/PushStateLink.js"></script>
<script src="../../assets/backbone.fetch-cache.js"></script>



<script src="../../js/userApp/SetupApp.js"></script>

<script src="../../js/userApp/Views/PaginationView.js"></script>


<script src="../../js/userApp/Models/UserModel.js"></script>
<script src="../../js/userApp/Views/UserItemView.js"></script>
<script src="../../js/userApp/Collections/UsersCollection.js"></script>
<script src="../../js/userApp/Views/UsersListView.js"></script>

<script src="../../js/userApp/Views/UserNewView.js"></script>
<script src="../../js/userApp/Views/UserEditView.js"></script>

<script src="../../js/userApp/Models/GroupModel.js"></script>
<script src="../../js/userApp/Collections/GroupsCollection.js"></script>




<script src="../../js/userApp/Routers/Router.js"></script>

<script src="../../js/userApp/App.js"></script>


</body>
</html>
