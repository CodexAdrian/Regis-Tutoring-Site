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
    <script>
        var googleUser = {};
        var startApp = function () {
            gapi.load('auth2', function () {
                // Retrieve the singleton for the GoogleAuth library and set up the client.
                auth2 = gapi.auth2.init({
                    client_id: '361910950363-9b91rmt0ersa4qohedfue2lntef5oc6e.apps.googleusercontent.com',
                    cookiepolicy: 'single_host_origin',
                    // Request scopes in addition to 'profile' and 'email'
                    //scope: 'additional_scope'
                });
                attachSignin(document.getElementById('customBtn'));
            });
        };

        function attachSignin(element) {
            console.log(element.id);
            auth2.attachClickHandler(element, {},
                function (googleUser) {
                    document.getElementById('name').innerText = "Signed in: " +
                        googleUser.getBasicProfile().getName();
                }, function (error) {
                    alert(JSON.stringify(error, undefined, 2));
                });
        }
    </script>
</head>
<body class="m-0 justify-center flex content-center flex-col text-center"
      style="background-color: #20182D; height: 100vh; width: 100vw">
<!-- In the callback, you would hide the gSignInWrapper element on a
successful sign in -->

<!-- Logo, site name, etc. will be placed here -->
<!-- Google authentication form will be placed here; if successful, links to homepage with userID in query string -->
<!-- Else, prints error statement -->
<span class="material-icons text-8xl" style="color: #D61341">school</span>
<p class="text-slate-400 text-xl mb-2">Regis Tutor Hub</p>
<div id="gSignInWrapper">
    <div id="customBtn" class="customGPlusSignIn flex w-min ml-auto mr-auto pl-2 pr-10 whitespace-nowrap rounded-3xl text-white drop-shadow-xl hover:cursor-pointer" style="background-color: #575271">
        <img src="google_icon.svg" class="p-2">
        <span class="m-auto text-lg">Sign in with Google</span>
    </div>
</div>
<div id="name"></div>
<script>startApp();</script>
<div id="my-signin2"></div>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
<a class="text-white mt-2" href="homepage.php">Temporary bypass</a>
</body>

</html>