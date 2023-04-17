<!DOCTYPE html>
<html>

<head>

	<title>Hey Blinds Dashboard</title>

	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
	<link rel="manifest" href="assets/images/favicons/site.webmanifest" />


	<!-- Style sheet import -->
	<link rel="stylesheet" id="bootstrap-css" href="assets/css/bootstrap.min.css" type="text/css" media="all" />
	<link rel="stylesheet" id="style-css" href="assets/css/dataTables.bootstrap5.min.css" type="text/css" media="all" />
	<link rel="stylesheet" id="style-css" href="assets/css/style.css" type="text/css" media="all" />

	<!-- fontawesome import -->
	<script type="text/javascript" src="https://kit.fontawesome.com/4bb008fe2b.js"></script>


	<!-- Google fonts import -->
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400&display=swap"
		rel="stylesheet">

</head>



<body>
	<header id="header">
		<nav class="navbar navbar-expand-lg navbar-overlap navbar-dark bg-dark px-lg-5 px-md-4">
			<div class="container-fluid d-flex position-relative">
				<a class="navbar-brand" href="#">
					<img src="assets/images/logo.png" alt="" />
				</a>
				<button class="navbar-toggler ms-auto me-2" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="header-nav-bar collapse navbar-collapse me-lg-auto" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto ms-lg-3 mb-lg-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="#">
								<div class="d-flex align-items-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-house" viewBox="0 0 16 16">
										<path fill-rule="evenodd"
											d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
										<path fill-rule="evenodd"
											d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
									</svg>
									<span class=" ps-1">Home</span>
								</div>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#">
								<div class="d-flex align-items-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-house" viewBox="0 0 16 16">
										<path fill-rule="evenodd"
											d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
										<path fill-rule="evenodd"
											d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
									</svg>
									<span class=" ps-1">Home</span>
								</div>
							</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">
								<div class="d-flex align-items-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-house" viewBox="0 0 16 16">
										<path fill-rule="evenodd"
											d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
										<path fill-rule="evenodd"
											d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
									</svg>
									<span class=" ps-1">Home</span>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-custom" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">Action</a></li>
								<li><a class="dropdown-item" href="#">Another action</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="#">Something else here</a></li>
							</ul>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#">
								<div class="d-flex align-items-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-house" viewBox="0 0 16 16">
										<path fill-rule="evenodd"
											d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
										<path fill-rule="evenodd"
											d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
									</svg>
									<span class=" ps-1">Home</span>
								</div>
							</a>
						</li>


						<li class="nav-item">
							<a class="nav-link" href="#">
								<div class="d-flex align-items-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-house" viewBox="0 0 16 16">
										<path fill-rule="evenodd"
											d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
										<path fill-rule="evenodd"
											d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
									</svg>
									<span class=" ps-1">Home</span>
								</div>
							</a>
						</li>

					</ul>
                </div>
                
					<div class="d-flex">
						<div class="dropdown me-lg-3 me-2">
							<button class="btn btn-light bg-opacity dropdown-toggle notifications-btn brop-none"
								type="button" id="notifications" data-bs-toggle="dropdown" aria-expanded="false">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-bell" viewBox="0 0 16 16">
									<path
										d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
								</svg>
							</button>
							<ul class=" dropdown-menu notifications-menu dropdown-custom dropdown-menu-end"
								aria-labelledby="notifications">
								<li>
									<a class="notifications-items" href="#">
										<div class="d-flex align-items-center">
											<div class="mr-2">
												<svg id="notification" xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24">
													<g id="icon_notification" data-name="icon/notification">
														<rect id="Rectangle" width="14" height="19"
															fill="rgba(216,216,216,0)"></rect>
														<g id="Group" transform="translate(4.8 2.88)">
															<g id="Path" transform="translate(0 1.92)" fill="none"
																stroke-miterlimit="10">
																<path
																	d="M14.4,14.821a.537.537,0,0,1-.535.539H.534A.537.537,0,0,1,0,14.821V7.253a7.2,7.2,0,1,1,14.4,0Z"
																	stroke="none"></path>
																<path
																	d="M 12.39999961853027 13.35999965667725 L 12.39999961853027 7.252949714660645 C 12.39999961853027 4.356459617614746 10.06728935241699 1.99999988079071 7.199999809265137 1.99999988079071 C 4.332709789276123 1.99999988079071 1.999999761581421 4.356459617614746 1.999999761581421 7.252949714660645 L 1.999999761581421 13.35999965667725 L 9.115189552307129 13.35999965667725 L 9.123849868774414 13.35999965667725 L 12.39999961853027 13.35999965667725 M 13.86516952514648 15.35999965667725 L 9.123849868774414 15.35999965667725 C 9.120960235595703 15.35999965667725 9.118080139160156 15.35999965667725 9.115189552307129 15.35999965667725 L 0.5338698029518127 15.35999965667725 C 0.2395198047161102 15.35999965667725 -1.907348661234209e-07 15.11872005462646 -1.907348661234209e-07 14.82123947143555 L -1.907348661234209e-07 7.252949714660645 C -1.907348661234209e-07 3.253889799118042 3.229179859161377 -1.716613837743353e-07 7.199999809265137 -1.716613837743353e-07 C 11.16985988616943 -1.716613837743353e-07 14.39999961853027 3.253889799118042 14.39999961853027 7.252949714660645 L 14.39999961853027 14.82123947143555 C 14.39999961853027 15.11872005462646 14.16047954559326 15.35999965667725 13.86516952514648 15.35999965667725 Z"
																	stroke="none" fill="#6f7e90"></path>
															</g>
															<path id="Rectangle-2" data-name="Rectangle"
																d="M0,0H4.8a0,0,0,0,1,0,0V.48a2.4,2.4,0,0,1-2.4,2.4h0A2.4,2.4,0,0,1,0,.48V0A0,0,0,0,1,0,0Z"
																transform="translate(4.8 16.32)" fill="#6f7e90"></path>
															<rect id="Rectangle-3" data-name="Rectangle" width="4.8"
																height="3.84" rx="1.92" transform="translate(4.8)"
																fill="#6f7e90"></rect>
														</g>
													</g>
													<circle class="alertNotification" cx="3.5" cy="3.5" r="3.5"
														transform="translate(14 4)" fill="#e02020" stroke="#f0f2f8"
														stroke-miterlimit="10" stroke-width="2"></circle>
												</svg>
											</div>
											<div class="ms-2">
												<p class="mb-0 text-ex-small">
													It is a long established fact
												</p>
												<p class="text-small mb-0">2 hous ago</p>
											</div>
										</div>
									</a>
								</li>

								<li>
									<a class="notifications-items" href="#">
										<div class="d-flex align-items-center">
											<div class="mr-2">
												<svg id="notification" xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24">
													<g id="icon_notification" data-name="icon/notification">
														<rect id="Rectangle" width="14" height="19"
															fill="rgba(216,216,216,0)"></rect>
														<g id="Group" transform="translate(4.8 2.88)">
															<g id="Path" transform="translate(0 1.92)" fill="none"
																stroke-miterlimit="10">
																<path
																	d="M14.4,14.821a.537.537,0,0,1-.535.539H.534A.537.537,0,0,1,0,14.821V7.253a7.2,7.2,0,1,1,14.4,0Z"
																	stroke="none"></path>
																<path
																	d="M 12.39999961853027 13.35999965667725 L 12.39999961853027 7.252949714660645 C 12.39999961853027 4.356459617614746 10.06728935241699 1.99999988079071 7.199999809265137 1.99999988079071 C 4.332709789276123 1.99999988079071 1.999999761581421 4.356459617614746 1.999999761581421 7.252949714660645 L 1.999999761581421 13.35999965667725 L 9.115189552307129 13.35999965667725 L 9.123849868774414 13.35999965667725 L 12.39999961853027 13.35999965667725 M 13.86516952514648 15.35999965667725 L 9.123849868774414 15.35999965667725 C 9.120960235595703 15.35999965667725 9.118080139160156 15.35999965667725 9.115189552307129 15.35999965667725 L 0.5338698029518127 15.35999965667725 C 0.2395198047161102 15.35999965667725 -1.907348661234209e-07 15.11872005462646 -1.907348661234209e-07 14.82123947143555 L -1.907348661234209e-07 7.252949714660645 C -1.907348661234209e-07 3.253889799118042 3.229179859161377 -1.716613837743353e-07 7.199999809265137 -1.716613837743353e-07 C 11.16985988616943 -1.716613837743353e-07 14.39999961853027 3.253889799118042 14.39999961853027 7.252949714660645 L 14.39999961853027 14.82123947143555 C 14.39999961853027 15.11872005462646 14.16047954559326 15.35999965667725 13.86516952514648 15.35999965667725 Z"
																	stroke="none" fill="#6f7e90"></path>
															</g>
															<path id="Rectangle-2" data-name="Rectangle"
																d="M0,0H4.8a0,0,0,0,1,0,0V.48a2.4,2.4,0,0,1-2.4,2.4h0A2.4,2.4,0,0,1,0,.48V0A0,0,0,0,1,0,0Z"
																transform="translate(4.8 16.32)" fill="#6f7e90"></path>
															<rect id="Rectangle-3" data-name="Rectangle" width="4.8"
																height="3.84" rx="1.92" transform="translate(4.8)"
																fill="#6f7e90"></rect>
														</g>
													</g>
													<circle class="alertNotification" cx="3.5" cy="3.5" r="3.5"
														transform="translate(14 4)" fill="#e02020" stroke="#f0f2f8"
														stroke-miterlimit="10" stroke-width="2"></circle>
												</svg>
											</div>
											<div class="ms-2">
												<p class="mb-0 text-ex-small">
													It is a long established fact
												</p>
												<p class="text-small mb-0">2 hous ago</p>
											</div>
										</div>
									</a>
								</li>


								<li>
									<a class="notifications-items" href="#">
										<div class="d-flex align-items-center">
											<div class="mr-2">
												<svg id="notification" xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24">
													<g id="icon_notification" data-name="icon/notification">
														<rect id="Rectangle" width="14" height="19"
															fill="rgba(216,216,216,0)"></rect>
														<g id="Group" transform="translate(4.8 2.88)">
															<g id="Path" transform="translate(0 1.92)" fill="none"
																stroke-miterlimit="10">
																<path
																	d="M14.4,14.821a.537.537,0,0,1-.535.539H.534A.537.537,0,0,1,0,14.821V7.253a7.2,7.2,0,1,1,14.4,0Z"
																	stroke="none"></path>
																<path
																	d="M 12.39999961853027 13.35999965667725 L 12.39999961853027 7.252949714660645 C 12.39999961853027 4.356459617614746 10.06728935241699 1.99999988079071 7.199999809265137 1.99999988079071 C 4.332709789276123 1.99999988079071 1.999999761581421 4.356459617614746 1.999999761581421 7.252949714660645 L 1.999999761581421 13.35999965667725 L 9.115189552307129 13.35999965667725 L 9.123849868774414 13.35999965667725 L 12.39999961853027 13.35999965667725 M 13.86516952514648 15.35999965667725 L 9.123849868774414 15.35999965667725 C 9.120960235595703 15.35999965667725 9.118080139160156 15.35999965667725 9.115189552307129 15.35999965667725 L 0.5338698029518127 15.35999965667725 C 0.2395198047161102 15.35999965667725 -1.907348661234209e-07 15.11872005462646 -1.907348661234209e-07 14.82123947143555 L -1.907348661234209e-07 7.252949714660645 C -1.907348661234209e-07 3.253889799118042 3.229179859161377 -1.716613837743353e-07 7.199999809265137 -1.716613837743353e-07 C 11.16985988616943 -1.716613837743353e-07 14.39999961853027 3.253889799118042 14.39999961853027 7.252949714660645 L 14.39999961853027 14.82123947143555 C 14.39999961853027 15.11872005462646 14.16047954559326 15.35999965667725 13.86516952514648 15.35999965667725 Z"
																	stroke="none" fill="#6f7e90"></path>
															</g>
															<path id="Rectangle-2" data-name="Rectangle"
																d="M0,0H4.8a0,0,0,0,1,0,0V.48a2.4,2.4,0,0,1-2.4,2.4h0A2.4,2.4,0,0,1,0,.48V0A0,0,0,0,1,0,0Z"
																transform="translate(4.8 16.32)" fill="#6f7e90"></path>
															<rect id="Rectangle-3" data-name="Rectangle" width="4.8"
																height="3.84" rx="1.92" transform="translate(4.8)"
																fill="#6f7e90"></rect>
														</g>
													</g>
													<circle class="alertNotification" cx="3.5" cy="3.5" r="3.5"
														transform="translate(14 4)" fill="#e02020" stroke="#f0f2f8"
														stroke-miterlimit="10" stroke-width="2"></circle>
												</svg>
											</div>
											<div class="ms-2">
												<p class="mb-0 text-ex-small">
													It is a long established fact
												</p>
												<p class="text-small mb-0">2 hous ago</p>
											</div>
										</div>
									</a>
								</li>


								<li>
									<a class="notifications-items" href="#">
										<div class="d-flex align-items-center">
											<div class="mr-2">
												<svg id="notification" xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24">
													<g id="icon_notification" data-name="icon/notification">
														<rect id="Rectangle" width="14" height="19"
															fill="rgba(216,216,216,0)"></rect>
														<g id="Group" transform="translate(4.8 2.88)">
															<g id="Path" transform="translate(0 1.92)" fill="none"
																stroke-miterlimit="10">
																<path
																	d="M14.4,14.821a.537.537,0,0,1-.535.539H.534A.537.537,0,0,1,0,14.821V7.253a7.2,7.2,0,1,1,14.4,0Z"
																	stroke="none"></path>
																<path
																	d="M 12.39999961853027 13.35999965667725 L 12.39999961853027 7.252949714660645 C 12.39999961853027 4.356459617614746 10.06728935241699 1.99999988079071 7.199999809265137 1.99999988079071 C 4.332709789276123 1.99999988079071 1.999999761581421 4.356459617614746 1.999999761581421 7.252949714660645 L 1.999999761581421 13.35999965667725 L 9.115189552307129 13.35999965667725 L 9.123849868774414 13.35999965667725 L 12.39999961853027 13.35999965667725 M 13.86516952514648 15.35999965667725 L 9.123849868774414 15.35999965667725 C 9.120960235595703 15.35999965667725 9.118080139160156 15.35999965667725 9.115189552307129 15.35999965667725 L 0.5338698029518127 15.35999965667725 C 0.2395198047161102 15.35999965667725 -1.907348661234209e-07 15.11872005462646 -1.907348661234209e-07 14.82123947143555 L -1.907348661234209e-07 7.252949714660645 C -1.907348661234209e-07 3.253889799118042 3.229179859161377 -1.716613837743353e-07 7.199999809265137 -1.716613837743353e-07 C 11.16985988616943 -1.716613837743353e-07 14.39999961853027 3.253889799118042 14.39999961853027 7.252949714660645 L 14.39999961853027 14.82123947143555 C 14.39999961853027 15.11872005462646 14.16047954559326 15.35999965667725 13.86516952514648 15.35999965667725 Z"
																	stroke="none" fill="#6f7e90"></path>
															</g>
															<path id="Rectangle-2" data-name="Rectangle"
																d="M0,0H4.8a0,0,0,0,1,0,0V.48a2.4,2.4,0,0,1-2.4,2.4h0A2.4,2.4,0,0,1,0,.48V0A0,0,0,0,1,0,0Z"
																transform="translate(4.8 16.32)" fill="#6f7e90"></path>
															<rect id="Rectangle-3" data-name="Rectangle" width="4.8"
																height="3.84" rx="1.92" transform="translate(4.8)"
																fill="#6f7e90"></rect>
														</g>
													</g>
													<circle class="alertNotification" cx="3.5" cy="3.5" r="3.5"
														transform="translate(14 4)" fill="#e02020" stroke="#f0f2f8"
														stroke-miterlimit="10" stroke-width="2"></circle>
												</svg>
											</div>
											<div class="ms-2">
												<p class="mb-0 text-ex-small">
													It is a long established fact
												</p>
												<p class="text-small mb-0">2 hous ago</p>
											</div>
										</div>
									</a>
								</li>

							</ul>
						</div>


						<div class="dropdown">
							<button class="btn profile-btn dropdown-toggle p-0 text-white border-0 d-flex align-items-center" type="button" id="profile"
								data-display="static" data-bs-toggle="dropdown" aria-expanded="false">
								<span class="user-image me-1">
									<img src="assets/images/auth-image.jpg" alt="" />
								</span>
								<span class="d-none ps-1 d-md-block">
									Pawel Kuna
								</span>
							</button>
							<ul class="dropdown-menu dropdown-custom dropdown-menu-end" aria-labelledby="profile">
								<li><a class="dropdown-item" href="#">My Account</a></li>
								<li><a class="dropdown-item" href="#">Account Settings</a></li>
								<hr class="my-2" />
								<li><a class="dropdown-item" href="#">Log Out</a></li>
							</ul>
						</div>


					</div>
				
			</div>
		</nav>
	</header>




	<section id="body-content" class="">
		<div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">

			<div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                      </nav>
                </div>
            </div>
            <div class="row pb-4">
				<div class="col-sm-6 text-white my-auto">
					
					<h3 class="mb-0">Navbar overlap layout</h3>
				</div>


				<div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
					<button class="btn btn-light">New view</button>
					<button class="btn btn-primary d-flex align-items-center ms-2">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-plus" viewBox="0 0 16 16">
							<path
								d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
						</svg>
						<span class="d-none d-md-block">Create new report</span>
					</button>
				</div>

			</div>

			<div class="bg-white rounded page-height mt-3 shadow">

            </div>
		</div>
	</section>



	<footer id="footer" class="bg-light py-3 text-dark text-center">
		Copyright © 2021 Hey Blinds. All rights reserved.
	</footer>

</body>



<!-- jquery import -->

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
<script type='text/javascript' src='assets/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='assets/js/dataTables.bootstrap5.min.js'></script>
<script type='text/javascript' src='assets/js/totalscrpit.js'></script>

</html>