<?php

namespace App\Models\AlurPencairan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;
use Spatie\Permission\Models\Role;


class AlurProsesDetail extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'alur_proses_id',
        'nomor_urut',
        'name',
        'role_id',
        'role_name',
        'is_multi',
        'by_user',
        'user_id',
        'alur_proses_key',
        'role_can_show',
    ];

    public function saveInfo($object, $data = null, $prefix = "alur_proses_detail_")
    {
        if ($data) {
            foreach ($data as $item) {
                $object[$prefix . "" . $item] = $this->$item;
            }
        } else {
            $object[$prefix . 'alur_proses_id'] = $this->alur_proses_id;
            $object[$prefix . 'nomor_urut'] = $this->nomor_urut;
            $object[$prefix . 'name'] = $this->name;
            $object[$prefix . 'role_id'] = $this->role_id;
            $object[$prefix . 'role_name'] = $this->role_name;
            $object[$prefix . 'is_multi'] = $this->is_multi;
            $object[$prefix . 'by_user'] = $this->by_user;
            // $object[$prefix . 'user_id'] = $this->user_id;
            $object[$prefix . 'alur_proses_key'] = $this->alur_proses_key;
            $object[$prefix . 'role_can_show'] = $this->role_can_show;
        }

        return $object;
    }
    // ROLE ID
    // pak novi 2, acc exata 3, hs 4, cc 5, finance 6, sales 7, supervisor
    public const KEY_PLAN_TRANSFER = 'plan_transfer';
    public const KEY_INFO_REK_SALAH = 'info_rek_salah';
    public const KEY_MELENGKAPI_REK_SALAH = 'melengkapi_rek_salah';
    public const KEY_TRANSFER_SUSULAN = 'transfer_susulan';

    // ------------- //
    // ALUR SPEED 20 //
    // ------------- //

    public const ALUR_SPEED_20_TERIMA_EMAIL_DARI_PUSAT_DAN_SHARE_KE_ACCOUNTING_EXATA = [
        'name' => 'Terima email dari pusat dan share ke accounting exata',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_TANDAI_NAMA_CAIR_DI_DATA_RE = [
        'name' => 'Tandai Nama-nama yang cair di Data RE',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_KIRIM_GAMBAR_LIST_CAIR_POSTING_SALES = [
        'name' => 'Kirim gambar list cair u di posting sales',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_KIRIM_KONTEN_N20_CAIR_POSTING_SALES = [
        'name' => 'Kirim Konten N20% Cair u di posting sales',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_KIRIM_ICHIJIKIN_DAN_KWITANSI_KE_FINANCE = [
        'name' => 'Kirim ichijikin & kwitansi ke finance',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_PLAN_TRANSFER = [
        'name' => 'Plan Transfer',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => self::KEY_PLAN_TRANSFER,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_HITUNG_BUAT_SHARE_KWITANSI_KE_CC = [
        'name' => 'Hitung, buat & Share kwitansi ke CC',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_PRINT_DAN_CEK_LIST_CAIR = [
        'name' => 'Print & Cek list cair',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_TRANSAKSI_KE_BANK = [
        'name' => 'Transaksi ke Bank',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_TRANSFER = [
        'name' => 'Transfer',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_INFO_SELESAI_TRANSFER = [
        'name' => 'Info ke Tim / Grup selesai Transfer',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_MUTASI_TRANSFER = [
        'name' => 'Mutasi transfer',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_INFO_REKENING_SALAH = [
        'name' => 'Info Rek Salah (Mencatat list nama yang blm berhasil di Transfer (rek mondai dll))',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => self::KEY_INFO_REK_SALAH,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_MELENGKAPI_REKENING_SALAH = [
        'name' => 'Melengkapi Rekening salah',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => self::KEY_MELENGKAPI_REK_SALAH,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_TRANSFER_SUSULAN = [
        'name' => 'Transfer susulan',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => self::KEY_TRANSFER_SUSULAN,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_INFO_TRANSFER_SUSULAN = [
        'name' => 'Info ke Tim / Grup selesai Transfer susulan',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_MUTASI_ULANG_SUSULAN = [
        'name' => 'Mutasi ulang susulan',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_BUAT_LINK_DOKUMEN = [
        'name' => 'Buat link untuk Kwitansi, Ichijikin + Resi',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_POSTING_KONTEN = [
        'name' => 'Posting konten',
        'role_name' => AlurPencairan::ROLE_SALES,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_KIRIM_INFO_NENKIN = [
        'name' => 'Kirim info Nenkin cair, kirim link u lihat Kwitansi, Ichijikin + Resi',
        'role_name' => AlurPencairan::ROLE_SALES,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_UPLOAD_TESTIMONI = [
        'name' => 'Upod & Testimoni',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_CEK_KWITANSI_SALES = [
        'name' => 'Cek Kwitansi yang di kirim sales',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_ARSIP_RESI_TRANSFER = [
        'name' => 'Arsip Resi Transfer',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [
            AlurPencairan::ROLE_SUPER_ADMIN,
            AlurPencairan::ROLE_PAK_NOVI,
            AlurPencairan::ROLE_ACC_EXATA,
            AlurPencairan::ROLE_FINANCE,
        ],
    ];

    public const ALUR_SPEED_20_BLOK_DAN_ISI_NOMINAL_CAIR = [
        'name' => 'Blok & isi nominal cair + tanggal cair',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_SPEED_20_ARSIP_PRINTOUT_LIST_CAIR = [
        'name' => 'Arsip print out list cair beserta slip transaksi bank',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [
            AlurPencairan::ROLE_SUPER_ADMIN,
            AlurPencairan::ROLE_PAK_NOVI,
            AlurPencairan::ROLE_ACC_EXATA,
            AlurPencairan::ROLE_FINANCE,
        ],
    ];

    public const ALUR_SPEED_20_LIST = [
        self::ALUR_SPEED_20_TERIMA_EMAIL_DARI_PUSAT_DAN_SHARE_KE_ACCOUNTING_EXATA,
        self::ALUR_SPEED_20_TANDAI_NAMA_CAIR_DI_DATA_RE,
        self::ALUR_SPEED_20_KIRIM_GAMBAR_LIST_CAIR_POSTING_SALES,
        self::ALUR_SPEED_20_KIRIM_KONTEN_N20_CAIR_POSTING_SALES,
        self::ALUR_SPEED_20_KIRIM_ICHIJIKIN_DAN_KWITANSI_KE_FINANCE,
        self::ALUR_SPEED_20_PLAN_TRANSFER,
        self::ALUR_SPEED_20_HITUNG_BUAT_SHARE_KWITANSI_KE_CC,
        self::ALUR_SPEED_20_PRINT_DAN_CEK_LIST_CAIR,
        self::ALUR_SPEED_20_TRANSAKSI_KE_BANK,
        self::ALUR_SPEED_20_TRANSFER,
        self::ALUR_SPEED_20_INFO_SELESAI_TRANSFER,
        self::ALUR_SPEED_20_MUTASI_TRANSFER,
        self::ALUR_SPEED_20_INFO_REKENING_SALAH,
        self::ALUR_SPEED_20_MELENGKAPI_REKENING_SALAH,
        self::ALUR_SPEED_20_TRANSFER_SUSULAN,
        self::ALUR_SPEED_20_INFO_TRANSFER_SUSULAN,
        self::ALUR_SPEED_20_MUTASI_ULANG_SUSULAN,
        self::ALUR_SPEED_20_BUAT_LINK_DOKUMEN,
        self::ALUR_SPEED_20_POSTING_KONTEN,
        self::ALUR_SPEED_20_KIRIM_INFO_NENKIN,
        self::ALUR_SPEED_20_UPLOAD_TESTIMONI,
        self::ALUR_SPEED_20_CEK_KWITANSI_SALES,
        self::ALUR_SPEED_20_ARSIP_RESI_TRANSFER,
        self::ALUR_SPEED_20_BLOK_DAN_ISI_NOMINAL_CAIR,
        self::ALUR_SPEED_20_ARSIP_PRINTOUT_LIST_CAIR,
    ];



    // ----------- //
    // ALUR NORMAL //
    // ----------- //
    public const ALUR_NORMAL_TERIMA_EMAIL_DARI_PUSAT = [
        'name' => 'Terima email dari pusat dan share ke accounting exata',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_TERIMA_HAGAKI_DARI_PUSAT = [
        'name' => 'Terima Hagaki dari pusat dan share ke accounting exata',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_SHARE_LIST_CAIR_KE_DRIVE = [
        'name' => 'Share list cair ke drive',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_SHARE_HAGAKI_KE_CC = [
        'name' => 'Share Hagaki ke CC',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_BLOCK01_TARIK_DATA = [
        'name' => 'Block 01 tarik data',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_MONITORING_LIST_PENCAIRAN = [
        'name' => 'Monitoring List Pencairan',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];
    public const ALUR_NORMAL_PRINT_BAGIKAN_KE_SALES = [
        'name' => 'Print bagikan ke Sales',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_MELENGKAPI_REKENING_KOSONG = [
        'name' => 'Melengkapi Rekening Kosong',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_SHARE_LIST_CAIR_KE_CC = [
        'name' => 'Share list cair ke CC',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => true,
        'user_id' => 5,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_SHARE_ICHIJIKIN_NON_RE_80 = [
        'name' => 'Share Ichijikin non R/E 80% ke CC',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => true,
        'user_id' => 5,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_CARI_ICHIJIKIN_RE_80 = [
        'name' => 'Cari ichijikin dari R/E 80%',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_KIRIM_ALL_ICHIJIKIN_KE_ACC = [
        'name' => 'Kirim all ichijikin ke ACC',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_KIRIM_DOKUMEN_KE_FINANCE = [
        'name' => 'Kirim ichijikin, Hagaki & kwitansi ke finance',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_KIRIM_GAMBAR_LIST_POSTING_SALES = [
        'name' => 'Kirim gambar list cair u di posting sales',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_PLAN_TRANSFER = [
        'name' => 'Plan Transfer',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => self::KEY_PLAN_TRANSFER,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_BUAT_KWITANSI_KE_CC = [
        'name' => 'Hitung, buat & Share kwitansi ke CC',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_CEK_PRINT_LIST_CAIR = [
        'name' => 'Cek & Print list cair',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_TRANSAKSI_KE_BANK = [
        'name' => 'Transaksi ke Bank',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_TRANSFER = [
        'name' => 'Transfer',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_INFO_SELESAI_TRANSFER = [
        'name' => 'Info ke Tim / Grup selesai Transfer',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_MUTASI_TRANSFER = [
        'name' => 'Mutasi transfer',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_INFO_REKENING_SALAH = [
        'name' => 'Info Rek Salah (Mencatat list nama yang blm berhasil di Transfer (rek mondai dll))',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => self::KEY_INFO_REK_SALAH,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_MELENGKAPI_REKENING_SALAH = [
        'name' => 'Melengkapi Rekening salah',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => self::KEY_MELENGKAPI_REK_SALAH,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_TRANSFER_SUSULAN = [
        'name' => 'Transfer susulan',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => self::KEY_TRANSFER_SUSULAN,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_INFO_TRANSFER_SUSULAN = [
        'name' => 'Info ke Tim / Grup selesai Transfer susulan',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_MUTASI_ULANG_SUSULAN = [
        'name' => 'Mutasi ulang susulan',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_BUAT_LINK_DOKUMEN = [
        'name' => 'Buat link untuk Kwitansi, Ichijikin + Resi',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_POSTING_KONTEN = [
        'name' => 'Posting konten',
        'role_name' => AlurPencairan::ROLE_SALES,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_KIRIM_INFO_NENKIN = [
        'name' => 'Kirim info Nenkin cair, kirim link u lihat Kwitansi, Ichijikin + Resi',
        'role_name' => AlurPencairan::ROLE_SALES,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_CEK_KWITANSI_SALES = [
        'name' => 'Cek Kwitansi yang di kirim sales',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_NORMAL_ARSIP_RESI_TRANSFER = [
        'name' => 'Arsip Resi Transfer',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [
            AlurPencairan::ROLE_SUPER_ADMIN,
            AlurPencairan::ROLE_PAK_NOVI,
            AlurPencairan::ROLE_ACC_EXATA,
            AlurPencairan::ROLE_FINANCE,
        ],
    ];

    public const ALUR_NORMAL_BLOK_ISI_NOMINAL_CAIR = [
        'name' => 'Blok & isi nominal cair + tanggal cair',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];
    public const ALUR_NORMAL_ARSIP_PRINTOUT_LIST = [
        'name' => 'Arsip print out list cair beserta slip transaksi bank',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [
            AlurPencairan::ROLE_SUPER_ADMIN,
            AlurPencairan::ROLE_PAK_NOVI,
            AlurPencairan::ROLE_ACC_EXATA,
            AlurPencairan::ROLE_FINANCE,
        ],
    ];
    public const ALUR_NORMAL_LIST = [
        self::ALUR_NORMAL_TERIMA_EMAIL_DARI_PUSAT,
        self::ALUR_NORMAL_TERIMA_HAGAKI_DARI_PUSAT,
        self::ALUR_NORMAL_SHARE_LIST_CAIR_KE_DRIVE,
        self::ALUR_NORMAL_SHARE_HAGAKI_KE_CC,
        self::ALUR_NORMAL_BLOCK01_TARIK_DATA,
        self::ALUR_NORMAL_MONITORING_LIST_PENCAIRAN,
        self::ALUR_NORMAL_PRINT_BAGIKAN_KE_SALES,
        self::ALUR_NORMAL_SHARE_LIST_CAIR_KE_CC,
        self::ALUR_NORMAL_SHARE_ICHIJIKIN_NON_RE_80,
        self::ALUR_NORMAL_MELENGKAPI_REKENING_KOSONG,
        self::ALUR_NORMAL_CARI_ICHIJIKIN_RE_80,
        self::ALUR_NORMAL_KIRIM_ALL_ICHIJIKIN_KE_ACC,
        self::ALUR_NORMAL_KIRIM_DOKUMEN_KE_FINANCE,
        self::ALUR_NORMAL_KIRIM_GAMBAR_LIST_POSTING_SALES,
        self::ALUR_NORMAL_PLAN_TRANSFER,
        self::ALUR_NORMAL_BUAT_KWITANSI_KE_CC,
        self::ALUR_NORMAL_CEK_PRINT_LIST_CAIR,
        self::ALUR_NORMAL_TRANSAKSI_KE_BANK,
        self::ALUR_NORMAL_TRANSFER,
        self::ALUR_NORMAL_INFO_SELESAI_TRANSFER,
        self::ALUR_NORMAL_MUTASI_TRANSFER,
        self::ALUR_NORMAL_INFO_REKENING_SALAH,
        self::ALUR_NORMAL_MELENGKAPI_REKENING_SALAH,
        self::ALUR_NORMAL_TRANSFER_SUSULAN,
        self::ALUR_NORMAL_INFO_TRANSFER_SUSULAN,
        self::ALUR_NORMAL_MUTASI_ULANG_SUSULAN,
        self::ALUR_NORMAL_BUAT_LINK_DOKUMEN,
        self::ALUR_NORMAL_POSTING_KONTEN,
        self::ALUR_NORMAL_KIRIM_INFO_NENKIN,
        self::ALUR_NORMAL_CEK_KWITANSI_SALES,
        self::ALUR_NORMAL_ARSIP_RESI_TRANSFER,
        self::ALUR_NORMAL_BLOK_ISI_NOMINAL_CAIR,
        self::ALUR_NORMAL_ARSIP_PRINTOUT_LIST,
    ];

    // ----------- //
    // ALUR NORMAL //
    // ----------- //

    public const ALUR_PROSES_80_TERIMA_PDF_ICHIJIKIN = [
        'name' => 'Terima PDF ichijikin',
        'role_name' => AlurPencairan::ROLE_PAK_NOVI,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_SHARE_ICHIJIKIN_KE_CC = [
        'name' => 'Share Ichjikin ke CC',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_CONVERT_ICHIJIKIN_KE_FILE = [
        'name' => 'Convert Ichijikin ke file',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_CEK_HASIL_CONVERT_ICHIJIKIN_SUPERVISOR = [
        'name' => 'Cek hasil Convert Ichijikin',
        'role_name' => AlurPencairan::ROLE_SUPERVISOR,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_CEK_HASIL_CONVERT_ICHIJIKIN_FINANCE = [
        'name' => 'Cek hasil Convert Ichijikin',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_CEK_HASIL_CONVERT_ICHIJIKIN_ACC_EXATA = [
        'name' => 'Cek hasil Convert Ichijikin',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_CEK_HASIL_CONVERT_ICHIJIKIN_HS = [
        'name' => 'Cek hasil Convert Ichijikin',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_KIRIM_HASIL_CONVERT_KE_BU_INDI = [
        'name' => 'Kirim hasil convert ichijikin ke bu indi',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_SHARE_LIST_NAMA_KE_DRIVE = [
        'name' => 'Share List nama dari Bu Indi ke Drive',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_BLOCK01_TARIK_DATA = [
        'name' => 'Block 01 tarik data',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_MONITORING_LIST_PENCAIRAN = [
        'name' => 'Monitoring List Pencairan',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];
    public const ALUR_PROSES_80_PRINT_BAGIKAN_KE_SALES = [
        'name' => 'Print bagikan ke Sales',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_MELENGKAPI_REKENING_KOSONG = [
        'name' => 'Melengkapi Rekening Kosong',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_SHARE_LIST_CAIR_KE_CC = [
        'name' => 'Share list cair ke CC',
        'role_name' => AlurPencairan::ROLE_HS,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_KIRIM_GAMBAR_LIST_POSTING_SALES = [
        'name' => 'Kirim gambar list cair u di posting sales',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_KIRIM_KONTEN_N80_CAIR = [
        'name' => 'Kirim Konten N80% Cair u di posting sales',
        'role_name' => AlurPencairan::ROLE_CC,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_BUAT_KWITANSI_KOKUMIN = [
        'name' => 'Hitung, buat & Share kwitansi Kokumin',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_POSTING_KONTEN = [
        'name' => 'Posting konten',
        'role_name' => AlurPencairan::ROLE_SALES,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_TAGIH_ADMIN_KOKUMIN = [
        'name' => 'Tagih Admin Kokumin',
        'role_name' => AlurPencairan::ROLE_SALES,
        'is_multi' => true,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_UPDATE_NAMA_KLIEN_RE_ENTRY = [
        'name' => 'Update nama-nama klien Re entry',
        'role_name' => AlurPencairan::ROLE_ACC_EXATA,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_ISI_KETERANGAN_RE_ENTRY = [
        'name' => 'Isi keterangan Re entry 01',
        'role_name' => AlurPencairan::ROLE_FINANCE,
        'is_multi' => false,
        'by_user' => false,
        'user_id' => null,
        'alur_proses_key' => null,
        'role_can_show' => [],
    ];

    public const ALUR_PROSES_80_LIST = [
        self::ALUR_PROSES_80_TERIMA_PDF_ICHIJIKIN,
        self::ALUR_PROSES_80_SHARE_ICHIJIKIN_KE_CC,
        self::ALUR_PROSES_80_CONVERT_ICHIJIKIN_KE_FILE,
        self::ALUR_PROSES_80_CEK_HASIL_CONVERT_ICHIJIKIN_SUPERVISOR,
        self::ALUR_PROSES_80_CEK_HASIL_CONVERT_ICHIJIKIN_ACC_EXATA,
        self::ALUR_PROSES_80_CEK_HASIL_CONVERT_ICHIJIKIN_FINANCE,
        self::ALUR_PROSES_80_CEK_HASIL_CONVERT_ICHIJIKIN_HS,
        self::ALUR_PROSES_80_KIRIM_HASIL_CONVERT_KE_BU_INDI,
        self::ALUR_PROSES_80_SHARE_LIST_NAMA_KE_DRIVE,
        self::ALUR_PROSES_80_BLOCK01_TARIK_DATA,
        self::ALUR_PROSES_80_MONITORING_LIST_PENCAIRAN,
        self::ALUR_PROSES_80_PRINT_BAGIKAN_KE_SALES,
        self::ALUR_PROSES_80_SHARE_LIST_CAIR_KE_CC,
        self::ALUR_PROSES_80_MELENGKAPI_REKENING_KOSONG,
        self::ALUR_PROSES_80_KIRIM_GAMBAR_LIST_POSTING_SALES,
        self::ALUR_PROSES_80_KIRIM_KONTEN_N80_CAIR,
        self::ALUR_PROSES_80_BUAT_KWITANSI_KOKUMIN,
        self::ALUR_PROSES_80_POSTING_KONTEN,
        self::ALUR_PROSES_80_TAGIH_ADMIN_KOKUMIN,
        self::ALUR_PROSES_80_UPDATE_NAMA_KLIEN_RE_ENTRY,
        self::ALUR_PROSES_80_ISI_KETERANGAN_RE_ENTRY,
    ];

    protected $guarded = ['id'];

    public function isDeletable()
    {
        return true;
    }

    public function isEditable()
    {
        return true;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function alurPencairanHistories()
    {
        return $this->belongsTo(AlurPencairanHistory::class)->latest('id');
    }
}
