<?php

class Downloader {
	
	private $url;
    private $destination;
    private $filename;
    
    public function __construct(string $url, string $destination, string $filename) {
        $this->url = $url;
        $this->destination = $destination;
		$this->filename = $filename;
    }
	
	public function download() {
		$fileDestination = $this->destination . $this->filename;
        $fileContents = file_get_contents($this->url);
		
        file_put_contents($fileDestination, $fileContents);
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'. basename($fileDestination) .'"');
		header('Content-Length: ' . filesize($fileDestination));
		
		readfile($fileDestination);
		
		unlink($fileDestination);
        exit;
    }
	
}

?>
