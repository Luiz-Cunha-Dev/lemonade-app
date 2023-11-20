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
    public static function handleFile($file, $userNickname) {

        $targetFile = self::getProfilePicturePath($file, $userNickname);

        $targetFile = $targetFile . "." . self::getFileExtension($file['name']);

        $isUploadOk = true;

        $isUploadOk = self::checkImage($file);

        $isUploadOk = self::checkFileSize($file);

        $isUploadOk = self::checkFileFormat($file);

        $isUploadOk = move_uploaded_file($file["tmp_name"], $targetFile);

        return $isUploadOk;

    }

    /**
     * Get profile picture path
     * @param array $file
     * @param string $userNickname
     * @return string $targetFile
     */
    public static function getProfilePicturePath($file, $userNickname) {

        $targetDir = '../lemonade/images/';

        $file["name"] = $userNickname . "_" . "ProfilePicture";

        $targetFile = $targetDir . basename($file["name"]);

        return $targetFile;
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
     * @param array $file
     * @return boolean
     */
    private static function checkFileFormat($file) {

        $fileExtension = self::getFileExtension($file['name']);

        if($fileExtension != "jpg" && $fileExtension != "png" && $fileExtension != "jpeg"
        && $fileExtension != "gif" ) {
            return false;
        }

        return true;

    }

    /**
     * Get file extension
     * @param string $file
     * @return string $fileExtension
     */
    public static function getFileExtension($fileString) {
        return strtolower(pathinfo($fileString,PATHINFO_EXTENSION));
    }
    
}
