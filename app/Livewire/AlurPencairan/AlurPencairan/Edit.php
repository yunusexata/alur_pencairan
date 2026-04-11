<?php

namespace App\Livewire\AlurPencairan\AlurPencairan;

use App\Helpers\Alert;
use App\Helpers\NumberFormatter;
use App\Models\AlurPencairan\AlurPencairan;
use App\Models\AlurPencairan\AlurPencairanDetail;
use App\Models\AlurPencairan\AlurPencairanHistory;
use App\Models\AlurPencairan\AlurPencairanStatus;
use App\Repositories\AlurPencairan\AlurPencairanDetailRepository;
use App\Repositories\AlurPencairan\AlurPencairanHistoryRepository;
use App\Repositories\AlurPencairan\AlurPencairanRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $alur_pencairan_id;
    public $plan_transfer;
    public $alur_pencairan = [];
    public $alur_proseses = [];
    public $data_salah_transfers = [];

    public $data_transfer_removes = [];

    public $jumlah_belum_melengkapi_rekening_salah;
    public $jumlah_belum_transfer_susulan;

    public function mount() {}


    #[On('editAlurPencairan')]
    public function editAlurPencairan($alur_pencairan_id)
    {
        $this->alur_pencairan_id = $alur_pencairan_id;
        $alur_pencairan_id = Crypt::decrypt($alur_pencairan_id);
        $alur_pencairan = AlurPencairanRepository::find($alur_pencairan_id);
        $this->alur_pencairan = [
            'judul' => $alur_pencairan['judul'],
            'qty_cair' => $alur_pencairan['qty_cair'],
            'status' => $alur_pencairan['status'],
            'type' => $alur_pencairan['type'],
            'alur_pencairan_id' => $alur_pencairan_id,
            'keterangan' => "Total : " . $alur_pencairan['qty_cair'] . ", Belum Transfer : " . $alur_pencairan->alurPencairanDetailOnProses->count() . ", Valid :" . $alur_pencairan['qty_cair'] - $alur_pencairan->alurPencairanDetailOnProses->count()
        ];
        $this->plan_transfer = $alur_pencairan['plan_transfer'];
        $this->alur_proseses = [];
        foreach ($alur_pencairan->alurPencairanStatuses as $detail) {

            $this->alur_proseses[] = array_merge(
                [
                    'is_check' => $detail['status'] == AlurPencairanStatus::STATUS_DONE ? true : false,
                    'creator_name' => $detail['status'] == AlurPencairanStatus::STATUS_PENDING ? '' : $detail['status'] . " oleh : " . $detail->statusUpdator->name,
                    'tanggal_update' => $detail['status'] == AlurPencairanStatus::STATUS_PENDING ? '' : $detail['tanggal_update'],
                    'keterangan_old' => $detail['keterangan'],
                    'user_name' => $detail->user->name,
                ],
                $detail->toArray()
            );
        }
        $this->getJumlahBelumMelengkapiRekeningSalah();
        $this->getJumlahBelumTransferSusulan();
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        $this->editAlurPencairan($this->alur_pencairan_id);
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->dispatch('closeEditModal');
    }

    public function getDataSalahTransfer()
    {
        $data_salah_transfers = AlurPencairanDetailRepository::getBy(
            [
                ['alur_pencairan_id', Crypt::decrypt($this->alur_pencairan_id)]
            ]
        );
        $this->data_salah_transfers = [];
        foreach ($data_salah_transfers as $detail) {
            $this->data_salah_transfers[] = [
                'id' => $detail['id'],
                'no_input_jepang' => $detail['no_input_jepang'],
                'nama_lengkap' => $detail['nama_lengkap'],
                'tanggal_lahir_input' => Carbon::parse($detail['tanggal_lahir'])->format('Ymd'),
                'tanggal_lahir' => $detail['tanggal_lahir'],
                'nominal_cair' => $detail['nominal_cair'],
                'rekening_lama' => $detail['rekening_lama'],
                'jenis_rekening_lama' => $detail['jenis_rekening_lama'],
                'rekening_terbaru' => $detail['rekening_terbaru'],
                'rekening_terbaru_old' => $detail['rekening_terbaru'],
                'jenis_rekening_terbaru' => $detail['jenis_rekening_terbaru'],
                'jenis_rekening_terbaru_old' => $detail['jenis_rekening_terbaru'],
                'tanggal_transfer' => $detail['tanggal_transfer'],
                'tanggal_transfer_old' => $detail['tanggal_transfer'],
                'creator_name' => $detail['creator']['name'] . " pada: " . $detail['created_at'],
                'updator_rekening_terbaru_name' => $detail->updatorRekeningTerbaru ? $detail->updatorRekeningTerbaru->name : '',
                'updator_tanggal_transfer_name' => $detail->updatorTanggalTransfer ? $detail->updatorTanggalTransfer->name : '',
                'rekening_terbaru_updated_at' => $detail->updatorRekeningTerbaru ? $detail->rekening_terbaru_updated_at : '',
                'tanggal_transfer_updated_at' => $detail->updatorTanggalTransfer ? $detail->tanggal_transfer_updated_at : '',
                'keterangan' => $detail['keterangan'],
                'mata_uang' => $detail['mata_uang'],
            ];
        }
    }

    private function getJumlahBelumMelengkapiRekeningSalah()
    {
        $this->jumlah_belum_melengkapi_rekening_salah = AlurPencairanDetailRepository::getBy(
            [
                ['alur_pencairan_id', Crypt::decrypt($this->alur_pencairan_id)],
                ['rekening_terbaru', null],
            ]
        )->count();
    }
    private function getJumlahBelumTransferSusulan()
    {
        $this->jumlah_belum_transfer_susulan = AlurPencairanDetailRepository::getBy(
            [
                ['alur_pencairan_id', Crypt::decrypt($this->alur_pencairan_id)],
                ['tanggal_transfer', null],
            ]
        )->count();
    }

    public function saveDataSalahTransfer()
    {
        try {
            DB::transaction(function () {
                foreach ($this->data_salah_transfers as $data_tranfer) {

                    $tgl_lahir = $data_tranfer['tanggal_lahir_input'] ? Carbon::createFromFormat('Ymd', $data_tranfer['tanggal_lahir_input'])->startOfDay()->format('Y-m-d H:i:s') : null;
                    $validateData = [
                        'alur_pencairan_id' => Crypt::decrypt($this->alur_pencairan_id),
                        'no_input_jepang' => $data_tranfer['no_input_jepang'],
                        'nama_lengkap' => $data_tranfer['nama_lengkap'],
                        'rekening_lama' => $data_tranfer['rekening_lama'],
                        'jenis_rekening_lama' => $data_tranfer['jenis_rekening_lama'],
                        'mata_uang' => $data_tranfer['mata_uang'],
                        'jenis_rekening_terbaru' => $data_tranfer['jenis_rekening_terbaru'],
                        'keterangan' => $data_tranfer['keterangan'],
                        'tanggal_lahir' => $tgl_lahir,
                        'nominal_cair' => NumberFormatter::imaskToValue($data_tranfer['nominal_cair']),
                        'status' => AlurPencairanDetail::STATUS_PROSES,
                        'status_updated_at' => now(),
                        // 'mata_uang' => $data_tranfer['mata_uang'],
                    ];
                    // dd($validateData);
                    if ($data_tranfer['id']) {
                        # code...
                        $vehicle = AlurPencairanDetailRepository::update($data_tranfer['id'], $validateData);
                    } else {
                        # code...
                        $vehicle = AlurPencairanDetailRepository::create($validateData);
                    }
                }
            });
            $this->getJumlahBelumMelengkapiRekeningSalah();
            $this->getJumlahBelumTransferSusulan();
            $this->dispatch('notification-refresh');

            $this->getDataSalahTransfer();
            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }
    public function saveMelengkapiRekeningSalah()
    {
        try {
            DB::transaction(function () {
                foreach ($this->data_salah_transfers as $data_tranfer) {
                    if (($data_tranfer['rekening_terbaru'] !== $data_tranfer['rekening_terbaru_old']) || ($data_tranfer['jenis_rekening_terbaru'] !== $data_tranfer['jenis_rekening_terbaru_old'])) {
                        $validateData = [
                            'rekening_terbaru' => blank($data_tranfer['rekening_terbaru']) ? null : $data_tranfer['rekening_terbaru'],
                            'jenis_rekening_terbaru' => $data_tranfer['jenis_rekening_terbaru'],
                            'rekening_terbaru_updated_by' => Auth::user()->id,
                            'rekening_terbaru_updated_at' => now(),
                            // 'mata_uang' => $data_tranfer['mata_uang'],
                        ];
                        if ($data_tranfer['id']) {
                            # code...
                            $vehicle = AlurPencairanDetailRepository::update($data_tranfer['id'], $validateData);
                        }
                    }
                }

                $this->getJumlahBelumMelengkapiRekeningSalah();
                $this->getJumlahBelumTransferSusulan();
                $this->dispatch('notification-refresh');
            });
            $this->getDataSalahTransfer();

            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }
    public function saveTransferSusulan()
    {
        try {
            DB::transaction(function () {
                foreach ($this->data_salah_transfers as $data_tranfer) {
                    if ($data_tranfer['tanggal_transfer'] != $data_tranfer['tanggal_transfer_old']) {
                        $validateData = [
                            'tanggal_transfer' => blank($data_tranfer['tanggal_transfer']) ? null : $data_tranfer['tanggal_transfer'],
                            'tanggal_transfer_updated_by' => Auth::user()->id,
                            'tanggal_transfer_updated_at' => now(),
                        ];
                        if ($data_tranfer['id']) {
                            # code...
                            $vehicle = AlurPencairanDetailRepository::update($data_tranfer['id'], $validateData);
                        }
                    }
                }

                $this->getJumlahBelumMelengkapiRekeningSalah();
                $this->getJumlahBelumTransferSusulan();
                $this->dispatch('notification-refresh');
            });

            $this->getDataSalahTransfer();
            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function addDataSalahTransfer()
    {
        $this->data_salah_transfers[] = [
            'id' => '',
            'no_input_jepang' => '',
            'nama_lengkap' => '',
            'tanggal_lahir' => '',
            'nominal_cair' => 0,
            'rekening_lama' => '',
            'jenis_rekening_lama' => AlurPencairanDetail::JENIS_REKENING_INDONESIA,
            'rekening_terbaru' => '',
            'jenis_rekening_terbaru' => AlurPencairanDetail::JENIS_REKENING_INDONESIA,
            'tanggal_transfer' => '',
            'updator_rekening_terbaru_name' => '',
            'updator_tanggal_transfer_name' => '',

            'updator_rekening_terbaru_name' => '',
            'updator_tanggal_transfer_name' => '',
            'rekening_terbaru_updated_at' => '',
            'tanggal_transfer_updated_at' => '',

            'keterangan' => '',
            'mata_uang' => AlurPencairanDetail::MATA_UANG_RUPIAH,
        ];
    }

    public function removeDataTransfer($index)
    {
        if ($this->data_salah_transfers[$index]['id']) {
            $this->data_transfer_removes[] = $this->data_salah_transfers[$index]['id'];
        }
        unset($this->data_salah_transfers[$index]);
    }

    public function saveChanges()
    {
        try {
            DB::transaction(function () {

                if (Auth::user()->roles[0]->name == AlurPencairan::ROLE_ALIASE[AlurPencairan::ROLE_ACC_EXATA]) {
                    $validateData = [
                        'plan_transfer' => $this->plan_transfer,
                    ];
                    AlurPencairanRepository::update(Crypt::decrypt($this->alur_pencairan_id), $validateData);
                }
                if (Auth::user()->roles[0]->name == AlurPencairan::ROLE_ALIASE[AlurPencairan::ROLE_FINANCE]) {
                    $validateData = [
                        'judul' => $this->alur_pencairan['judul'],
                        'qty_cair' => $this->alur_pencairan['qty_cair'],
                    ];
                    AlurPencairanRepository::update(Crypt::decrypt($this->alur_pencairan_id), $validateData);
                }

                foreach ($this->alur_proseses as $index => $alur_proses) {
                    if ($alur_proses['keterangan'] != $alur_proses['keterangan_old']) {
                        $validatedData = [

                            'alur_pencairan_id' => $alur_proses['alur_pencairan_id'],
                            'alur_proses_id' => $alur_proses['alur_proses_id'],
                            'alur_proses_detail_id' => $alur_proses['alur_proses_detail_id'],
                            'user_id' => $alur_proses['user_id'],
                            'keterangan' => $alur_proses['keterangan'],
                            'status' => $alur_proses['status'],
                            'status_updated_by' => $alur_proses['status_updated_by'],
                            'status_updated_at' => $alur_proses['status_updated_at'],
                            'status_updated_name' => $alur_proses['status_updated_name'],
                        ];
                        AlurPencairanHistoryRepository::create($validatedData);
                        $this->editAlurPencairan(Crypt::encrypt($alur_proses['alur_pencairan_id']));
                    }
                }
                $this->dispatch('notification-refresh');
            });


            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function updateStatus($alur_pencairan_id)
    {
        try {
            DB::transaction(function () use ($alur_pencairan_id) {
                AlurPencairanRepository::update($alur_pencairan_id, [
                    'status' => AlurPencairan::STATUS_DONE,
                    'status_updated_by' => Auth::user()->id,
                    'status_updated_at' => now(),
                ]);
                $this->editAlurPencairan(Crypt::encrypt($alur_pencairan_id));
                $this->dispatch('notification-refresh');
            });


            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function updatedAlurProseses($a, $b)
    {
        try {
            $el = explode('.', $b);
            if ($el[1] == 'is_check') {
                DB::transaction(function () use ($el) {

                    $alur_proses = $this->alur_proseses[$el[0]];
                    $status = $alur_proses['is_check'] ? AlurPencairanHistory::STATUS_DONE : AlurPencairanHistory::STATUS_CANCEL;

                    $validatedData = [
                        'alur_pencairan_id' => $alur_proses['alur_pencairan_id'],
                        'alur_proses_id' => $alur_proses['alur_proses_id'],
                        'alur_proses_detail_id' => $alur_proses['alur_proses_detail_id'],
                        'user_id' => $alur_proses['user_id'],
                        'status' => $status,
                        'status_updated_by' => Auth::user()->id,
                        'status_updated_name' => Auth::user()->name,
                        'status_updated_at' => now(),
                    ];


                    AlurPencairanHistoryRepository::create($validatedData);
                    $this->editAlurPencairan(Crypt::encrypt($alur_proses['alur_pencairan_id']));
                    $this->dispatch('notification-refresh');
                });


                DB::commit();
                Alert::confirmation(
                    $this,
                    Alert::ICON_SUCCESS,
                    "Berhasil",
                    "Data Berhasil Diperbarui",
                    "on-dialog-confirm",
                    "on-dialog-cancel",
                    "Oke",
                    "Tutup",
                );
            }
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.alur-pencairan.alur-pencairan.edit');
    }
}
