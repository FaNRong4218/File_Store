<?php
if(isset($_GET['file1'])){
    $file1 = $_GET['file1'];
    $No = $file1;
}
if(isset($_GET['file2'])){
    $file2 = $_GET['file2'];
    $No = $file2;
}
if(isset($_GET['file3'])){
    $file3 = $_GET['file3'];
    $No = $file3;
}

    $download = 'myFile/'.$No;

    if(file_exists($download)){
        $path_parts = pathinfo($No);
        $ext = strtolower($path_parts["extension"]);
        switch ($ext) 
    {
      case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "pptx": $ctype="application/vnd.openxmlformats-officedocument.presentationml.presentation"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "tif": $ctype="image/tif";break;
      case "tiff": $ctype="image/tiff";break;
      case "jpg": $ctype="image/jpg"; break;
      case "rar": $ctype="application/vnd.rar"; break;
      case "zip": $ctype="application/zip"; break;
      case "mp3": $ctype="audio/mpeg"; break;
      case "mp4": $ctype="video/mp4"; break;
      case "txt": $ctype="text/plain"; break;
      default: $ctype="application/force-download";
    }
        header("Pragma: public"); 
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 
        header("Content-Type: $ctype");
        header("Content-Disposition: attachment; filename=\"".basename($download)."\";" );
        header("Content-Transfer-Encoding: binary");
        header('Content-Length '. filesize($download));
        ob_clean();
        flush();
        readfile($download);
        exit;
    }
