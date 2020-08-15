<?php

namespace phpngaos\Controller;

use phpngaos\Bootstrap\Url;
use phpngaos\Bootstrap\View;
use phpngaos\Bootstrap\Config;
use phpngaos\Bootstrap\Session;
use thiagoalessio\TesseractOCR\TesseractOCR;

class Welcome
{
    private $errorMessage;

    public function indexHandler()
    {
        return View::load("content");
    }

    public function UploadValidation(array $filesForm)
    {
        $path = __DIR__ . "/../../" . Config::get("storage_location");
        $allowedFile = ["jpg", "jpeg", "png"];

        if (!is_dir($path)) {
            $this->setErrorMessage("Storage location not found!");
            return false;
        }

        if (!is_writeable($path)) {
            $this->setErrorMessage("Unable to write to storage location!");
            return false;
        }

        if (empty($filesForm['file']['tmp_name'])) {
            $this->setErrorMessage("File is not uploaded!");
            return false;
        }

        $ext = strtolower(pathinfo($filesForm['file']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedFile)) {
            $this->setErrorMessage("File extension is not allowed!");
            return false;
        }

        return true;
    }

    public function handleUpload()
    {
        if (!$this->UploadValidation($_FILES)) {
            Session::set("error_message", $this->getErrorMessage());
            return Url::Redirect("/");
        }

        $path = __DIR__ . "/../../" . Config::get("storage_location");
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
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

    /**
     * Get the value of errorMessage
     *
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set the value of errorMessage
     *
     * @param   mixed  $errorMessage  
     *
     * @return  self
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }
}
