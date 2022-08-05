<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

	<div class="my-48 container mx-auto">

		<div class="scale-100 hover:scale-125 duration-300 shadow-md shadow-2xl py-[7px] flex flex-col rounded-md text-center  mx-auto bg-slate-900 w-50">
			<h1 class="text-ceter text-white text-4xl mb-[18px]">Ayo <?= $username ?> Generate</h1>
			<form action="<?= base_url('api_key/generated'); ?>" method="post">
				<div class="mb-[12px]">
					<label class=" block text-white  mb-[5px]" for="">Token Generate</label>
					<input value="<?= $keys[0]->key ?>" class="text-center w-96 mb-[18px] rounded-lg mt-[7px] px-3 ring-2 ring-pink-500 " type="text" name="generate">

				</div>
				<button class="ring-2 border-none  hover:text-black h-8 hover:bg-slate-200   ring-pink-500 ring-inset px-3  border rounded-lg bg-slate-800 text-white " style=" margin-bottom:15px" type="submit">Generate</button>

			</form>
		</div>
	</div>
	</div>

</body>

</html>