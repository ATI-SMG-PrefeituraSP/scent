<?php
/** Biblioteca de funções úteis */

namespace App;

class Biblioteca
{
    /**
     * Converte uma data em string no formato d/m/Y para Date
     */
    public static function strToDate($string)
    {
        //captura o dia
        $dd = substr($string, 0, 2);

        //captura o mes
        $mm = substr($string, 3, 2);

        //captura o ano
        $yyyy = substr($string, 6, 4);

        //retorna um objeto Date
        return date($yyyy."-".$mm."-".$dd);
    }

    /**
     * Converte uma data do formato do banco para um legível
     */
    public static function dateToStr($string)
    {
        //captura o dia
        $dd = substr($string, 8, 2);

        //captura o mes
        $mm = substr($string, 5, 2);

        //captura o ano
        $yyyy = substr($string, 0, 4);

        //retorna um objeto Date
        return $dd."/".$mm."/".$yyyy;
    }
}