<?php
if (isset($_FILES["swfupload"]) 
		&& is_uploaded_file($_FILES["swfupload"]["tmp_name"]) 
		/*&& $_FILES["swfupload"]["error"] == 0*/) {

	if (file_exists("files/".$_FILES["swfupload"]["name"])) {
		header("HTTP/1.1 500 Internal Server Error");
		echo 'File Exists';
		exit;
	}
	move_uploaded_file($_FILES["swfupload"]["tmp_name"], "files/".$_FILES["swfupload"]["name"]);
	echo 'finished';
	exit;
}
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Keeko Administration</title>
    <link type="text/css" rel="stylesheet" href="admin/designs/greenglass/xhtml1/yui-reset.css" />
    <link type="text/css" rel="stylesheet" href="admin/designs/greenglass/xhtml1/yui-fonts.css" />
    <link type="text/css" rel="stylesheet" href="admin/designs/greenglass/xhtml1/admin.css" />
	<link type="text/css" rel="stylesheet" href="admin/designs/greenglass/gara/keeko.css" />
    <style type="text/css">
    	@import url('modules/Files/media/css/upload.css');
	</style>

    <script type="text/javascript" src="libs/swfupload-2.1.0/swfupload.js"></script>
	<script type="text/javascript" src="libs/gara/gara-bc.js"></script>
    <script type="text/javascript" src="admin/js/keeko.php"></script>
    <script type="text/javascript" src="modules/Files/js/upload.js"></script>

    </script>
    <link type="text/css" rel="stylesheet" href="admin/designs/greenglass/xhtml1/window.css" />
  </head>
  <body class="keeko">
    <div id="content">

      <h1>Upload</h1>
      <div id="upload">

      </div>
	  <div id="diagButtonBar">
			<input type="button" id="btnCancel" value="{$i18n/cancel}"/>
			<input type="button" id="btnOk" value="{$i18n/ok}"/>
		</div>
    </div>
	
	<script type="text/javascript">
		main("files");
	</script>
  </body>

</html>
 