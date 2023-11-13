<?php

namespace app\utils;

/**
 * File Handler
 * 
 * Handles file validation and upload
 * 
 * @package app\utils
 */ 
class FileHandler {

    /**
     * Handle file upload
     * @param array $file
     * @return boolean
     */
    public static function handleFile($file) {

        $targetDir = '../lemonade/images/';

        $targetFile = $targetDir . basename($file["name"]);

        $isUploadOk = true;

        $isUploadOk = self::checkImage($file);

        $isUploadOk = self::checkFileSize($file);

        $isUploadOk = self::checkFileFormat($targetFile);

        $isUploadOk = move_uploaded_file($file["tmp_name"], $targetFile);

        return $isUploadOk;

    }

    /**
     * Check if image file is a actual image or fake image
     * @param array $file
     * @return boolean
     */
    private static function checkImage($file) {

        $checkImage = getimagesize($file["tmp_name"]);

        if(!$checkImage) {
            return false;
        }

        return true;

    }
    
    /**
     * Check file size
     * @param array $file
     * @return boolean
     */
    private static function checkFileSize($file) {

        if ($file["size"] > 500000) {
            return false;
        }

        return true;
    
    }

    /**
     * Allow certain file formats
     * @param string $fileString
     * @return boolean
     */
    private static function checkFileFormat($fileString) {

        $fileExtension = strtolower(pathinfo($fileString,PATHINFO_EXTENSION));

        if($fileExtension != "jpg" && $fileExtension != "png" && $fileExtension != "jpeg"
        && $fileExtension != "gif" ) {
            return false;
        }

        return true;

    }
    
}
