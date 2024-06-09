<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMakerACDC extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cpt()
    {
        return $this->belongsTo(CreateProject::class, 'cpt_id');
    }

    const HPP = 1;
    const BIAYA_BMT = 2;
    const FOTOCOPY_JILID = 3;
    const MATERAI = 4;
    const BIAYA_PENGIRIMAN_DOKUMEN = 5;
    const BIAYA_JAMINAN_ASURANSI = 6;
    const BIAYA_SERTIFIKAT_TENAGA_AHLI = 7;
    const BIAYA_TRAINING = 8;
    const ENTERTAIN = 9;
    const TIKET = 10;
    const HOTEL = 11;
    const SEWA_MOBIL = 12;
    const UANG_DINAS = 13;
    const DENDA_PINALTY = 14;
    const BIAYA_LAIN_LAIN = 15;

    /**
     * Get the human-readable label for a given value.
     *
     * @param  mixed  $value
     * @return string
     */
    public static function getKetLabel($value)
    {
        $labels = [
            self::HPP => 'HPP',
            self::BIAYA_BMT => 'Biaya BMT',
            self::FOTOCOPY_JILID => 'Fotocopy/Jilid',
            self::MATERAI => 'Materai',
            self::BIAYA_PENGIRIMAN_DOKUMEN => 'Biaya Pengiriman Dokumen',
            self::BIAYA_JAMINAN_ASURANSI => 'Biaya Jaminan Asuransi',
            self::BIAYA_SERTIFIKAT_TENAGA_AHLI => 'Biaya Sertifikat Tenaga Ahli',
            self::BIAYA_TRAINING => 'Biaya Training',
            self::ENTERTAIN => 'Entertain',
            self::TIKET => 'Tiket',
            self::HOTEL => 'Hotel',
            self::SEWA_MOBIL => 'Sewa Mobil',
            self::UANG_DINAS => 'Uang Dinas',
            self::DENDA_PINALTY => 'Denda/Pinalty',
            self::BIAYA_LAIN_LAIN => 'Biaya Lain-Lain',
        ];

        return $labels[$value] ?? 'Unknown';
    }
}
