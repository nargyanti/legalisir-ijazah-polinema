<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Image to PDF</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
	<div class="container mt-4">
		<h1 class="mb-4">Legalisir Ijazah</h1>

		<?php if (isset($error)) : ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $error; ?>
			</div>
		<?php endif; ?>

		<form action="<?php echo base_url('convert'); ?>" method="post" enctype="multipart/form-data">
			<div class="mb-4">
				<label class="form-label" for="image">Upload ijazah</label>
				<input type="file" class="form-control" id="image" name="image" required />
				<div id="imageHelpBlock" class="form-text">
					Max size 2MB | File .jpg .jpeg .png
				</div>
			</div>
			<input type="submit" value="Upload" class="btn btn-primary">

		</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>