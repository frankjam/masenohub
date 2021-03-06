<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION["flashes"])) $_SESSION["flashes"] = array();
if (isset($_POST["mail"])) {
	extract($_POST);

	$db = mysqli_connect("remotemysql.com", "0Cr21YkoPg", "B5njh8K6kt", "0Cr21YkoPg", "3306") or die("Could not establish a connection to MySQL.");

	$sql = "SELECT * FROM list WHERE mail = '$mail'";
	$res = mysqli_query($db, $sql) or die(mysqli_error($db));
	$num = mysqli_num_rows($res);

	if ($num > 0) {
		$flash = array('level' => 'warning', 'text' => 'You are already registered.');
		array_push($_SESSION["flashes"], $flash);
	} else {
		$sql = "INSERT INTO list VALUES('$mail')";
		mysqli_query($db, $sql) or die(mysqli_error($db));
		$flash = array('level' => 'success', 'text' => 'You are now registered.');
		array_push($_SESSION["flashes"], $flash);
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Coming Soon | Maseno Hub</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" type="image/png" href="img/favicon.jpg" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.11/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="temp/css/util.css">
	<link rel="stylesheet" type="text/css" href="temp/css/main.css">
</head>

<body>
	<div class="flex-w flex-str size1 overlay1">
		<div class="flex-w flex-col-sb wsize1 bg0 p-l-65 p-t-37 p-b-50 p-r-80 respon1">

			<?php
			if (sizeof($_SESSION["flashes"]) > 0) :
				foreach ($_SESSION["flashes"] as $f) : ?>
					<div class="alert alert-<?= $f["level"]; ?> alert-dismissible fade show" role="alert">
						<strong class="text-capitalize"><?= $f["level"]; ?>!</strong> <?= $f["text"]; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
			<?php endforeach;
				$_SESSION["flashes"] = array();
			endif;
			?>

			<div class="wrappic1">
				<a href="javascript:back();">
					<button class="btn btn-outline-secondary"><i class="pr-2 zmdi zmdi-arrow-left"></i>Go Back</button>
				</a>
			</div>

			<div class="w-full flex-c-m p-t-80 p-b-90">

				<div class="wsize2">
					<h3 class="l1-txt1 p-b-34 respon3">On its way!</h3>
					<p class="m2-txt1 p-b-46">Be the first to know when we're live!</p>

					<form class="contact100-form validate-form m-t-10 m-b-10" method="post">
						<div class="wrap-input100 validate-input m-lr-auto-lg" data-validate="Email is required: ex@abc.xyz">
							<input class="s2-txt1 placeholder0 input100 trans-04" type="text" name="mail" placeholder="Email Address">

							<button class="flex-c-m ab-t-r size2 hov1">
								<i class="zmdi zmdi-long-arrow-right fs-30 cl1 trans-04"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="wsize1 simpleslide100-parent respon2">
			<div class="simpleslide100">
				<div class="simpleslide100-item bg-img1" style="background-image: url('https://picsum.photos/id/0/950/900.jpg');"></div>
				<div class="simpleslide100-item bg-img1" style="background-image: url('https://picsum.photos/id/1019/950/900.jpg');"></div>
				<div class="simpleslide100-item bg-img1" style="background-image: url('https://picsum.photos/id/1021/950/900.jpg');"></div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.11/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js></script>
	<script src="temp/js/main.js"></script>
	<script>
		function back() {
			window.history.back();
		}
	</script>
</body>

</html>