<?php


    
   $url_1 = 'http://www.xcodersforyou.com/upload.php';
   $url_2 = 'http://www.nshirur.com/upload.php';
    
    $uploaddir = "uploads/";
    $filename=$_POST['name'];
    $target=$uploaddir.$filename;
    
    $file_name_with_full_path = realpath($target);
       
        $headers = array('Content-Type: multipart/form-data');
	$postfields = array('file'=>'@'.$file_name_with_full_path,"filename" =>$filename);
        
        $ch_1 = curl_init($url_1);
        $ch_2 = curl_init($url_2);      
        
        $options_1 = array(
            CURLOPT_URL => $url_1,
            CURLOPT_HEADER => true,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_RETURNTRANSFER => true
        );
       $options_2 = array(  
            CURLOPT_URL => $url_2,
            CURLOPT_HEADER => true,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_RETURNTRANSFER => 1
       );
        
        curl_setopt_array($ch_1, $options_1);
        curl_setopt_array($ch_2, $options_2);       
        
       
        $mh = curl_multi_init();
        curl_multi_add_handle($mh, $ch_1);
       curl_multi_add_handle($mh, $ch_2);
       

        $running = null;
        do {
           curl_multi_exec($mh, $running);
        } while ($running);

        curl_multi_close($mh);
        
        
?>