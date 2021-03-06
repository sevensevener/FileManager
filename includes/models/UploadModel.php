<?php

    /**
        * Class: UploadModel
        * @function: uploadFile
    */

    class UploadModel {

        /**
            * Upload file
            * @param: $path(string), $files(array)
            * @return: $msg(object)
        */
        public static function uploadFile($path, $files){

            $msg = array();

            // Check if path exists

            if (file_exists($path)){

                if (isset($files) && !empty($files)){

                    // Get number of files

                    $numberOfFiles = count($files["name"]);

                    for ($i = 0; $i < $numberOfFiles; $i++){

                        if ($files["error"][$i] > 0){

                            // File couldn't be uploaded

                            $msg[] = array(
                                "file_name" => $files["name"][$i],
                                "file_path" => $path,
                                "message" => "File couldn't be uploaded: " . $files["error"][$i]
                            );

                        } else {

                            if (file_exists($path . "/" . $files["name"][$i])){

                                // File already exists

                                $msg[] = array(
                                    "file_name" => $files["name"][$i],
                                    "file_path" => $path,
                                    "message" => "File already exists: " . $path . "/" . $files["name"][$i]
                                );

                            } else {

                                // File successfully uploaded

                                move_uploaded_file($files["tmp_name"][$i], $path . "/" . $files["name"][$i]);

                                $msg[] = array(
                                    "file_name" => $files["name"][$i],
                                    "file_path" => $path,
                                    "message" => "File successfully uploaded: " . $path . "/" . $files["name"][$i]
                                );

                                // Save upload in db

                                $db = new Database();
                                $sql = "INSERT INTO file(filename, path, userID, dateUploaded) VALUES('" . $files["name"][$i] ."', '" . $path . "', 1, '" . date("Y-m-d H:i:s") . "')";
                                $db->query($sql);

                            };

                        };

                    };

                } else {

                    // No file uploaded

                    $msg[] = array(
                        "file_path" => $path,
                        "message" => "No file uploaded"
                    );

                };

            } else {

                // Folder doesn't exists

                $msg[] = array(
                    "file_path" => $path,
                    "message" => "Folder doesn't exists"
                );

            };

            return (object) $msg;

        }

    }

?>