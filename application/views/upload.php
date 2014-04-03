<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo isset($error) ? $error : NULL; ?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="graphs" size="20" />


<input type="submit" value="upload" />

</form>

</body>
</html>