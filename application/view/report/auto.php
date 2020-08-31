<table border="1" style="width:100%; font-weight:normal !important ">
    <thead>
    <tr>
        <?php
        if (!empty($arrayConsolidado) > 0 && isset($arrayConsolidado[1])) {
            $keys = array_keys($arrayConsolidado[1]);
            foreach ($keys as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php

    if (!empty($arrayConsolidado) > 0) {
        $keysb = array_keys($arrayConsolidado[1]);
        foreach ($arrayConsolidado as $key => $value) {
            echo "<tr>";
            // if (!is_numeric($value)){
            foreach ($keysb as $key => $keyf) {
                ?>
                <td> <?php echo utf8_decode($value[$keyf]); ?></td>
            <?php }
            // }
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>
