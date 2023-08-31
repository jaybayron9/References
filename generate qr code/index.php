<?php
require 'vendor/autoload.php'; 

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

if (isset($_POST['generate'])) {  
    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data('Custom QR code contents')
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->logoPath(__DIR__.'/assets/logo.png')
        ->logoResizeToWidth(50)
        ->logoPunchoutBackground(true)
        ->labelText('Jay')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->validateResult(false)
        ->build();
        
        $result->saveToFile(__DIR__.'/qrcode.png');
        
        $dataUri = $result->getDataUri();  

        echo '<img src="qrcode.png" alt="asdf">'; 
}
?>

<form action="" method="POST">
    <button type="submit" name="generate">Generate QR Code</button>
</form> 