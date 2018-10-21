<!DOCTYPE html>
<html>
    <head>
        <title>SKForum</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        {{-- <link rel="stylesheet" href="/stylesheets/landing.css"> --}}
        <style media="screen">
        html, body {
              height:100%;

            }

            body {
              background-color: white;
              background-image: url('https://cdn.pixabay.com/photo/2018/05/30/09/07/analyzing-people-3441040__340.jpg');
              background-size: 100% 100%;
              background-repeat: no-repeat;
              background-position: left top;
            }

            #landing-header {
            z-index: 1;
            position: relative;
            text-align: center;
            padding-top: 40vh;
            }

            #landing-header h1 {
            color: white;
            font-weight: bold;
            }

            .slideshow {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            list-style: none;
            margin: 0;
            padding: 0;
            }
            img.bg {
            /* Set rules to fill background */
            min-height: 100%;
            min-width: 1024px;

            /* Set up proportionate scaling */
            width: 100%;
            height: auto;



            /* Set up positioning */
            position: fixed;
            top: 0;
            left: 0;
            }

            @media screen and (max-width: 1024px) { /* Specific to this particular image */
            img.bg {
              left: 50%;
              margin-left: -512px;   /* 50% */
            }
            }
            .slideshow li {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-size: cover;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            opacity: 0.5;
            z-index: -1;
            }

            .slideshow li:nth-child(1) {
            background-image: url("https://cdn.pixabay.com/photo/2018/05/30/09/07/analyzing-people-3441040__340.jpg");
            }
            .slideshow li:nth-child(2) {
            background-image: url("https://cdn.pixabay.com/photo/2018/05/30/09/07/analyzing-people-3441040__340.jpg");
            animation-delay: 10s;
            }

            .button{
              border-radius: 30px;
            }


        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript" async></script>
    </head>
    <body>



    <div id="bg"></div>
    <div id="landing-header">
 		<h1>Welcome to SKForum!</h1>
		<a href="discussions" class="btn btn-lg btn-primary button">View All Discussions</a>
    </div>
