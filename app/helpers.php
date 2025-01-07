// app/helpers.php
<?php

if (! function_exists('dd_table')) {
    /**
     * Fungsi untuk dd data dalam format tabel HTML.
     *
     * @param \Illuminate\Database\Eloquent\Collection $data
     * @return void
     */
    function dd_table($data)
    {
        // Pastikan data berupa koleksi atau array
        if (is_array($data) || $data instanceof \Illuminate\Database\Eloquent\Collection) {
            // Membuat header tabel berdasarkan kolom
            $columns = collect($data)->first()->getAttributes();

            echo '<table style="border-collapse: collapse; width: 100%;">';
            echo '<thead><tr>';

            // Menampilkan header tabel
            foreach ($columns as $column => $value) {
                echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">' . ucfirst($column) . '</th>';
            }

            echo '</tr></thead><tbody>';

            // Menampilkan data dalam tabel
            foreach ($data as $row) {
                echo '<tr>';
                foreach ($columns as $column => $value) {
                    echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $row->$column . '</td>';
                }
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            dd($data); // Jika bukan koleksi, jalankan dd biasa
        }
    }
}
