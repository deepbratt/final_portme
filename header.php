<style type="text/css">
    .arrow {
      position: absolute;
      bottom: 2%;
      left: 50%;
      margin-left: -20px;
      width: 40px;
      height: 40px;
      background-image: url(images/down-arrow.svg);
      background-size: contain;
      z-index: 9;
    }
    .bounce {
      -webkit-animation-name: bounce;
      animation-name: bounce;
      -webkit-transform-origin: center bottom;
      transform-origin: center bottom;
    }
    .bounce {
      -webkit-animation: bounce 2s infinite;
      animation: bounce 2s infinite;
    }
    .mob_manu {
      display: none;
    }
    /* Style the Image Used to Trigger the Modal */
    #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
      color: #e52d2d;
    }
    #myImg:hover 
    {
      opacity: 0.5;
    }
    @-webkit-keyframes zoom {
      from {
        -webkit-transform:scale(0)}
      to {
        -webkit-transform:scale(1)}
    }
    @keyframes zoom {
      from {
        transform:scale(0)}
      to {
        transform:scale(1)}
    }
    /* The Close Button */
    .close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #e52d2d;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }
    .close:hover,
    .close:focus {
      color: #e52d2d;
      text-decoration: none;
      cursor: pointer;
    }
    .hvr-underline-from-center {
      display: inline-block;
      vertical-align: middle;
      -webkit-transform: translateZ(0);
      transform: translateZ(0);
      box-shadow: 0 0 1px rgba(0, 0, 0, 0);
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      -moz-osx-font-smoothing: grayscale;
      position: relative;
      overflow: hidden;
    }
    .hvr-underline-from-center:before {
      content: "";
      position: absolute;
      z-index: -1;
      left: 50%;
      right: 50%;
      bottom: 0;
      background: #e52d2d;
      height: 4px;
      -webkit-transition-property: left, right;
      transition-property: left, right;
      -webkit-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-transition-timing-function: ease-out;
      transition-timing-function: ease-out;
    }
    .hvr-underline-from-center:hover:before, .hvr-underline-from-center:focus:before, .hvr-underline-from-center:active:before {
      left: 0;
      right: 0;
    }
    .headShake:hover {
      animation: pulse 0.82s cubic-bezier(.36,.07,.19,.97) both;
      transform: translate3d(0, 0, 0);
      backface-visibility: hidden;
      perspective: 1000px;
    }
    .headShake:hover:before {
      animation: pulse 0.82s cubic-bezier(.36,.07,.19,.97) both;
      transform: translate3d(0, 0, 0);
      backface-visibility: hidden;
      perspective: 1000px;
    }
  </style>
</head>
<body>
  <header class="header-wrapper solid-bg" style="border:1px solid white;">
	<nav class="navbar navbar-default navbar-fixed white bootsnav">
		<div class="container-fluid"> 

			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
				<i class="fa fa-bars">
				</i>
			  </button>
			  <a class="navbar-brand" href="#brand">
				<img src="images/logo.png" class="logo logo-display" alt="">
				<img src="images/logo.png" class="logo logo-scrolled" alt="">
			  </a>
			</div>

			<div class="collapse navbar-collapse" id="navbar-menu">
			  <ul class="nav navbar-nav navbar-right" data-in="fadeOutUp" data-out="fadeInDown">
				<li>
				  <a href="https://portme.co/index.php" class="btn btn-outline-primary hvr-underline-from-center">Home
				  </a>
				</li>
				
				<li>
				  <a href="https://portme.co/contact.php" class="btn btn-outline-primary hvr-underline-from-center">Contact
				  </a>
				</li>
				<li>
				  <a href="https://portme.co/app" class="btn btn-outline-primary hvr-underline-from-center">Log In
				  </a>
				</li>
				<a href="signup.php?plan=1" style="color:#fff !important;"><button type="button" style="border: 0px none;color:#fff; margin-top:15px !important;" class="btn btn-danger btn-lg hvr-underline-from-center">Get Started</button></a>
				</button>
			  </ul>
			</div>

		</div>

	</nav>

  </header>