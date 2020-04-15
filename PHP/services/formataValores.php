<?php
    function formatoDinheiro($numero){
        return 'R$' . number_format($numero, 2, ',', '.');
    }

?>