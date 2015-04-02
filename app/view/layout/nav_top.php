<!-- button link to menu -->
<nav id="wrap-nav" class="clearfix">
	<a class="sub-menu" href="#home"><i class="fa fa-home"></i>Home</a>
	<a class="sub-menu" href="#search"><i class="fa fa-search"></i>Search</a>
	<a class="sub-menu" href="#report"><i class="fa fa-file-text-o"></i>Report</a>
	<?php if(Session::getSessionUID() !== null){ ?>
		<a class="sub-menu" href="admin"><i class="fa fa-wrench"></i>Admin</a>
		<a class="sub-menu" href="logout"><i class="fa fa-sign-out"></i>Logout</a>
	<?php }else{ ?>
		<a class="sub-menu" href="login"><i class="fa fa-sign-in"></i>Login</a>
	<?php } ?>
</nav>

<style type="text/css">
/*
* Menu navigation
*/
#wrap-nav{
	width: 100%;
	padding: 5px 0;
	position: fixed;
	top: 0;
	left: 0;
	text-align: right;
	background-color: #333;
	z-index: 999;
	font-size: 1em;
}
.sub-menu {
	margin: 0 10px;
}

.sub-menu .fa {
	margin: 0 5px 0 0;
}
	
</style>