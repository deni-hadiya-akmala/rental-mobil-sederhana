<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka, $prefix = 'Rp')
    {
        $number_string = preg_replace("/[^,\d]/", "", $angka);
        $split = explode(',', $number_string);
        $sisa = strlen($split[0]) % 3;
        $rupiah = substr($split[0], 0, $sisa);
        $ribuan = substr($split[0], $sisa);
        $ribuan = preg_match_all("/\d{3}/", $ribuan, $matches) ? implode('.', $matches[0]) : '';

        $separator = $sisa ? '.' : '';
        $rupiah = $rupiah . $separator . $ribuan;
        $rupiah = isset($split[1]) ? $rupiah . ',' . $split[1] : $rupiah;
        return $prefix . ' ' . $rupiah;
    }
}
