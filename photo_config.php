<?php

function resizeImage($CurWidth,$CurHeight,$MaxWidth,$MaxHeight,$DestFolder,$SrcImage)
{
	$ImageScale      	= min($MaxWidth/$CurWidth, $MaxHeight/$CurHeight);
	$NewWidth  		= ceil($ImageScale*$CurWidth);
	$NewHeight 		= ceil($ImageScale*$CurHeight);
	$NewCanves 		= imagecreatetruecolor($NewWidth, $NewHeight);
	// Resize Image
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
	{
		// copy file
		if(imagejpeg($NewCanves,$DestFolder,100))
		{
			imagedestroy($NewCanves);
			return true;
		}
	}
}

?>
