<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_crop {
	#########################################################################################################
	# CONSTANTS																								#
	# You can alter the options below																		#
	#########################################################################################################
	public $upload_dir = "./uploads/memphoto"; 				// The directory for the images to be saved in
	public $upload_path = "";				// The path to where the image will be saved
	public $large_image_prefix = "resize_"; 			// The prefix name to large image
	public $thumb_image_prefix = "thumbnail_";			// The prefix name to the thumb image
	public $large_image_name = "";     // New name of the large image (append the timestamp to the filename)
	public $thumb_image_name = "";     // New name of the thumbnail image (append the timestamp to the filename)
	public $max_file = "3"; 							// Maximum file size in MB
	public $max_width = "500";							// Max width allowed for the large image
	public $thumb_width = "100";						// Width of thumbnail image
	public $thumb_height = "100";						// Height of thumbnail image
	// Only one of these image types should be allowed for upload
	public $allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
	public $allowed_image_ext;
	public $image_ext = "";	// initialise variable, do not change this.
	
	
	public function __construct() {
		if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==0){
		    $_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s', time())); //assign the timestamp to the session variable
			$_SESSION['user_file_ext']= "";
		}
		
		$this->upload_path = $this->upload_dir."/";
		$this->large_image_name = $this->large_image_prefix.$_SESSION['random_key'];
		$this->thumb_image_name = $this->thumb_image_prefix.$_SESSION['random_key'];
		
		$this->allowed_image_ext = array_unique($this->allowed_image_types); // do not change this
		
		foreach ($allowed_image_ext as $mime_type => $ext) {
			$image_ext.= strtoupper($ext)." ";
		}
		
		if(!is_dir($this->upload_dir)){
			mkdir($this->upload_dir, 0777);
			chmod($this->upload_dir, 0777);
		}
	}
	
	
	##########################################################################################################
	# IMAGE FUNCTIONS																						 #
	# You do not need to alter these functions																 #
	##########################################################################################################
	function resizeImage($image,$width,$height,$scale) {
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image);
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image);
				break;
			case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image);
				break;
		}
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
		switch($imageType) {
			case "image/gif":
				imagegif($newImage,$image);
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$image,90);
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$image);
				break;
		}
	
		chmod($image, 0777);
		return $image;
	}
	
	//You do not need to alter these functions
	function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
	
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image);
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image);
				break;
			case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image);
				break;
		}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
				imagegif($newImage,$thumb_image_name);
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$thumb_image_name,90);
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);
				break;
		}
		chmod($thumb_image_name, 0777);
		return $thumb_image_name;
	}
	
	//You do not need to alter these functions
	function getHeight($image) {
		$size = getimagesize($image);
		$height = $size[1];
		return $height;
	}
	
	//You do not need to alter these functions
	function getWidth($image) {
		$size = getimagesize($image);
		$width = $size[0];
		return $width;
	}
}