<?php

namespace App\Imports;

use App\Models\Kuota;
use Maatwebsite\Excel\Concerns\ToModel;

class KuotaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Kuota([
            'jalur'     => $row[0],
            'jumlah_kuota'  => $row[1],
            'tanggal' => $row[2],
            'bulan' => $row[3],
            'tahun' => $row[4],
        ]);
    }
}
