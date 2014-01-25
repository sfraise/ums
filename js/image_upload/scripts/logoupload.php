<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/21/14
 * Time: 8:27 PM
 */

session_start();

// INCLUDE INIT FILE
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

// Get Values
$myid = escape($_GET['myid']);
$sitelogo = escape($_GET['sitelogo']);
$token = escape($_GET['token']);

if (Token::check($token)) {
    echo $relPath;
    $NUM = time();
    function uploadImage($fileName, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH = null)
    {
        $folder = $relPath;
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $maxlimit = $maxSize;
        $allowed_ext = "jpg,jpeg,gif,png,bmp";
        $match = "";
        $filesize = $_FILES[$fileName]['size'];
        if ($filesize > 0) {
            $filename = strtolower($_FILES[$fileName]['name']);
            $filename = preg_replace('/\s/', '_', $filename);
            if ($filesize < 1) {
                $errorList[] = "File size is empty.";
            }
            if ($filesize > $maxlimit) {
                $errorList[] = "File size is too big.";
            }
            if (count($errorList) < 1) {
                $file_ext = preg_split("/\./", $filename);
                $allowed_ext = preg_split("/\,/", $allowed_ext);
                foreach ($allowed_ext as $ext) {
                    if ($ext == end($file_ext)) {
                        $match = "1"; // File is allowed
                        $NUM = time();
                        $front_name = substr($file_ext[0], 0);
                        $newfilename = $front_name . "_" . $NUM . "." . end($file_ext);
                        $filetype = end($file_ext);
                        $save = $folder . $newfilename;

                        if (!file_exists($save)) {
                            list($width_orig, $height_orig) = getimagesize($_FILES[$fileName]['tmp_name']);
                            if ($maxH == null) {
                                if ($width_orig < $maxW) {
                                    $fwidth = $width_orig;
                                } else {
                                    $fwidth = $maxW;
                                }
                                $ratio_orig = $width_orig / $height_orig;
                                $fheight = $fwidth / $ratio_orig;

                                $blank_height = $fheight;
                                $top_offset = 0;

                            } else {
                                if ($width_orig <= $maxW && $height_orig <= $maxH) {
                                    $fheight = $height_orig;
                                    $fwidth = $width_orig;
                                } else {
                                    if ($width_orig > $maxW) {
                                        $ratio = ($width_orig / $maxW);
                                        $fwidth = $maxW;
                                        $fheight = ($height_orig / $ratio);
                                        if ($fheight > $maxH) {
                                            $ratio = ($fheight / $maxH);
                                            $fheight = $maxH;
                                            $fwidth = ($fwidth / $ratio);
                                        }
                                    }
                                    if ($height_orig > $maxH) {
                                        $ratio = ($height_orig / $maxH);
                                        $fheight = $maxH;
                                        $fwidth = ($width_orig / $ratio);
                                        if ($fwidth > $maxW) {
                                            $ratio = ($fwidth / $maxW);
                                            $fwidth = $maxW;
                                            $fheight = ($fheight / $ratio);
                                        }
                                    }
                                }
                                if ($fheight == 0 || $fwidth == 0 || $height_orig == 0 || $width_orig == 0) {
                                    die("FATAL ERROR REPORT ERROR CODE [add-pic-line-67-orig] to <a href='http://www.atwebresults.com'>AT WEB RESULTS</a>");
                                }
                                if ($fheight < 45) {
                                    $blank_height = 45;
                                    $top_offset = round(($blank_height - $fheight) / 2);
                                } else {
                                    $blank_height = $fheight;
                                }
                            }
                            $image_p = imagecreatetruecolor($fwidth, $blank_height);
                            $white = imagecolorallocate($image_p, $colorR, $colorG, $colorB);
                            imagefill($image_p, 0, 0, $white);
                            switch ($filetype) {
                                case "gif":
                                    $image = @imagecreatefromgif($_FILES[$fileName]['tmp_name']);
                                    break;
                                case "jpg":
                                    $image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
                                    break;
                                case "jpeg":
                                    $image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
                                    break;
                                case "png":
                                    $image = @imagecreatefrompng($_FILES[$fileName]['tmp_name']);
                                    break;
                            }
                            @imagecopyresampled($image_p, $image, 0, $top_offset, 0, 0, $fwidth, $fheight, $width_orig, $height_orig);
                            switch ($filetype) {
                                case "gif":
                                    if (!@imagegif($image_p, $save)) {
                                        $errorList[] = "PERMISSION DENIED [GIF]";
                                    }
                                    break;
                                case "jpg":
                                    if (!@imagejpeg($image_p, $save, 100)) {
                                        $errorList[] = "PERMISSION DENIED [JPG]";
                                    }
                                    break;
                                case "jpeg":
                                    if (!@imagejpeg($image_p, $save, 100)) {
                                        $errorList[] = "PERMISSION DENIED [JPEG]";
                                    }
                                    break;
                                case "png":
                                    if (!@imagepng($image_p, $save, 0)) {
                                        $errorList[] = "PERMISSION DENIED [PNG]";
                                    }
                                    break;
                            }
                            @imagedestroy($filename);
                        } else {

                        }
                    }
                }
            }
        } else {
            $errorList[] = "NO FILE SELECTED";
        }
        if (!$match) {
            $errorList[] = "File type isn't allowed: $filename";
        }
        if (sizeof($errorList) == 0) {
            return $fullPath . $newfilename;
        } else {
            $eMessage = array();
            for ($x = 0; $x < sizeof($errorList); $x++) {
                $eMessage[] = $errorList[$x];
            }
            return $eMessage;
        }
    }

    $filename = strip_tags($_REQUEST['filename']);
    $maxSize = strip_tags($_REQUEST['maxSize']);
    $maxW = strip_tags($_REQUEST['maxW']);
    $fullPath = strip_tags($_REQUEST['fullPath']);
    $relPath = strip_tags($_REQUEST['relPath']);
    $colorR = strip_tags($_REQUEST['colorR']);
    $colorG = strip_tags($_REQUEST['colorG']);
    $colorB = strip_tags($_REQUEST['colorB']);
    $maxH = strip_tags($_REQUEST['maxH']);
    $filesize_image = $_FILES[$filename]['size'];
    if ($filesize_image > 0) {
        $upload_image = uploadImage($filename, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH);
        if (is_array($upload_image)) {
            foreach ($upload_image as $key => $value) {
                if ($value == "-ERROR-") {
                    unset($upload_image[$key]);
                }
            }
            $document = array_values($upload_image);
            for ($x = 0; $x < sizeof($document); $x++) {
                $errorList[] = $document[$x];
            }
            $imgUploaded = false;
        } else {
            $imgUploaded = true;
        }
    } else {
        $imgUploaded = false;
        $errorList[] = "File Size Empty";
    }

    if ($imgUploaded) {
// GET SITE DATA
        $sitedata = DB::getInstance();
        $getsitedata = $sitedata->query('SELECT * FROM site_data');
        if(!$getsitedata->count()) {
            echo 'error';
        } else {
            foreach($getsitedata->results() as $siteinfo) {
                $oldimage = $siteinfo->logo;
            }
        }
        if($oldimage) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $oldimage);
        }

        $myfilenameraw = $_FILES[$filename]['name'];
        $myfilenamefront = pathinfo($myfilenameraw, PATHINFO_FILENAME);
        $myfileext = pathinfo($myfilenameraw, PATHINFO_EXTENSION);
        $myfilenamens = $myfilenamefront . "_" . $NUM . "." . $myfileext;
        $myfilename = strtolower(str_replace(' ', '_', $myfilenamens));
        $myimgpath = "/images/logo/" . $myfilename . "";

        // UPDATE THE DATABASE
        try {
            $sitedata->query("UPDATE site_data SET logo = '$myimgpath' WHERE id = 1");
            ?>
            <script type="text/javascript">
                $(".update_logo", parent.window.document).attr("src", "<?php echo $myimgpath; ?>");
                $("#site_logo", parent.window.document).attr("src", "<?php echo $myimgpath; ?>");
            </script>
            <?php
            echo 'Update Image';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {
        echo '<img src="/js/image_upload/images/error.gif" width="16" height="16px" border="0" style="marin-bottom: -3px;" /> Error(s) Found: ';
        foreach ($errorList as $value) {
            echo $value . ', ';
        }
    }

    $divid = "update_logo";
    $uploadarea = "update_logo_upload_area";
} else {
    echo 'Token validation failed!';
}
?>
<script type="text/javascript">
    $('#<?php echo $uploadarea; ?>', parent.window.document).show();
</script>