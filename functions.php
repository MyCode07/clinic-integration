<?php

function pre($obj)
{
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}


function format_num($num, $symbols = 2)
{
    if (!$num) return;

    return number_format($num, $symbols, '.');
}


function calc_to_percent($min, $max, $current, $norm)
{
    if (!$min || !$max || !$current || !$norm) return;


    $norma_percent =  ($norm / $max) * 100;
    $patient_percent = ($current / $max) * 100;

    $norma_percent = format_num($norma_percent);
    $patient_percent = format_num($patient_percent);

    return [
        'norma' => $norma_percent . '%',
        'patient' => $patient_percent . '%',
    ];
}


function get_table_row($array, $template = 'nutrition-table-row')
{
    $i = 0;
    foreach ($array as $item) :
        if ($i == 0) {
            $class = 'parent';
        } else {
            if ($item['mass'] > $item['norm']) {
                $class = 'red';
            } else {
                $class = 'blue';
            }
        }
        include 'template-parts/' . $template . '.php';

        $i++;
    endforeach;
}
