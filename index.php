<!DOCTYPE html>

<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id"
          content="361910950363-9b91rmt0ersa4qohedfue2lntef5oc6e.apps.googleusercontent.com">
    <title>Tutoring Sign-In</title>
</head>
<body class="m-0 justify-center flex content-center flex-col text-center"
      style="background-color: #20182D; height: 100vh; width: 100vw">

<span class="material-icons text-8xl" style="color: #D61341">school</span>
<p class="text-slate-400 text-xl mb-2">Regis Tutor Hub</p>
<form class="flex flex-col" action="test.php" method="post">
    <label>
        <input type="text" class="rounded-full bg-slate-600 p-2 pl-4 m-1 text-white" autocomplete="username" placeholder="Username" name="username">
    </label>
    <label>
        <input type="password" class="rounded-full bg-slate-600 p-2 pl-4 m-1 text-white" autocomplete="password" placeholder="Password" name="password">
    </label>
    <label>
        <input type="submit" class="bg-slate-600 rounded-full p-2 pl-4 pr-4 m-1 text-white" value="Login">
    </label>
</form>
<a class="text-white mt-2" href="homepage.php">Temporary bypass</a>
</body>

</html>