<?php
 //   function mkdir(string $pathname, int $mode = 0777, bool $recursive = false, $context = null): bool{}
    function getAllFiles(){
        $allFiles = array();
        $allDirs = glob('uploads/*');
        foreach ($allDirs as $dir) {
            $allFiles = array_merge($allFiles, glob($dir . "/*"));
        }
        return $allFiles;
    }

    function uploadFiles($uploadedFiles){
        $files = array();
        $errors = array();
        $returnFiles=array();
        // Xu li gom du lieu vao tung file da load
        foreach($uploadedFiles as $key => $values){
            if(is_array($values)){
                foreach ($values as $index => $value){
                    $files[$index][$key] = $value;
                }
            }else{
                $files[$key]=$values;
            }
            
        }

        $uploadPath = "../uploads/" . date('d-m-Y', time());
        if(!is_dir($uploadPath)){
            mkdir($uploadPath,0777,true);
        }
       if(is_array(reset($files))){ //nhieu anh
            foreach ($files as $file){
                $result = processUploadFile($file,$uploadPath);
                if($result['error']){
                    $errors[]=$result['message'];
                }else{
                    $returnFiles[]=$result['path'];
                }
            }
       }else{   //1 ảnh
            $result = processUploadFile($files,$uploadPath);
            if($result['error']){
                return array(
                    'errors' => $result['message']
                );
            }else{
                return array(
                    'path' => $result['path']
                );
            }
       }
       return array(
            'errors' => $errors,
            'uploaded_files' => $returnFiles
       );
        
    }
    // Check file hop le
    function validateUploadFile($file, $uploadPath){
        //Kiem tra xem co vuot qua dung luong cho phep khong
        if($file['size'] > 2 * 1024 * 1024){
            return false;
        }

        // Kiem tra xem kieu file co hop le khong
        $validTypes = array("jpg","jpeg","png","bmp");
        $fileType = substr($file['name'], strrpos($file['name'], "." )+ 1);
        if(!in_array($fileType, $validTypes)){
            return false;
        }
        //Kiem tra xem file da ton tai chua? Neu ton tai thi doi ten
        $num=1;
        $fileName=substr($file['name'], 0, strrpos($file['name'], "."));
        while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)){
            $fileName = $fileName . "(" . $num . ")";
            $num++;
        }
        $file['name'] = $fileName . '.' . $fileType;
        return $file;

    }
    function processUploadFile($file,$uploadPath){
        $file = validateUploadFile($file, $uploadPath);
        if($file != false){
            $file['name'] = str_replace(' ','_',$file['name']);
            if(move_uploaded_file($file["tmp_name"], $uploadPath . '/' .$file["name"])){
                return array(
                    'error' => false,
                    'path' => str_replace('../','/',$uploadPath) . '/' . $file['name']
                );
            }
        }else{
            return array(
                'error' => false,
                'message' => "The file ". basename($file["name"]) . " isn't valid."
            );
        }
    }

?>
