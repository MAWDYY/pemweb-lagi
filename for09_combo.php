<?php
    echo "<select name='tahun'>";
    for ($tahun = 1958; $tahun <= 2022; $tahun++) {
        echo "<option value='". $tahun ."'>". $tahun ."</option>";
    }
    echo "</select>";
?>