<?php

namespace App\Support;

use Dompdf\FontMetrics;

class PdfFonts
{
    public static function registerCalibri(FontMetrics $fontMetrics): void
    {
        $fontMetrics->registerFont(
            ['family' => 'Calibri', 'style' => 'normal', 'weight' => 'normal'],
            resource_path('fonts/calibri.ttf')
        );
        $fontMetrics->registerFont(
            ['family' => 'Calibri', 'style' => 'normal', 'weight' => 'bold'],
            resource_path('fonts/calibri-bold.ttf')
        );
        $fontMetrics->registerFont(
            ['family' => 'Calibri', 'style' => 'italic', 'weight' => 'normal'],
            resource_path('fonts/calibri-italic.ttf')
        );
        $fontMetrics->registerFont(
            ['family' => 'Calibri', 'style' => 'italic', 'weight' => 'bold'],
            resource_path('fonts/calibri-bolditalic.ttf')
        );
    }
}
