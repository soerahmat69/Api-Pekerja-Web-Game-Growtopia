<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Registrasi</title>

	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-300">

	<div class="my-48 container mx-auto">

		<div class="scale-100 hover:scale-125 duration-300 shadow-md shadow-2xl py-[7px] rounded-md text-center  mx-auto bg-slate-900 w-80">
			<h1 class="text-ceter text-white text-4xl mb-[18px]">Registrasi Form</h1>
			<form action="<?= base_url('login/registrasi_akun'); ?>" method="post">
				<div class="mb-[12px]">
					<label class=" text-white" for="">masukan username</label>
					<input class=" rounded-lg mt-[7px] ring-2 ring-pink-500 " type="text" name="username">

				</div>
				<div class="mb-[12px]">
					<label class="text-white" for="">masukan password</label>
					<input class="rounded-lg mt-[7px] text-center ring-2 ring-pink-500 " type="text" name="pass">

				</div>
				<button class="ring-2 border-none  hover:text-white h-8 hover:bg-slate-800   ring-pink-500 ring-inset px-3  border rounded-lg bg-slate-200 text-black " style=" margin-bottom:15px" type="submit">Registrasi</button>
				<button class="ring-2 border-none hover:text-black h-8 hover:bg-slate-200  ring-pink-500 ring-inset px-3 bg-slate-800 text-white   border rounded-lg" style="margin-bottom:15px; margin-left:15px"> <a style="text-decoration: none;" href="<?= base_url() ?>index.php/welcome">Login</a></button>
			</form>
		</div>
	</div>
	</div>
</body>

</html>