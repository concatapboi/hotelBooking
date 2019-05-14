<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    {{-- <link rel="stylesheet" href="../node_modules/vuetify/src/stylus/main"> --}}
    {{-- <script src="../node_modules/vuetify/src/stylus/main"> --}}
    @include('Backend.layouts.header')


</head>

<body>
    <div id="app">
    </div>

    @include('Backend.layouts.footer')
<script src="{{asset("js/managerLogin.js")}}"></script>
</body>

</html>
<!-- end document-->