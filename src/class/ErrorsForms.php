<?php

class ErrorsForms{

    public function getMsg($erro)
    {
        $json_errors = file_exists("../../data/errors.json") ? "../../data/errors.json": "src/data/errors.json";
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