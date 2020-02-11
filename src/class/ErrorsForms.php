<?php

class ErrorsForms{

    public function getMsg($erro)
    {
        $json_errors = file_exists(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "errors.json") ? ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "errors.json": "src" . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "errors.json";
        $content_erros = file_get_contents($json_errors);
        $transform = json_decode($content_erros, true);
        if(!empty($erro))
        {
            foreach ($transform as $line)
            {
                if($line["codigo"] == $erro)
                {
                    $response = "<div class='erro'>" . $line["message"] . "</div>";
                    break;
                }
            }
            return $response;
        }
    }
}


?>