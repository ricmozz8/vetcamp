<?php
public function getFile($disk, $path)
    {
        try {
            $file_contents = Storage::get($disk, $path);
            echo $file_contents;
            // Set the appropriate headers to force a download
           // header('Content-Description: File Transfer');
           // header('Content-Type: application/pdf);
            //header('Content-Disposition: attachment; filename="Dummy_Test_PDF"');
            //header('Expires: 0');
           // header('Cache-Control: must-revalidate');
         //   header('Pragma: public');
         //   header('Content-Length: ' . strlen($file_contents));
           // echo $file_contents;
           // exit;
      //  } catch (\Exception $e) {
       //     abort(404);
        //}
    }
}