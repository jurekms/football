<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>FootBall</title>
    <link rel="stylesheet" href="../../assets/css/football.css">
    <link rel="stylesheet" href="../../assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="../../assets/css/jquery.datetimepicker.min.css">
</head>


<?php  ?>


<body id="box-warp1">
<div class="ui grid">

	<div class="row" >
		<div class="one wide column"></div>
		<div class="eight wide column">
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

		</div>
	</div>


</div>









<script id="template-user-login" type="text/template">
  	<div class="ui card">
  			<div class="content">
  				<div  class="ui form">
  					<div class="field">
  						<input type="text" id="form-username"  placeholder="login">
  					</div>
  					<div class="field">
  						<input type="text" id="form-password"  placeholder="hasło">
  					</div>
  				</div>
  			</div>
    		<div class="extra content">
    				<div class="ui right floated blue button tiny" id="btn-login" >ZALOGUJ</div>
    				<div class="ui right floated gray button tiny" id="btn-password-reset" >ZRESETUJ</div>
    		</div>
    </div>
</script>



<script src="../../assets/jquery.js"></script>
<script src="../../assets/underscore.js"></script>
<script src="../../assets/backbone.js"></script>
<script src="../../assets/semantic/semantic.min.js"></script>
<script src="../../assets/backbone.stickit.js"></script>
<script src="../../assets/jquery.datetimepicker.full.min.js"></script>
<script src="../../js/authApp/PushStateLink.js"></script>



<script src="../../js/authApp/SetupApp.js"></script>
<script src="../../js/authApp/Models/UserModel.js"></script>
<script src="../../js/authApp/Views/LoginView.js"></script>


<script src="../../js/authApp/Routers/Router.js"></script>
<script src="../../js/authApp/App.js"></script>


</body>
</html>
