<html>
  <head>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link href="https://unpkg.com/nanogallery2@2.3.0/dist/css/nanogallery2.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://unpkg.com/nanogallery2@2.3.0/dist/jquery.nanogallery2.min.js"></script>

  </head>
  <body>
<h3>
</h3>
<?php
$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$dirt = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
$dirt .= "://".$_SERVER['SERVER_NAME'];
$path = $_GET['path'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $dirt .= $parts[$i] . "/";
}?>
<a href="../">Up one</a><br>
<?php 
  $dirs = array_filter(glob('*'), 'is_dir');
  if ($path == "") {
    foreach ($dirs as $dir) {
      if (!in_array($file, $exclusions)) {      
          //print "<p>";        
          print "<a href=\"index.php?path=$dir\">$dir</a><br>\n";
      }
    }
  }
  ?>
<div id="nanogallery2"
    // gallery configuration
    data-nanogallery2 = '{ 
      "thumbnailWidth":   "auto",
  	  "thumbnailHeight":  120,
  	  "galleryDisplayMode": "pagination",
  	  "galleryPaginationMode": "numbers",
  	  "thumbnailDisplayOutsideScreen": "false",
      "itemsBaseURL":     "<?php echo $dirt ?>"
    }'
  >
  <!-- content of the gallery -->
  <?php
  $exclusions = array();  
  $files = glob("./".$path."/*.jpg");
  foreach ($files as $file) {
    if (!in_array($file, $exclusions)) {      
        //print "<p>";        
        print "<a href=\"$file\" data-ngthumb=\"$file\">\"$file\"</a>\n";
    }
  }
  ?>
</div>
</body>
</html>
