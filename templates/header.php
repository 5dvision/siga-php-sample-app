<!doctype html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>SiGa sample application PHP</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/style.css">

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
		<script src="assets/js/hwcrypto.js"></script>
		<script src="assets/js/base64js.min.js"></script>
		<script src="assets/js/siga.js"></script>
	</head>
	<body class="d-flex flex-column h-100">
	<main role="main" class="flex-shrink-0">
		<div class="container">
			<h1 class="display-4 pt-5">SiGa sample application PHP </h1>
			<p class="lead pb-3">This is <a href="https://github.com/open-eid/SiGa/wiki" target="_blank">SiGa</a> sample application using PHP</p>
		</div>
		<div class="card" style="width:25rem;" id="spanner">
			<h5 class="card-header">Please wait...</h5>
			<div class="card-body text-center">
				<div class="spinner-border my-2 text-primary" id="spinner" role="status"> 
					<span class="sr-only">Loading...</span> 
				</div> 
			</div>
		</div>
		<div class="container">
			<div class="alert alert-danger" id="errorMessage" style="display:none;"></div>