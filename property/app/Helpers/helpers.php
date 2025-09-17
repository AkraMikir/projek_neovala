<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($nominal)
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }
} 