<?php
// src/Twig/AppExtension.php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('phone', [$this, 'formatPhone']),
            new TwigFilter('mail', [$this, 'formatMail']),
        ];
    }

    public function formatPhone($number)
    {
        $number = str_replace(' ', '', $number);
        $number = str_replace('.', '', $number);
        $format_number = array();
        $format_number[0] = substr($number, 0, 2);
        $format_number[1] = substr($number, 2, 2);
        $format_number[2] = substr($number, 4, 2);
        $format_number[3] = substr($number, 6, 2);
        $format_number[4] = substr($number, 8, 2);
        $number = $format_number[0].' '.$format_number[1].' '.$format_number[2].' '.$format_number[3].' '.$format_number[4];

        return $number;
    }

    public function formatMail($mail)
    {
        $mail = str_replace(' ', '', $mail);

        return strtolower($mail);
    }
}