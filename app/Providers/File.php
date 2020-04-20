<?php
namespace App\Providers;

use Seven\File\UploaderTrait;

class File
{
	use UploaderTrait;

	protected $_dest = __DIR__.'/../../public/cdn/';
	protected $_allowed  = [
		'jpg' => 'image/jpeg',
		'png' => 'image/png'
	];
    protected $_limit = 5024768; //5mb
    
    public function uploader($var): array
    {
        if (is_null($var)) {
            return ['status' => false, 'value' => "No file was sent."];
        } 
        return $this->upload($var);
    }

}