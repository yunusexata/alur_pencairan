<?php

namespace App\Livewire\AlurPencairan\AlurPencairan;

use App\Helpers\Alert;
use App\Helpers\PermissionHelper;
use App\Models\AlurPencairan\AlurPencairan;
use App\Repositories\Account\UserRepository;
use App\Repositories\AlurPencairan\AlurPencairanRepository;
use App\Traits\Livewire\WithDatatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;


class Datatable extends Component
{
    use WithDatatable;

    public $isCanUpdate;
    public $isCanDelete;

    // Delete Dialog
    public $targetDeleteId;

    public function onMount()
    {
        $this->sortBy = 'status';
        $this->sortDirection = 'desc';
        $authUser = UserRepository::authenticatedUser();
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_ALUR_PENCAIRAN, PermissionHelper::TYPE_UPDATE));
        $this->isCanDelete = $authUser->hasPermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_ALUR_PENCAIRAN, PermissionHelper::TYPE_DELETE));
    }

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        if (!$this->isCanDelete || $this->targetDeleteId == null) {
            return;
        }

        AlurPencairanRepository::delete($this->targetDeleteId);
        Alert::success($this, 'Berhasil', 'Data berhasil dihapus');
    }

    #[On('on-delete-dialog-cancel')]
    public function onDialogDeleteCancel()
    {
        $this->targetDeleteId = null;
    }

    public function showDeleteDialog($id)
    {
        $this->targetDeleteId = $id;

        Alert::confirmation(
            $this,
            Alert::ICON_QUESTION,
            "Hapus Data",
            "Apakah Anda Yakin Ingin Menghapus Data Ini ?",
            "on-delete-dialog-confirm",
            "on-delete-dialog-cancel",
            "Hapus",
            "Batal",
        );
    }

    #[On('refresh-table')]
    public function refreshTable()
    {
        $this->resetPage();
    }


    public function getColumns(): array
    {
        return [
            [
                'name' => 'Action',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {
                    $editHtml = "";

                    $id = Crypt::encrypt($item->id);
                    if ($this->isCanUpdate) {
                        // $editUrl = route('alur_pencairan.edit', $id);
                        $editHtml = "<div class='col-auto mb-2'>
                            <button type='button' class='btn btn-primary btn-sm' 
                                data-bs-toggle='modal'
                                data-bs-target='#editModal'
                                x-data
                                @click=\"\$dispatch('editAlurPencairan', { alur_pencairan_id: '" . $id . "' })\">
                                <i class='ki-duotone ki-notepad-edit fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Ubah
                            </button>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($this->isCanDelete) {
                        $destroyHtml = "<div class='col-auto mb-2'>
                            <button class='btn btn-danger btn-sm m-0' 
                                wire:click=\"showDeleteDialog($item->id)\">
                                <i class='ki-duotone ki-trash fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                                Hapus
                            </button>
                        </div>";
                    }

                    $html = "<div class='row'>
                        $editHtml 
                        $destroyHtml 
                    </div>";

                    return $html;
                },
            ],
            [
                'key' => 'plan_transfer',
                'name' => 'Plan Transfer',
            ],
            [
                'key' => 'judul',
                'name' => 'Judul',
            ],
            [
                'key' => 'type',
                'name' => 'Jenis Pencairan',
                'class' => 'text-center',
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'key' => 'status',
                'name' => 'Progress Status',
                'render' => function ($item) {
                    $statuses = [];
                    foreach (collect($item->alurPencairanStatuses)->sortBy('nomor_urut')->values() as $status) {
                        $statuses[] = [
                            'name' => $status->name . ' oleh : ' . $status->role_name,
                            'status' => $status->getProgressStatus(),
                            'color' => $status->user->color,
                            'nomor_urut' => $status->nomor_urut
                        ];
                    }
                    $html = '<div class="d-flex justify-content-start gap-1 con mb-2">';
                    foreach ($statuses as $index => $proses) {
                        if ($index % 10 == 0) {
                            $html .= '</div>
                            <div class="d-flex justify-content-start gap-1 con">';
                        }


                        $html .= '<span
                            class="progress-box mb-1"
                            style="background-color:' . ($proses['status'] ? '#50CD89' : $proses['color']) . '" 
                            data-bs-toggle="tooltip"
                            title="' . $proses['name'] . '"
                        ><p class="text-center text-light">' . ($proses['nomor_urut']) . '</p></span>';
                    }

                    $html .= '</div>';
                    return $html;
                }
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Keterangan',
                'render' => function ($item) {
                    return "Total : " . $item['qty_cair'] . ", Belum Transfer : " . $item->alurPencairanDetailOnProses->count() . ", Valid :" . $item['qty_cair'] - $item->alurPencairanDetailOnProses->count();
                }
            ],
            [
                'key' => 'created_at',
                'name' => 'Tanggal dibuat',
                'class' => 'text-center',
            ],
            [
                'key' => 'status',
                'name' => 'Status',
                'class' => 'text-center',
                'render' => function ($item) {
                    return '<span class="btn ' . ($item["status"] == AlurPencairan::STATUS_DONE ? "btn-success" : "btn-warning") . '">' . $item['status'] . '</span>';
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        return AlurPencairanRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.alur-pencairan.alur-pencairan.datatable';
    }
}
