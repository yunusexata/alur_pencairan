<?php

namespace App\Livewire\AlurPencairan\AlurProsesSpeed20;

use App\Helpers\Alert;
use App\Models\AlurPencairan\AlurPencairan;
use App\Models\AlurPencairan\AlurProses;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Repositories\Account\RoleRepository;
use App\Repositories\AlurPencairan\AlurProsesDetailRepository;
use App\Repositories\AlurPencairan\AlurProsesRepository;

class Detail extends Component
{
    public $alur_proseses = [];
    public $alur_proses_removes = [];
    public $roles = [];
    public $default_role;

    public array $oldNomor = [];

    public function mount()
    {
        $this->roles = RoleRepository::getIdAndNames()->pluck('name')->toArray();
        $this->default_role = $this->roles[0];
        $this->getAlurProseses();
    }

    private function getAlurProseses()
    {
        $alur_proses = AlurProsesRepository::findBy([
            ['name', '=', AlurProses::TYPE_SPEED_20]
        ]);
        $this->alur_proseses = collect($alur_proses->alurProsesDetails)
            ->sortBy('nomor_urut')
            ->values()
            ->map(function ($detail) {
                return [
                    'alur_proses_id' => $detail->alur_proses_id,
                    'alur_proses_detail_id' => $detail->id,
                    'nomor_urut' => (int) $detail->nomor_urut,
                    'name' => $detail->name,
                    'role_id' => $detail->role_id,
                    'role_name' => $detail->role->name,
                    'is_multi' => $detail->is_multi,
                    'by_user' => $detail->by_user,
                    'user_id' => $detail->user_id,
                    'role_can_show' => $detail->role_can_show,
                ];
            })
            ->toArray();
    }
    public function updatingAlurProseses($new_val, $key)
    {
        if (str_contains($key, 'nomor_urut')) {
            $index = explode('.', $key)[0];
            $old_val = $this->alur_proseses[$index]['nomor_urut'];
            if ($new_val > $old_val) {
                $alur_before = collect($this->alur_proseses)
                    ->where('nomor_urut', '<=', $new_val)
                    ->where('nomor_urut', '>', $old_val)
                    ->map(function ($item, $i) {
                        $item['nomor_urut'] = $item['nomor_urut'] - 1;
                        return $item;
                    })
                    ->toArray();
                foreach ($alur_before as $alur) {
                    $validatedData = [
                        'nomor_urut' => $alur['nomor_urut']
                    ];

                    AlurProsesDetailRepository::update($alur['alur_proses_detail_id'], $validatedData);
                }
                $validatedData = [
                    'nomor_urut' => $new_val
                ];
                AlurProsesDetailRepository::update($this->alur_proseses[$index]['alur_proses_detail_id'], $validatedData);

                $this->redirectRoute('alur_proses_speed_20.index');
            } elseif ($new_val < $old_val) {
                $alur_before = collect($this->alur_proseses)
                    ->where('nomor_urut', '>=', $new_val)
                    ->where('nomor_urut', '<', $old_val)
                    ->map(function ($item, $i) {
                        $item['nomor_urut'] = $item['nomor_urut'] + 1;
                        return $item;
                    })
                    ->toArray();
                foreach ($alur_before as $alur) {
                    $validatedData = [
                        'nomor_urut' => $alur['nomor_urut']
                    ];

                    AlurProsesDetailRepository::update($alur['alur_proses_detail_id'], $validatedData);
                }

                $validatedData = [
                    'nomor_urut' => $new_val
                ];
                AlurProsesDetailRepository::update($this->alur_proseses[$index]['alur_proses_detail_id'], $validatedData);

                $this->redirectRoute('alur_proses_speed_20.index');
            }
        }
    }
    public function addAlurProses()
    {
        $this->alur_proseses[] = [
            'id' => '',
            'role_id' => $this->default_role['id'],
            'role_name' => $this->default_role['name'],
            'name' => '',
            'nomor_urut' => count($this->alur_proseses) + 1,
        ];
    }

    public function removeAlurProses($index)
    {
        if ($this->alur_proseses[$index]['id']) {
            $this->alur_proses_removes[] = $this->alur_proseses[$index]['id'];
        }
        unset($this->alur_proseses[$index]);
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        $this->redirectRoute('alur_pencairan_alur_proses.index');
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('alur_pencairan_alur_proses.index');
    }

    public function store()
    {
        try {
            DB::transaction(function () {
                foreach ($this->alur_proseses as $alur) {

                    $validateData = [
                        'role_id' => $alur['role_id'],
                        'role_name' => RoleRepository::find($alur['role_id'])->name,
                        'name' => $alur['name'],
                        'nomor_urut' => $alur['nomor_urut'],
                    ];
                    if ($alur['id']) {
                        $vehicle = AlurProsesRepository::update($alur['id'], $validateData);
                    } else {
                        $vehicle = AlurProsesRepository::create($validateData);
                    }
                }
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

    public function render()
    {
        return view('livewire.alur-pencairan.alur-proses-speed-20.detail');
    }
}
