<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="{{asset('blog/admin/styles.css')}}">
</head>
<body>
	<form class="box" action="{{action('PageController@postLogin')}}" method="post">
		@csrf
		<h1>Admin Login</h1>
		<input type="text" name="username" placeholder="Username" required>
		<input type="password" name="pass" placeholder="Password" required>
		<input type="submit" name="submit" value="LOGIN">
	</form>
</body>
</html>
