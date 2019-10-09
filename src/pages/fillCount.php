<?php

function counting($numbem_of_records)
{
    if(!count($numbem_of_records))
    {
        echo "<div class='TableBody' style='border: none'>";
            echo "<div class='tam100'>Não há registros</div>";
        echo "</div>";
    }
}

?>