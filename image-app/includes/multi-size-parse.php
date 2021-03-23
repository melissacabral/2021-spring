<?php 
$feedback = '';
$feedback_class = '';
$errors = array();

if( isset($_POST['did_upload']) ){
	//upload configuration 
	//this directory must exist and be writable
	$target_directory = 'uploads/';

	//NEW: multidimensional array since each size is more complex now
	$sizes = array(
		'small' 	=> array(
			'max_width' => 150,
			'crop'		=> true,
		),
		'medium'	=> array(
			'max_width' => 300,
			'crop'		=> true,
		),
		'large'		=> array(
			'max_width' => 700,
			'crop'		=> false,
		),
	);

	//grab the image that they uploaded
	$uploadedfile = $_FILES['uploadedfile']['tmp_name'];

	//validate
	$valid = true;

	//get the dimensions of the image
	list( $width, $height ) = getimagesize( $uploadedfile );

	//does the image contain pixels?
	if( $width == 0 OR $height == 0 ){
		//NOT AN IMAGE
		$valid = false;
		$errors['size'] = 'Your image does not meet the minimum size requirements.';
	}

	//if valid, process and resize the image
	if($valid){

		//get the filetype
		$filetype = $_FILES['uploadedfile']['type'];

		switch( $filetype ){
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/pjpeg':
			$src = imagecreatefromjpeg( $uploadedfile );
			break;

			case 'image/gif':
			$src = imagecreatefromgif( $uploadedfile );
			break;

			case 'image/png':
				//todo: increase resources on the server
			$src = imagecreatefrompng( $uploadedfile );
			break;
		}

		//unique string for the final file name
		$unique_name = sha1( microtime() );

		//do the resizing
		foreach( $sizes AS $size_name => $atts ){
			//NEW get $max_width and $crop from the array
			extract($atts);

			//crop?
			if($crop){
				//square crop calculations -  landscape or portrait
				if( $width > $height ){
					//landscape
					$offset_x = ( $width - $height ) / 2 ;
					$offset_y = 0;
					$crop_width = $height;
				}else{
					//portrait or square
					$offset_x = 0;
					$offset_y = ( $height - $width ) / 2;
					$crop_width = $width;
				}
				//make squares
				$max_height = $max_width;
				$crop_height = $crop_width;
			}else{
				//preserve aspect ratio
				//no crop - no offset needed - use coordinate (0,0)
				$offset_x = 0;
				$offset_y = 0;

				//get the correct max height from original aspect ratio (if the image is big enough)
				if($width >= $max_width){
					$max_height = ($max_width * $height) / $width;
				}else{
					//small image - keep original size
					$max_height = $height;
					$max_width = $width;
				}
								
				$crop_width = $width;
				$crop_height = $height;
				
			}
			//create a new blank canvas of the desired size
			$tmp_canvas = imagecreatetruecolor( $max_width, $max_height );

			//scale and align the original onto the tmp canvas
			//dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h
			imagecopyresampled( $tmp_canvas, $src, 0, 0, $offset_x, $offset_y, $max_width, $max_height, $crop_width, $crop_height );

			//save it into the correct directory
			//something like 	uploads/fdkuhfdghjkfdg_small.jpg
			$filepath = $target_directory . $unique_name . '_' . $size_name . '.jpg';

			$did_save = imagejpeg( $tmp_canvas, $filepath, 70 );

		}//end foreach size

		//clean up old resources
		imagedestroy($src);
		imagedestroy($tmp_canvas);


		//if it uploaded, Add new post to Database
		if( $did_save ){
			$data = array(
				'user_id' 	=> $logged_in_user['user_id'],
				'image' 	=> $unique_name,
			);
			$result = $DB->prepare('INSERT INTO posts
				(image, title, category_id, body, date, user_id, allow_comments, is_published)
				VALUES 
				(:image, "", 0, "", now(), :user_id, 0, 0 ) ');
			$result->execute($data);

			if($result->rowCount() >= 1){
				//success! redirect to step 2
				$feedback = 'Success';
				$feedback_class = 'success';

				$post_id = $DB->lastInsertId();
				
				header("Location:edit-post.php?post_id=$post_id");
			
			}else{
				//database error
				$feedback = 'Sorry, the post could not be saved.';
				$feedback_class = 'error';
			}

		}else{
			$feedback = 'Sorry, the file could not be saved.';
			$feedback_class = 'error';
		}

	}//end if valid
	else{
		$feedback = 'There was a problem uploading your image, fix the following:';
		$feedback_class = 'error';
	}

} //end new post parser