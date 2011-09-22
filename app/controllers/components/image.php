<?php
/*
 File: /app/controllers/components/image.php
*/
class ImageComponent extends Object
{

	var $tempuploaddir = "img/images";
    /*
    *    Uploads an image and its thumbnail into $folderName/big and $folderName/small respectivley.
    *     the  generated thumnail could either have the same aspect ratio as the uploaded image, or could
    *    be a zoomed and cropped version.

    *     Directions:
    *    In view where you upload the image, make sure your form creation is similar to the following
    *    <?= $form->create('FurnitureSet',array('type' => 'file')); ?>
    *
    *    In view where you upload the image, make sure that you have a file input similar to the following
    *    <?= $form->file('Image/name1'); ?>
    *
    *    In the controller, add the component to your components array
    *    var $components = array("Image");
    *
    *    In your controller action (the parameters are expained below)
    *    $image_path = $this->Image->upload_image_and_thumbnail($this->data,"name1",573,80,"sets",true);
    *    this returns the file name of the result image.  You can  store this file name in the database
    *
    *    Note that your image will be stored in 2 locations:
    *    Image: /webroot/img/$folderName/big/$image_path
    *    Thumbnail:  /webroot/img/$folderName/small/$image_path
    *
    *    Finally in the view where you want to see the images
    *    <?= $html->image('sets/big/'.$furnitureSet['FurnitureSet']['image_path']);
    *     where "sets" is the folder name we saved our pictures in, and $furnitureSet['FurnitureSet']['image_path'] is the file name we stored in the database

    *    Parameters:
    *    $data: CakePHP data array from the form
    *    $datakey: key in the $data array. If you used <?= $form->file('Image/name1'); ?> in your view, then $datakey = name1
    *    $imgscale: the maximum width or height that you want your picture to be resized to
    *    $thumbscale: the maximum width or height that you want your thumbnail to be resized to
    *    $folderName: the name of the parent folder of the images. The images will be stored to /webroot/img/$folderName/big/ and  /webroot/img/$folderName/small/
    *    $square: a boolean flag indicating whether you want square and zoom cropped thumbnails, or thumbnails with the same aspect ratio of the source image
    */
    function upload_image_and_thumbnail($data, $datakey, $imgscale, $thumbscale, $folderName, $square) {
		$filenames = array();
		foreach($data['Image'] as $image){
        if (strlen($image[$datakey]['name'])>4){
                    $error = 0;
                    $tempuploaddir = "img/".$folderName; // the /temp/ directory, should delete the image after we upload
                    $biguploaddir = "img/".$folderName."/scaled"; // the /big/ directory
                    $smalluploaddir = "img/".$folderName."/thumb"; // the /small/ directory for thumbnails

                    // Make sure the required directories exist, and create them if necessary
                    if(!is_dir($tempuploaddir)) mkdir($tempuploaddir,true);
                    if(!is_dir($biguploaddir)) mkdir($biguploaddir,true);
                    if(!is_dir($smalluploaddir)) mkdir($smalluploaddir,true);

                    $filetype = $this->getFileExtension($image[$datakey]['name']);
                    $filetype = strtolower($filetype);

                    if (($filetype != "jpeg")  && ($filetype != "jpg") && ($filetype != "gif") && ($filetype != "png"))
                    {
                        // verify the extension
                        return;
                    }
                    else
                    {
                        // Get the image size
                        $imgsize = GetImageSize($image[$datakey]['tmp_name']);
                    }
					
					$filename = $image[$datakey]['name'];
					$i = 1;
					while (file_exists($tempuploaddir .'/'. $filename)) {
						$filename = substr($image[$datakey]['name'], 0, strlen($image[$datakey]['name']) - strlen('.'.$filetype)) . '-' . $i . '.' . $filetype;
						$i++;
					}

                    settype($filename,"string");
					$tempfile = $tempuploaddir . "/$filename";
                    $resizedfile = $biguploaddir . "/$filename";
                    $croppedfile = $smalluploaddir . "/$filename";

                    if (is_uploaded_file($image[$datakey]['tmp_name']))
                    {
                        // Copy the image into the temporary directory
                        if (!copy($image[$datakey]['tmp_name'],"$tempfile"))
                        {
                            print "Error Uploading File!. $filename";
                            exit();
                        }
                        else {
                            /*
                             *    Generate the big version of the image with max of $imgscale in either directions
                             */
                            $this->resize_img($tempfile, $imgscale, $resizedfile);                            

                            if($square) {
                                /*
                                 *    Generate the small square version of the image with scale of $thumbscale
                                 */
                                $this->crop_img($tempfile, $thumbscale, $croppedfile);
                            }
                            else {
                                /*
                                 *    Generate the big version of the image with max of $imgscale in either directions
                                 */
                                $this->resize_img($tempfile, $thumbscale, $croppedfile);
                            }

                            // Delete the temporary image
                            //unlink($tempfile);
                        }
                    }

                     // Image uploaded, return the file name
                     array_push($filenames, $filename);
        }
		}
		return $filenames;
    }

    /*
    *    Deletes the image and its associated thumbnail
    *    Example in controller action:    $this->Image->delete_image("1210632285.jpg","sets");
    *
    *    Parameters:
    *    $filename: The file name of the image
    *    $folderName: the name of the parent folder of the images. The images will be stored to /webroot/img/$folderName/big/ and  /webroot/img/$folderName/small/
    */
    function delete_image($filename,$folderName) {
        unlink("img/".$folderName."/scaled/".$filename);
        unlink("img/".$folderName."/thumb/".$filename);
		unlink($this->tempuploaddir.'/'.$filename);
    }

    function crop_img($imgname, $scale, $filename) {
        $filetype = $this->getFileExtension($imgname);
        $filetype = strtolower($filetype);

        switch($filetype){
            case "jpeg":
            case "jpg":
              $img_src = imagecreatefromjpeg ($imgname);
             break;
             case "gif":
              $img_src = imagecreatefromgif ($imgname);
             break;
             case "png":
              $img_src = imagecreatefrompng ($imgname);
             break;
        }

        $width = imagesx($img_src);
        $height = imagesy($img_src);
        $ratiox = $width / $height * $scale;
        $ratioy = $height / $width * $scale;

        //-- Calculate resampling
        $newheight = ($width <= $height) ? $ratioy : $scale;
        $newwidth = ($width <= $height) ? $scale : $ratiox;

        //-- Calculate cropping (division by zero)
        $cropx = ($newwidth - $scale != 0) ? ($newwidth - $scale) / 2 : 0;
        $cropy = ($newheight - $scale != 0) ? ($newheight - $scale) / 2 : 0;

        //-- Setup Resample & Crop buffers
        $resampled = imagecreatetruecolor($newwidth, $newheight);
        if($filetype == "png") {
          imagealphablending($resampled, false);
          $color = imagecolortransparent($resampled, imagecolorallocatealpha($resampled, 0, 0, 0, 127));
          imagefill($resampled, 0, 0, $color);
          imagesavealpha($resampled, true);
        }
        $cropped = imagecreatetruecolor($scale, $scale);
        if($filetype == "png") {
          imagealphablending($cropped, false);
          $color = imagecolortransparent($cropped, imagecolorallocatealpha($cropped, 0, 0, 0, 127));
          imagefill($cropped, 0, 0, $color);
          imagesavealpha($cropped, true);
        }

        //-- Resample
        imagecopyresampled($resampled, $img_src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        //-- Crop
        imagecopy($cropped, $resampled, 0, 0, $cropx, $cropy, $newwidth, $newheight);

        // Save the cropped image
        switch($filetype)
        {
            case "jpeg":
            case "jpg":
             imagejpeg($cropped,$filename, 100);
             break;
             case "gif":
             imagegif($cropped,$filename, 100);
             break;
             case "png":
             imagepng($cropped,$filename, 5);
             break;
        }
    }

    function resize_img($imgname, $size, $filename)    {
        $filetype = $this->getFileExtension($imgname);
        $filetype = strtolower($filetype);

        switch($filetype) {
            case "jpeg":
            case "jpg":
            $img_src = imagecreatefromjpeg ($imgname);
            break;
            case "gif":
            $img_src = imagecreatefromgif ($imgname);
            break;
            case "png":
            $img_src = imagecreatefrompng ($imgname);
            break;
        }

        $true_width = imagesx($img_src);
        $true_height = imagesy($img_src);
		
		if ($true_width >= $size) {
			//if ($true_width>=$true_height)
			//{
				$width=$size;
				$height = ($width/$true_width)*$true_height;
			//}
			//else
			//{
				//$height=$size;
				//$width = ($height/$true_height)*$true_width;
			//}
		} else {
			$width = $true_width;
			$height = $true_height;
		}
        $img_des = imagecreatetrueColor($width,$height);
        if($filetype == "png") {
          imagealphablending($img_des, false);
          $color = imagecolortransparent($img_des, imagecolorallocatealpha($img_des, 0, 0, 0, 127));
          imagefill($img_des, 0, 0, $color);
          imagesavealpha($img_des, true);
        }

        imagecopyresampled($img_des, $img_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

        // Save the resized image
        switch($filetype)
        {
            case "jpeg":
            case "jpg":
             imagejpeg($img_des,$filename, 100);
             break;
             case "gif":
             imagegif($img_des,$filename, 100);
             break;
             case "png":
             imagepng($img_des,$filename, 5);
             break;
        }
    }

    function getFileExtension($str) {

        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
} ?>
