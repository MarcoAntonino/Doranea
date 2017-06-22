<?php
if (isset($_POST["submit"])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$obj = $_POST['obj'];
	$message = $_POST['message'];
	$human = intval($_POST['human']);
	$antispam = intval($_POST['somma']);
	$from = 'Richiesta form Doranea';
	$to = 'infodoranea@gmail.com';
	$subject = 'Richiesta form Doranea';
	$body = "From: $name\n E-Mail: $email\n Object: $obj\n Message:\n $message";
	if (!$_POST['name']) {
		$errName = $_['errName'];
	}
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = $_['errMail'];
	}
	if (!$_POST['obj']) {
		$errObj = $_['errObj'];
	}
	if (!$_POST['message']) {
		$errMess = $_['errMess'];
	}
	if(isset($_POST['g-recaptcha-response']))
	$captcha=$_POST['g-recaptcha-response'];
	$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfNbiMUAAAAAG-aTOj7kHiQBqowAQ-9WFWujli1&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

	if($response['success'] == false)
		{
				$errHuman = $_['errHuman'];
		}



	// If there are no errors, send the email
	if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">' . $_['mailSuccess'] . '</div>';
		} else {
			$result="<div class='alert alert-danger'>" . $_['mailAlert'] . "</div>";
		}
	}
}
$uno=rand(0,9);
$due=rand(0,9);
$somma=$uno+$due;
?>
<div class="page-header" id="banner">
	<section id="contact">
		<div class="row text-center">
			<div class="col-xs-12 col-md-10 col-lg-10">
				<div class="col-sm-offset-2">
				<span class="glyphicon glyphicon-envelope"></span>
				<h3><?=$_['ContattiTitle']?></h3>
				</div>
				<form class="form-horizontal" role="form" method="post" action="index.php?content=mail">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label"><?=$_['NomeLabel']?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="<?=$_['NomePlace']?>" value="">
							<?php echo "<p class='text-danger'>$errName</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label"><?=$_['EmailLabel']?></label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="<?=$_['EmailPlace']?>" value="">
							<?php echo "<p class='text-danger'>$errEmail</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="object" class="col-sm-2 control-label"><?=$_['OggettoLabel']?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="obj" name="obj" placeholder="<?=$_['OggettoPlace']?>" value="">
							<?php echo "<p class='text-danger'>$errObj</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label"><?=$_['messaggioLabel']?></label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message" placeholder="<?=$_['messaggioPlace']?>"></textarea>
							<?php echo "<p class='text-danger'>$errMess</p>";?>
						</div>
					</div>
					<div class="form-group">

						<label for="antispam" class="col-sm-2 control-label"><?=$_['antispamLabel']?></label>
						<div class="col-sm-10">

							<div class="g-recaptcha" data-sitekey="6LfNbiMUAAAAAHLb7DeX5vEly48cgL5mkgw6x9iI"></div>
							<?php echo "<p class='text-danger'>$errHuman</p>";?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="<?=$_['submitButton']?>" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $result; ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
