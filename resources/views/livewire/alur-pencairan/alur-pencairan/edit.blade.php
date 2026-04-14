<div class="">
    {{-- Import Modal --}}
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog modal-fullscreen" style="overflow: scroll">
            <div class="modal-content" style="overflow: scroll">
                <div class="modal-header" style="background-color: #327a81;
   color: white;
   font-size: 1.2em;
   padding: 1rem;
   text-align: center;
   text-transform: uppercase;">
                    <div class="row d-flex justify-content-center w-100">
                        <h1 class="modal-title text-white" id="editModalLabel">Alur Pencairan</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body import_modal" style="background-color: lighten(#398B93, 40%);">
                    <div class="table-users">
                        <form wire:submit.prevent="saveChanges">
                            <div class="header">
                                @if ($alur_pencairan)
                            
                                    <div class="row">
                                        <div class="col-auto mb-3">
                                            <label>Judul</label>
                                            @if(Auth::user()->roles[0]->name == 
                                                App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                <input type="text" class="form-control" wire:model="alur_pencairan.judul">
                                            @else
                                                <p class="form-control">{{$alur_pencairan['judul']}}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Qty cair</label>
                                            @if(Auth::user()->roles[0]->name == 
                                                App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                <input type="text" class="form-control" wire:model="alur_pencairan.qty_cair">
                                            @else
                                                <p class="form-control">{{$alur_pencairan['qty_cair']}}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Jenis Pencairan</label>
                                            <p class="form-control">{{$alur_pencairan['type']}}</p>
                                        </div>
                                        <div class="col-auto mb-3">
                                            <label>Keterangan</label>
                                            <p class="form-control">{{$alur_pencairan['keterangan']}}</p>
                                        </div>
                                        <div class="col-md-3 mb-3 row d-flex justify-content-start">
                                            <div class="col-auto">
                                                <label>Status</label><br>
                                                @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA])
                                                    <button type="button" class="btn {{$alur_pencairan['status']== \App\Models\AlurPencairan\AlurPencairan::STATUS_DONE ? 'btn-success' : 'btn-warning'}}" wire:click="updateStatus('{{$alur_pencairan['alur_pencairan_id']}}')">{{$alur_pencairan['status']}}</button>
                                                @else
                                                    <button type="button" class="btn {{$alur_pencairan['status']== \App\Models\AlurPencairan\AlurPencairan::STATUS_DONE ? 'btn-success' : 'btn-warning'}}">{{$alur_pencairan['status']}}</button>
                                                @endif
                                            </div>
                                            <div class="col-auto">
                                                <label>Aksi</label><br>
                                                <button type="submit" class="btn btn-primary"> Simpan  </button>
                                            </div>
                                        
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                        <table class="table table-bordered table-hover text-nowrap w-100 h-100 fixed-parent-table">
                            <thead>
                                <tr>
                                    <th class="fw-bold text-center" style="width:3%;">No</th>
                                    <th class="fw-bold text-center" style="width:6%;">PIC</th>
                                    <th class="fw-bold " style="width:25%;">Alur Proses</th>
                                    <th class="fw-bold text-center" style="width:4%;">Aksi</th>
                                    <th class="fw-bold text-center" style="width:20%;">Tanggal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            @if ($alur_proseses)
                                @php
                                    $array_nomor = [];
                                    $nomor_urut = 0;
                                @endphp
                                <tbody>
                                    {{-- {{dd($alur_proseses)}} --}}
                                    @foreach ($alur_proseses as $index_alur =>  $alur)
                                        @switch($alur['alur_proses_key'])
                                            @case(App\Models\AlurPencairan\AlurProsesDetail::KEY_PLAN_TRANSFER)
                                                @php
                                                    $nomor_urut ++;
                                                @endphp
                                                <tr wire:key="alur-proses-{{$index_alur}}">    
                                                    <td>{{$nomor_urut}}</td>
                                                    <td>{{$alur['user_name'] ? $alur['user_name']." -" : ""}} {{$alur['role_name']}}</td> 
                                                    <td>
                                                        <div class="row d-flex justify-content-center align-items-center">
                                                            <div class="col-auto">   
                                                                Plan Transfer
                                                            </div>
                                                            <div class="col-auto bg-success text-white rounded p-1 m-0">
                                                                @if(
                                                                    Auth::user()->roles[0]->name == 
                                                                    App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                                    [$alur['role_name']] 
                                                                    ) 
                                                                        <input class="form-control m-0" type="date" wire:model.live="plan_transfer">
                                                                @else
                                                                    {{$plan_transfer}}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="d-flex justify-content-center">
                                                        @if(
                                                        Auth::user()->roles[0]->name == 
                                                        App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                        [$alur['role_name']] 
                                                        && (($alur['is_multi'] && $alur['user_id'] == Auth::user()->id) || !$alur['is_multi'])
                                                        ) 
                                                            <input 
                                                            class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$index_alur}}.is_check">
                                                        @else 
                                                            <input 
                                                            class="form-check-input" type="checkbox" {{$alur_proseses[$index_alur]['is_check'] ? 'checked' : ''}} disabled style="border: 1px solid #D9CFC7">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p class="{{$alur_proseses[$index_alur]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-status-done'}}">{{$alur_proseses[$index_alur]['tanggal_update']}} {{$alur_proseses[$index_alur]['creator_name']}}</p>
                                                    </td>
                                                    <td>
                                                        @if(Auth::user()->roles[0]->name == 
                                                            App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                            [$alur['role_name']]
                                                            &&  (($alur['is_multi'] && $alur['user_id'] == Auth::user()->id) || !$alur['is_multi'])
                                                            )
                                                            <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$index_alur}}.keterangan" placeholder="-- ISI --">
                                                        @else
                                                            <p class="py-0">{{$alur_proseses[$index_alur]['keterangan']}}</p>
                                                        @endIf
                                                    </td>
                                                </tr>
                                                @break
                                            @case(App\Models\AlurPencairan\AlurProsesDetail::KEY_INFO_REK_SALAH)
                                                @php
                                                    $nomor_urut ++;
                                                @endphp
                                                <tr wire:key="alur-proses-{{$index_alur}}" data-bs-toggle="collapse"
                                                    data-bs-target="#data-salah-transfer" wire:click="getDataSalahTransfer" style="cursor: pointer;">
                                                    <td>{{$nomor_urut}}</td>
                                                    <td>{{$alur['user_name'] ? $alur['user_name']." -" : ""}} {{$alur['role_name']}}</td> 
                                                    <td>{{$alur['name']}}</td>
                                                    <td class="d-flex justify-content-center">
                                                        <input 
                                                        class="form-check-input" type="checkbox" disabled style="border: 1px solid #D9CFC7" checked>
                                                    </td>
                                                    <td>
                                                        <h3 class="text-danger">Klik untuk melihat detail</h3>
                                                    </td>
                                                    <td>
                                                        @if(Auth::user()->roles[0]->name == 
                                                        App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                        [$alur['role_name']])
                                                            <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$index_alur}}.keterangan" placeholder="-- ISI --">
                                                        @else
                                                            <p class="py-0">{{$alur_proseses[$index_alur]['keterangan']}}</p>
                                                        @endIf
                                                    </td>
                                                </tr>
                                                {{-- COLLAPSE DATA SALAH TRANSFER --}}
                                                <tr wire:key="alur-detail-{{$index_alur}}">
                                                    <td colspan="100" class="p-0 border-0">

                                                        <div
                                                            id="data-salah-transfer"
                                                            class="collapse auto-close-collapse"
                                                            wire:ignore.self
                                                        >
                                                            <div class="p-3 bg-light">
                                                                <div class="row">
                                                                    
                                                                {{-- BUTTON --}}
                                                                <form wire:submit.prevent="saveDataSalahTransfer">
                                                                    @if(Auth::user()->roles[0]->name == 
                                                                    App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                                        <div class="col-auto mb-3">
                                                                            <button type="button" wire:loading.attr="disabled" class="btn btn-info mt-3" wire:click="addDataSalahTransfer">
                                                                                Tambah Data Salah Transfer
                                                                            </button>
                                                                            <button type="button" wire:loading.attr="disabled" class="btn btn-success mt-3" wire:click="saveDataSalahTransfer">
                                                                                Simpan
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                        
                                                                    <table class="table table-sm table-no-bg">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center fs-4 fw-bold">No</th>
                                                                                <th class="text-center fs-4 fw-bold">Rekening Lama</th>
                                                                                <th class="text-center fs-4 fw-bold">No Input Japan</th>
                                                                                <th class="text-center fs-4 fw-bold">Nama Lengkap</th>
                                                                                <th class="text-center fs-4 fw-bold">Tgl Lahir</th>
                                                                                <th class="text-center fs-4 fw-bold">Nominal Cair</th>
                                                                                <th class="text-center fs-4 fw-bold">Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($data_salah_transfers as $index_data_salah_transfer => $tranfer)
                                                                            @if(Auth::user()->roles[0]->name == 
                                                                            App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                                            [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                                                <tr wire:key="data-salah-transfer-{{$index_data_salah_transfer}}">
                                                                                    <td rowspan="2">
                                                                                        <p class="">{{ $loop->iteration }}</p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="row d-flex justify-content-between gap-0">
                                                                                            <div class="col mx-0 px-0">
                                                                                                <input type="text" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.rekening_lama" placeholder="Rekening Lama" class="form-control mx-0 px-1">
                                                                                            </div>
                                                                                            <div class="col-md-4 mx-0 px-0">
                                                                                                <select wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.jenis_rekening_lama" class="form-select">
                                                                                                    @foreach (App\Models\AlurPencairan\AlurPencairanDetail::JENIS_REKENING_CHOICE as $key => $name)    
                                                                                                        <option value="{{$name}}">{{$name}}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input placeholder="No input Jepang" type="text" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.no_input_jepang" class="form-control">
                                                                        
                                                                                        @error('data_salah_transfers.{{$index_data_salah_transfer}}.no_input_jepang')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </td>
                                                                                    <td>
                                                                                        <input placeholder="Nama Lengkap" type="text" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.nama_lengkap" class="form-control">
                                                                        
                                                                                        @error('data_salah_transfers.{{$index_data_salah_transfer}}.nama_lengkap')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </td>
                                                                                    <td>
                                                                                        <input placeholder="Tanggal Lahir" type="text" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_lahir_input" class="form-control">
                                                                        
                                                                                        @error('data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_lahir_input')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="row d-flex justify-content-between gap-0">
                                                                                            <div class="col mx-0 px-0">
                                                                                                <input placeholder="Nominal Cair" type="text" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.nominal_cair" class="form-control currency" max="999999999999999">
                                                                                            </div>
                                                                                            <div class="col-md-6 mx-0 px-0">
                                                                                                <select wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.mata_uang" class="form-select">
                                                                                                    @foreach (App\Models\AlurPencairan\AlurPencairanDetail::MATA_UANG_CHOICE as $key => $name)    
                                                                                                        <option value="{{$name}}">{{$name}}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        @error('data_salah_transfers.{{$index_data_salah_transfer}}.nominal_cair')
                                                                                            <div class="text-danger">{{ $message }}</div>
                                                                                        @enderror
                                                                                    </td>
                                                                                    <td>
                                                                                        @if (!$data_salah_transfers[$index_data_salah_transfer]['id'])
                                                                                            
                                                                                            <button type="button" wire:loading.attr="disabled" class="btn btn-danger" wire:click="removeDataTransfer('{{$index_data_salah_transfer}}')">
                                                                                                <i class="ki-duotone ki-trash fs-1">
                                                                                                    <span class="path1"></span>
                                                                                                    <span class="path2"></span>
                                                                                                    <span class="path3"></span>
                                                                                                    <span class="path4"></span>
                                                                                                    <span class="path5"></span>
                                                                                                </i>
                                                                                            </button>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr wire:key="keterangan-data-salah-transfer-{{$index_data_salah_transfer}}">
                                                                                    <td colspan="6">
                                                                                        <input placeholder="Keterangan" type="text" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.keterangan" class="form-control">
                                                                                            @if ( $data_salah_transfers[$index_data_salah_transfer]['id'])
                                                                                            <p class="form-text mb-0 pb-0 text-info">Dibuat oleh: {{ $data_salah_transfers[$index_data_salah_transfer]['creator_name'] }}</p>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @else

                                                                                <tr wire:key="data-salah-transfer-{{$index_data_salah_transfer}}">
                                                                                    <td rowspan="2">
                                                                                        <p class="">
                                                                                            {{ $loop->iteration }}
                                                                                        </p>
                                                                                    </td>
                                                                                        <td class="text-center">{{$tranfer['rekening_lama']}} ({{$tranfer['jenis_rekening_lama']}})</td>

                                                                                        <td>{{$tranfer['no_input_jepang']}}</td>

                                                                                        <td>{{$tranfer['nama_lengkap']}}</td>

                                                                                        <td>{{$tranfer['tanggal_lahir']}}</td>

                                                                                        <td class="text-start">@currency($tranfer['nominal_cair']) ({{$tranfer['mata_uang']}})</td>
                                                                                    <td>
                                                                                        
                                                                                    </td>
                                                                                </tr>

                                                                                <tr wire:key="keterangan-data-salah-transfer-{{$index_data_salah_transfer}}">
                                                                                    <td colspan="6">
                                                                                        <p class="text-dark my-0 py-0">Keterangan: <span class="text-danger">{{$tranfer['keterangan']}}</span></p>
                                                                                        @if($tranfer['id'])
                                                                                            <div class="form-text text-info my-0 py-0">
                                                                                                Dibuat oleh:
                                                                                                {{ $data_salah_transfers[$index_data_salah_transfer]['creator_name'] }}
                                                                                            </div>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    
                                                                        <div class="col-auto mb-3">
                                                                            @if(Auth::user()->roles[0]->name == 
                                                                            App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                                            [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                                                <button type="button" wire:loading.attr="disabled" class="btn btn-info mt-3" wire:click="addDataSalahTransfer">
                                                                                    Tambah Data Salah Transfer
                                                                                </button>
                                                                                <button type="button" wire:loading.attr="disabled" class="btn btn-success mt-3" wire:click="saveDataSalahTransfer">
                                                                                    Simpan
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                    </td>
                                                </tr>
                                                @break
                                            @case(App\Models\AlurPencairan\AlurProsesDetail::KEY_MELENGKAPI_REK_SALAH)
                                                @php
                                                    $nomor_urut ++;
                                                @endphp
                                                <tr wire:key="alur-proses-{{$index_alur}}"  data-bs-toggle="collapse"
                                                    data-bs-target="#melengkapi-rekening-salah" wire:click="getDataSalahTransfer" style="cursor: pointer;">
                                                    <td>{{$nomor_urut}}</td>
                                                    <td>{{$alur['role_name']}}</td> 
                                                    <td>{{$alur['name']}}</td>
                                                    <td class="d-flex justify-content-center">
                                                        @if ($jumlah_belum_melengkapi_rekening_salah)
                                                            <h3 class="text-danger"> ({{$jumlah_belum_melengkapi_rekening_salah}})</h3>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" checked disabled style="border: 1px solid #D9CFC7">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <h3 class="text-danger">Klik untuk melihat detail</h3>
                                                    </td>
                                                    <td>
                                                        @if(Auth::user()->roles[0]->name == 
                                                        App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                        [$alur['role_name']])
                                                            <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$index_alur}}.keterangan" placeholder="-- ISI --">
                                                        @else
                                                            <p class="py-0">{{$alur_proseses[$index_alur]['keterangan']}}</p>
                                                        @endIf
                                                    </td>
                                                </tr>
                                                {{-- COLLAPSE MELENGKAPI REKENING SALAH --}}
                                                <tr wire:key="alur-detail-{{$index_alur}}">
                                                    <td colspan="100" class="p-0 border-0">

                                                        <div
                                                            id="melengkapi-rekening-salah"
                                                            class="collapse auto-close-collapse"
                                                            wire:ignore.self
                                                        >
                                                            <div class="p-3 bg-light">
                                                                <div class="row">
                                                                    
                                                                    {{-- BUTTON --}}
                                                                    <form wire:submit.prevent="saveMelengkapiRekeningSalah">
                                                                    @if(Auth::user()->roles[0]->name ==
                                                                        App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                                        [App\Models\AlurPencairan\AlurPencairan::ROLE_HS])
                                                                            <div class="mb-3">
                                                                                <button
                                                                                    type="submit"
                                                                                    class="btn btn-success"
                                                                                    wire:click="saveMelengkapiRekeningSalah"
                                                                                    wire:loading.attr="disabled"
                                                                                >
                                                                                    Simpan
                                                                                </button>
                                                                            </div>
                                                                        

                                                                    @endif
                                                                    
                                                                    <table class="table table-sm table-no-bg">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center fs-4 fw-bold">No</th>
                                                                                <th class="text-center fs-4 fw-bold">Rekening Terbaru</th>
                                                                                <th class="text-center fs-4 fw-bold">Rekening Lama</th>
                                                                                <th class="text-center fs-4 fw-bold">No Input Jepang</th>
                                                                                <th class="text-center fs-4 fw-bold">Nama Lengkap</th>
                                                                                <th class="text-center fs-4 fw-bold">Tgl Lahir</th>
                                                                                <th class="text-center fs-4 fw-bold">Nominal Cair</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>

                                                                        @foreach ($data_salah_transfers as $index_data_salah_transfer => $tranfer)

                                                                            <tr wire:key="transfer-{{$index_data_salah_transfer}}">

                                                                                <td rowspan="2">{{$loop->iteration}}</td>

                                                                                <td>
                                                                                    @if(Auth::user()->roles[0]->name == 
                                                                                    App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_HS])

                                                                                        <div class="d-flex gap-0 p-0 m-0">
                                                                                            <input
                                                                                                type="text"
                                                                                                class="px-0 py-1 m-0 form-control
                                                                                                {{ $data_salah_transfers[$index_data_salah_transfer]['rekening_terbaru'] ? '' : 'is-invalid' }}"
                                                                                                style="width: 300px;"
                                                                                                wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.rekening_terbaru"
                                                                                                
                                                                                            >

                                                                                            <select
                                                                                                class="px-0 py-1 m-0 form-select" style="width: 120px;"
                                                                                                wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.jenis_rekening_terbaru"
                                                                                            >
                                                                                                @foreach(App\Models\AlurPencairan\AlurPencairanDetail::JENIS_REKENING_CHOICE as $name)
                                                                                                    <option value="{{$name}}">{{$name}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    @else
                                                                                        <p class="text-center">{{$tranfer['rekening_terbaru'] ? $tranfer['rekening_terbaru'] ." ( ".$tranfer['jenis_rekening_terbaru']." )" : "-"}}</p>

                                                                                    @endif
                                                                                </td>

                                                                                {{-- <td>{{$tranfer['rekening_lama']}} ({{$tranfer['jenis_rekening_lama']}})</td> --}}
                                                                                <td>{{$tranfer['rekening_lama']}} ({{$tranfer['jenis_rekening_lama']}})</td>

                                                                                <td>{{$tranfer['no_input_jepang']}}</td>

                                                                                <td>{{$tranfer['nama_lengkap']}}</td>

                                                                                <td>{{$tranfer['tanggal_lahir']}}</td>

                                                                                <td>@currency($tranfer['nominal_cair']) ({{$tranfer['mata_uang']}})</td>

                                                                            </tr>


                                                                            <tr wire:key="transfer-ket-{{$index_data_salah_transfer}}">
                                                                                <td colspan="6" class="my-0 py-0">
                                                                                <p class="text-dark my-0 py-0">Keterangan: <span class="text-danger">{{$tranfer['keterangan']}}</span></p>

                                                                                    @if($tranfer['updator_rekening_terbaru_name'])
                                                                                        <div class="form-text text-info my-0 py-0">
                                                                                            Diupdate oleh:
                                                                                            {{$tranfer['updator_rekening_terbaru_name']}}
                                                                                            , pada:
                                                                                            {{$tranfer['rekening_terbaru_updated_at']}}
                                                                                        </div>
                                                                                    @endif

                                                                                </td>
                                                                            </tr>

                                                                        @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                    </td>
                                                </tr>
                                                @break
                                            @case(App\Models\AlurPencairan\AlurProsesDetail::KEY_TRANSFER_SUSULAN)
                                                @php
                                                    $nomor_urut ++;
                                                @endphp
                                                <tr wire:key="alur-proses-{{$index_alur}}" data-bs-toggle="collapse"
                                                    data-bs-target="#transfer-susulan" wire:click="getDataSalahTransfer" style="cursor: pointer;">
                                                    <td>{{$nomor_urut}}</td>
                                                    <td>{{$alur['user_name'] ? $alur['user_name']." -" : ""}} {{$alur['role_name']}}</td> 
                                                    <td>{{$alur['name']}}</td>
                                                    <td class="d-flex justify-content-center">
                                                        @if ($jumlah_belum_transfer_susulan)
                                                            <h3 class="text-danger"> ({{$jumlah_belum_transfer_susulan}})</h3>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" checked disabled style="border: 1px solid #D9CFC7">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <h3 class="text-danger">Klik untuk melihat detail</h3>
                                                    </td>
                                                    <td>
                                                        @if(Auth::user()->roles[0]->name == 
                                                        App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                        [$alur['role_name']])
                                                            <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$index_alur}}.keterangan" placeholder="-- ISI --">
                                                        @else
                                                            <p class="py-0">{{$alur_proseses[$index_alur]['keterangan']}}</p>
                                                        @endIf
                                                    </td>
                                                </tr>
                                                {{-- COLLAPSE TRANSFER SUSULAN --}}
                                                <tr wire:key="alur-detail-{{$index_alur}}">
                                                    <td colspan="100" class="p-0 border-0">

                                                        <div
                                                            id="transfer-susulan"
                                                            class="collapse auto-close-collapse"
                                                            wire:ignore.self
                                                        >
                                                            <div class="p-3 bg-light">
                                                                <form wire:submit.prevent="saveTransferSusulan">
                                                                <div class="row">
                                                                    @if(Auth::user()->roles[0]->name == 
                                                                    App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                                        <div class="col-auto mb-3">
                                                                            <button type="submit" wire:loading.attr="disabled" class="btn btn-success mt-3" wire:click="saveTransferSusulan">
                                                                                Simpan
                                                                            </button>
                                                                        </div>
                                                                    @endif

                                                                    <table class="table table-sm table-no-bg">
                                                                        <thead>

                                                                            <tr>
                                                                                <th class="text-center fs-4 fw-bold">No</th>
                                                                                <th class="text-center fs-4 fw-bold">Tgl transfer</th>
                                                                                <th class="text-center fs-4 fw-bold">Rekening Terbaru</th>
                                                                                <th class="text-center fs-4 fw-bold">Rekening Lama</th>
                                                                                <th class="text-center fs-4 fw-bold">No Input Japan</th>
                                                                                <th class="text-center fs-4 fw-bold">Nama Lengkap</th>
                                                                                <th class="text-center fs-4 fw-bold">Tgl Lahir</th>
                                                                                <th class="text-center fs-4 fw-bold">Nominal Cair</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>

                                                                        @foreach ($data_salah_transfers as $index_data_salah_transfer => $tranfer)
                                                                            

                                                                            <tr wire:key="transfer-susulan-{{$index_data_salah_transfer}}">

                                                                                <td rowspan="2">{{$loop->iteration}}</td>

                                                                                <td>
                                                                                    @if(Auth::user()->roles[0]->name == 
                                                                                        App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                                                        [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])

                                                                                        <div class="d-flex gap-0 p-0 m-0">
                                                                                            <input placeholder="Tgl Transfer" type="date" 
                                                                                            wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_transfer" 
                                                                                            class="form-control mb-0 {{ $data_salah_transfers[$index_data_salah_transfer]['tanggal_transfer'] ? '' : 'is-invalid' }}">
                                                                                            
                                                                                            @error('data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_transfer')
                                                                                                <div class="text-danger">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    @else
                                                                                        <p class="my-0 py-0 fs-5 fw-bold text-center">
                                                                                            {{$tranfer['tanggal_transfer'] ? $tranfer['tanggal_transfer'] : "-"}}
                                                                                        </p>

                                                                                    @endif
                                                                                </td>

                                                                                <td>{{$tranfer['rekening_terbaru'] ? $tranfer['rekening_terbaru'] ."( ".$tranfer['jenis_rekening_terbaru']." )" : '-'}}</td>

                                                                                <td>{{$tranfer['rekening_lama']}} ({{$tranfer['jenis_rekening_lama']}})</td>

                                                                                <td>{{$tranfer['no_input_jepang']}}</td>

                                                                                <td>{{$tranfer['nama_lengkap']}}</td>

                                                                                <td>{{$tranfer['tanggal_lahir']}}</td>

                                                                                <td>@currency($tranfer['nominal_cair']) ({{$tranfer['mata_uang']}})</td>

                                                                            </tr>


                                                                            <tr wire:key="transfer-susulan-ket-{{$index_data_salah_transfer}}">
                                                                                <td colspan="7" class="my-0 py-0">
                                                                                    <p class="text-dark my-0 py-0">Keterangan: <span class="text-danger">{{$tranfer['keterangan']}}</span></p>

                                                                                    @if($tranfer['updator_tanggal_transfer_name'])
                                                                                        <div class="form-text text-info my-0 py-0">
                                                                                            Diupdate oleh:
                                                                                            {{$tranfer['updator_tanggal_transfer_name']}}
                                                                                            , pada:
                                                                                            {{$tranfer['tanggal_transfer_updated_at']}}
                                                                                        </div>
                                                                                    @endif

                                                                                </td>
                                                                            </tr>

                                                                        @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                    </td>
                                                </tr>
                                                @break
                                            @default
                                            @php
                                                if($alur['is_multi']){
                                                    if(!in_array($alur['name'], $array_nomor)){
                                                        $nomor_urut ++;
                                                        $array_nomor[] = $alur['name'];
                                                    }
                                                }else{
                                                    $nomor_urut ++;
                                                }
                                            @endphp
                                            @if (
                                            empty(json_decode($alur['role_can_show'])) ||
                                            (!empty(json_decode($alur['role_can_show'])) && in_array(Auth::user()->roles[0]->name, json_decode($alur['role_can_show'])))
                                            )
                                                <tr wire:key="alur-proses-{{$index_alur}}">
                                                    {{-- <td>{{$loop->iteration}}</td> --}}
                                                    <td>{{$nomor_urut}}</td>
                                                    <td>{{$alur['user_name'] ? $alur['user_name']." -" : ""}} {{$alur['role_name']}}</td> 
                                                    <td>{{$alur['name']}}</td>
                                                    <td class="d-flex justify-content-center">
                                                        @if(
                                                            Auth::user()->roles[0]->name == 
                                                        App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                        [$alur['role_name']] 
                                                        && (($alur['is_multi'] && $alur['user_id'] == Auth::user()->id) || !$alur['is_multi'])
                                                        && ($alur['by_user'] && $alur['user_id'] == Auth::user()->id || !$alur['by_user'])
                                                        ) 
                                                            <input 
                                                            class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$index_alur}}.is_check">
                                                        @else 
                                                            <input 
                                                            class="form-check-input" type="checkbox" {{$alur_proseses[$index_alur]['is_check'] ? 'checked' : ''}} disabled style="border: 1px solid #D9CFC7">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p class="{{$alur_proseses[$index_alur]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-status-done'}}">{{$alur_proseses[$index_alur]['status_updated_at']}} {{$alur_proseses[$index_alur]['creator_name']}}</p>
                                                    </td>
                                                    <td>
                                                        @if(Auth::user()->roles[0]->name == 
                                                        App\Models\AlurPencairan\AlurPencairan::ROLE_ALIASE
                                                        [$alur['role_name']]
                                                        &&  (($alur['is_multi'] && $alur['user_id'] == Auth::user()->id) || !$alur['is_multi'])
                                                        )
                                                            <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$index_alur}}.keterangan" placeholder="-- ISI --">
                                                        @else
                                                            <p class="py-0">{{$alur_proseses[$index_alur]['keterangan']}}</p>
                                                        @endIf
                                                    </td>
                                                </tr>  
                                            @endif
                                        @endswitch

                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center" style="background-color: #327a81;"">
                    <button type="submit" class="btn btn-primary"> Simpan  </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
                
            </div>
        </div>
    </div>
</div>


@push('css')
    {{-- TABLE COLLAPSE --}}
    <style>
        /* ===== keep parent table fixed ===== */   

    /* parent holder */
    .collapse-parent{
        position:relative;
        padding:0 !important;
    }

    /* FLOAT collapse OUTSIDE table layout */
    .collapse-floating{
        position:absolute;
        left:0;
        top:100%;
        width:100%;
        z-index:50;

        background:#f8f9fa;
        border:1px solid #dee2e6;
        box-shadow:0 6px 12px rgba(0,0,0,.1);
    }

    /* horizontal scroll only here */
    .collapse-floating .table-scroll-x{
        overflow-x:auto;
        overflow-y:auto;
        width:100%;
        -webkit-overflow-scrolling:touch;
    }

    /* force scroll */
    .collapse-floating table{
        min-width:1200px;
        white-space:nowrap;
    }
    .detail-scroll-wrapper{
        height:100%;
        max-height:65vh;

        overflow-y:auto;     /* ⭐ vertical scroll */
        overflow-x:hidden;

        -webkit-overflow-scrolling:touch;
    }

    /* horizontal scroll */
    .table-scroll-x{
        width:100%;
        overflow-x:auto;
    }

    /* force horizontal scroll */
    .table-scroll-x table{
        min-width:1200px;
        white-space:nowrap;
    }
    </style>
    <style>
        
        .modal-body {
        background-color: #acdce0;
        }
        .modal-body * {
        box-sizing: border-box;
        }

        .header {
        background-color: #327a81;
        color: white;
        font-size: 1.2em;
        padding: 1rem;
        text-align: center;
        text-transform: uppercase;
        }

        .text-status-done{
            color: #2b686e;
        }

        .table-users {
        border: 1px solid #327a81;
        border-radius: 10px;
        box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
        max-width: calc(100% - 1em);
        margin: 1em auto;
        overflow: hidden;
        }

        table {
        width: 100%;
        }
        table td,
        table th {
        color: #2b686e;
        padding: 10px;
        }
        table td {
        text-align: center;
        vertical-align: middle;
        }
        table td:last-child {
        font-size: 0.95em;
        line-height: 1.4;
        text-align: left;
        }
        table th {
        background-color: #daeff1;
        font-weight: 300;
        }
        table tr:nth-child(2n) {
        background-color: white;
        }
        table tr:nth-child(2n+1) {
        background-color: #edf7f8;
        }
        table.table-no-bg tr:nth-child(4n-3),
        table.table-no-bg tr:nth-child(4n-2) {
            background-color: #afe3e8; /* group 1 */
        }

        table.table-no-bg tr:nth-child(4n-1),
        table.table-no-bg tr:nth-child(4n) {
            background-color: #ffffff; /* group 2 */
        }

        @media screen and (max-width: 700px) {
        table,
        tr,
        td {
            display: block;
        }

        td:first-child {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100px;
        }
        td:not(:first-child) {
            clear: both;
            margin-left: 100px;
            padding: 4px 20px 4px 90px;
            position: relative;
            text-align: left;
        }
        td:not(:first-child):before {
            color: #acdce0;
            content: "";
            display: block;
            left: 0;
            position: absolute;
        }
        td:nth-child(2):before {
            content: "Name:";
        }
        td:nth-child(3):before {
            content: "Email:";
        }
        td:nth-child(4):before {
            content: "Phone:";
        }
        td:nth-child(5):before {
            content: "Comments:";
        }

        tr {
            padding: 10px 0;
            position: relative;
        }
        tr:first-child {
            display: none;
        }
        }
        @media screen and (max-width: 500px) {
        .header {
            background-color: transparent;
            color: white;
            font-size: 2em;
            font-weight: 700;
            padding: 0;
            text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.1);
        }

        img {
            border: 3px solid;
            border-color: #daeff1;
            height: 100px;
            margin: 0.5rem 0;
            width: 100px;
        }

        td:first-child {
            background-color: #c8e7ea;
            border-bottom: 1px solid #acdce0;
            border-radius: 10px 10px 0 0;
            position: relative;
            top: 0;
            transform: translateY(0);
            width: 100%;
        }
        td:not(:first-child) {
            margin: 0;
            padding: 5px 1em;
            width: 100%;
        }
        td:not(:first-child):before {
            font-size: 0.8em;
            padding-top: 0.3em;
            position: relative;
        }
        td:last-child {
            padding-bottom: 1rem !important;
        }

        tr {
            background-color: white !important;
            border: 1px solid #6cbec6;
            border-radius: 10px;
            box-shadow: 2px 2px 0 rgba(0, 0, 0, 0.1);
            margin: 0.5rem 0;
            padding: 0;
        }

        .table-users {
            border: none;
            box-shadow: none;
            overflow: visible;
        }
        }
    </style>
    <style>

        input[type=checkbox] {
            /* Double-sized Checkboxes */
            -ms-transform: scale(1.2);
            /* IE */
            -moz-transform: scale(1.2);
            /* FF */
            -webkit-transform: scale(1.2);
            /* Safari and Chrome */
            -o-transform: scale(1.2);
            /* Opera */
            padding: 10px;
            border:1px solid black;
        }
        @keyframes pulse-wand {
            0%   { transform: scale(1);   opacity: 1; }
            50%  { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1);   opacity: 1; }
        }

        .animate-wand {
            animation: pulse-wand 1s infinite ease-in-out;
        }
        .progress-box {
            width: 24px;
            height: 24px;
            border-radius: 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>

    <style>
        /* ===== collapse table fix ===== */

    .collapse-wrapper{
        width:100%;
        padding:1rem;
        background:#f8f9fa;
    }

    /* horizontal scroll */
    .table-scroll-x{
        width:100%;
        overflow-x:auto;
        overflow-y:hidden;
        -webkit-overflow-scrolling:touch;
    }

    /* force scroll activation */
    .table-scroll-x table{
        min-width:1200px;
        white-space:nowrap;
    }

    /* sticky header (pro UX) */
    .table-scroll-x thead th{
        position:sticky;
        top:0;
        background:#fff;
        z-index:5;
    }
    </style>
@endpush

@include('js.imask')

@push('js')
    <script>
        $(document).ready(function () {

            $('#editModal').on('hidden.bs.modal', function () {
                closeCollapse();
            });
            Livewire.on('closeEditModal', (res) => {
                $('#editModal').modal('hide');
                closeCollapse();
                Livewire.dispatch('refresh-table');
            });

            function closeCollapse(){
                $('.auto-close-collapse').collapse('hide');
            }

        });
    </script>
    <script>
        function initTooltip() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        }

        document.addEventListener('DOMContentLoaded', initTooltip);
</script>
@endpush
    