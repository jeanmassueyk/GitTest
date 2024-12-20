<?php
function calcularNumeros($numeros)
{
    $total = 0;

    foreach ($numeros as $numero) {
        $numero = str_replace(',', '.', $numero); // Substitui vírgula por ponto decimal, se houver
        $numero = floatval($numero); // Converte para float

        $total += $numero;
    }

    return $total;
}
//200 Reais da parcela do apartamento//
//150 Reais da parcela da faculdade//
//800 Reais da combustivel //
//150 Reais da parcela da internet //


$numeros = array("200","150","800","150");
$resultado = calcularNumeros($numeros);

echo "O resultado é: " . number_format($resultado, 2, ',', '.'); // Exibe o resultado formatado

?>
