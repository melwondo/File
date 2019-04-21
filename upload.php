<?php

if (isset($_POST['submit'])){
    
    if(count($_FILES['fichier']['name']) > 0){
        
        for($i=0; $i<count($_FILES['fichier']['name']); $i++) {

            
            $fileTmpName = $_FILES['fichier']['tmp_name'][$i];
            
            $filename = $_FILES['fichier']['name'][$i];
            $fileType = $_FILES['fichier']['type'][$i];
            $fileSize = $_FILES['fichier']['size'][$i];
            $fileError = $_FILES['fichier']['error'][$i];
            $fileExt = explode('.', $filename);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg','png','gif');


            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize <  1000000) {
                        $uploadDir = 'uploads/';
                        $uploadFile = $uploadDir . uniqid('image', true)."." .$fileActualExt;
                        move_uploaded_file($_FILES['fichier']['tmp_name'][$i], $uploadFile);
                        header('Location: index.php');
                    } else {
                        echo 'Le fichier doit être inférieur à 1 mo ';
                    }
                } else {
                    echo 'erreur pendant l\'upload ';
                }
            } else {
                echo 'Pas le bon format pour l\'image ' .$filename. '<br>';
            }
        }
    
    }

}


