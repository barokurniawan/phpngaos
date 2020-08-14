<?php

namespace phpngaos\Controller;

use Exception;
use phpngaos\Bootstrap\Url;
use phpngaos\Bootstrap\View;
use phpngaos\Bootstrap\Config;
use phpngaos\Bootstrap\Session;
use thiagoalessio\TesseractOCR\TesseractOCR;

class Welcome
{
    public function indexHandler()
    {
        return View::load("content");
    }

    public function handleUpload()
    {
        $path = __DIR__ . "/../../" . Config::get("storage_location");
        $allowedFile = ["jpg", "jpeg", "png"];

        if (!is_dir($path)) {
            Session::set("error_message", "Storage location not found!");
            return Url::Redirect("/");
        }

        if (!is_writeable($path)) {
            Session::set("error_message", "Unable to write to storage location!");
            return Url::Redirect("/");
        }

        if (empty($_FILES['file']['tmp_name'])) {
            Session::set("error_message", "File is not uploaded!");
            return Url::Redirect("/");
        }

        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedFile)) {
            Session::set("error_message", "File extension is not allowed!");
            return Url::Redirect("/");
        }

        $filename = uniqid() . "." . $ext;
        $newFile = $path . $filename;
        $upload = move_uploaded_file($_FILES['file']['tmp_name'], $newFile);
        if (!$upload) {
            Session::set("error_message", "Upload failed!");
            return Url::Redirect("/");
        }

        Session::set("reader_result", (new TesseractOCR($newFile))->run());
        unlink($newFile);
        return Url::Redirect("/");
    }
}
