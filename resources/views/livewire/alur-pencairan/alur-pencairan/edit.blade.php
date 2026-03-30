<div class="">
    {{-- Import Modal --}}
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        wire:ignore.self>
        <div class="modal-dialog modal-fullscreen" style="overflow: scroll">
            <div class="modal-content" style="overflow: scroll">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Alur Pencairan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveChanges">
                    <div class="modal-body import_modal">

                        @if ($alur_pencairan)
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Judul</label>
                                    <p class="form-control">{{$alur_pencairan['judul']}}</p>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Qty cair</label>
                                    <p class="form-control">{{$alur_pencairan['qty_cair']}}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Keterangan</label>
                                    <p class="form-control">{{$alur_pencairan['keterangan']}}</p>
                                </div>
                                <div class="col-md-3 mb-3 row d-flex justify-content-start">
                                    <div class="col-auto">
                                        <label>Status</label><br>
                                        <button type="button" class="btn {{$alur_pencairan['status']== \App\Models\AlurPencairan\AlurPencairan::STATUS_DONE ? 'btn-success' : 'btn-warning'}}" wire:click="updateStatus('{{$alur_pencairan['alur_pencairan_id']}}')">{{$alur_pencairan['status']}}</button>
                                    </div>
                                    <div class="col-auto">
                                        <label>Aksi</label><br>
                                        <button type="submit" class="btn btn-primary"> Simpan  </button>
                                    </div>
                                
                                </div>
                            </div>
                        @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-nowrap w-100 h-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:3%;">No</th>
                                            <th class="text-center" style="width:6%;">PIC</th>
                                            <th style="width:30%;">Alur Proses</th>
                                            <th class="text-center" style="width:4%;">Aksi</th>
                                            <th class="text-center">Tanggal</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    @if ($alur_proseses)
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Pak Novi</td> 
                                                <td>Terima email dari pusat dan share ke accounting exata</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Acc Exata</td> 
                                                <td>Share list cair ke HS </td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Acc Exata</td> 
                                                <td>Share list cair ke Finance u blok 01  tarik data</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>HS</td> 
                                                <td>Melengkapi Rekening Kosong </td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_HS] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_HS])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>HS</td> 
                                                <td>Share list cair ke CC</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_HS] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_HS])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>CC</td> 
                                                <td>Kirim gambar list cair u di posting sales</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_CC] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_CC])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>CC</td> 
                                                <td>Kirim Konten N20% Cair u di posting sales</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_CC] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_CC])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>CC</td> 
                                                <td>Kirim ichijikin ke sales </td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_CC] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_CC])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Acc Exata</td> 
                                                <td>Hitung, buat & Share kwitansi ke sales</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Acc Exata</td> 
                                                <td>Cek & Print list cai</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Pak Novi</td> 
                                                <td>Transaksi ke Bank </td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Pak Novi</td> 
                                                <td>Transfer </td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Pak Novi</td> 
                                                <td>Info ke Tim / Grup selesai Transfer</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Finance</td> 
                                                <td>Mutasi transfer</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr data-bs-toggle="collapse"
                                                data-bs-target="#data-salah-transfer" wire:click="getDataSalahTransfer">
                                                <td>{{$no++}}</td>
                                                <td>Finance</td> 
                                                <td>Info Rek Salah (Mencatat list nama yang blm berhasil di Transfer (rek mondai dll))</td>
                                                <td class="d-flex justify-content-center">
                                                    
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}"><p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p></p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                             {{-- COLLAPSE DATA SALAH TRANSFER --}}
                                            <tr>
                                                <td colspan="100" class="p-0 border-0">

                                                    <div
                                                        id="data-salah-transfer"
                                                        class="collapse"
                                                        wire:ignore.self
                                                    >
                                                        <div class="p-3 bg-light">
                                                            <div class="row">
                                                                <div class="col-auto mb-3">
                                                                    @can(PermissionHelper::transform(PermissionHelper::ACCESS_ALUR_PENCAIRAN, PermissionHelper::TYPE_CREATE))
                                                                        <button type="button" wire:loading.attr="disabled" class="btn btn-info mt-3" wire:click="addDataSalahTransfer">
                                                                            Tambah Data Salah Transfer
                                                                        </button>
                                                                        <button type="button" wire:loading.attr="disabled" class="btn btn-success mt-3" wire:click="saveDataSalahTransfer">
                                                                            Simpan
                                                                        </button>
                                                                    @endCan
                                                                </div>
                                                                <table class="table table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>No Input Japan</th>
                                                                            <th>Nama Lengkap</th>
                                                                            <th>Tgl Lahir</th>
                                                                            <th>Nominal Cair</th>
                                                                            <th>Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($data_salah_transfers as $index_data_salah_transfer => $tranfer)
                                                                        @if(Auth::user()->roles[0]->name == 
                                                                        App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                                        [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                                            <tr wire:key="data-salah-transfer-{{$index_data_salah_transfer}}">
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $loop->iteration }}
                                                                                    </p>
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
                                                                                    <input placeholder="Tanggal Lahir" type="date" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_lahir" class="form-control">
                                                                    
                                                                                    @error('data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_lahir')
                                                                                        <div class="text-danger">{{ $message }}</div>
                                                                                    @enderror
                                                                                </td>
                                                                                <td>
                                                                                    <div class="input-group mb-3">
                                                                                        <input placeholder="Nominal Cair" type="number" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.nominal_cair" class="form-control">
                                                                                        {{-- <select class="form-select" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.mata_uang">
                                                                                            @foreach ($this->mata_uang_choices as $key => $name)
                                                                                                <option value="{{$key}}">{{$name}}</option>
                                                                                            @endforeach
                                                                                        </select> --}}
                                                                                    </div>
                                                                                    @error('data_salah_transfers.{{$index_data_salah_transfer}}.nominal_cair')
                                                                                        <div class="text-danger">{{ $message }}</div>
                                                                                    @enderror
                                                                                </td>
                                                                                <td>
                                                                                    @if ($data_salah_transfers[$index_data_salah_transfer]['id'])
                                                                                        <p class="form-control">Dibuat oleh: {{ $data_salah_transfers[$index_data_salah_transfer]['creator_name'] }}</p>
                                                                                    @else
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
                                                                        @else
                                                                            <tr wire:key="data-salah-transfer-{{$index_data_salah_transfer}}">
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $loop->iteration }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['no_input_jepang'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['nama_lengkap'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['tanggal_lahir'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['nominal_cair'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">Dibuat oleh: {{ $data_salah_transfers[$index_data_salah_transfer]['creator_name'] }}</p>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr  data-bs-toggle="collapse"
                                                data-bs-target="#melengkapi-rekening-salah" wire:click="getDataSalahTransfer">
                                                <td>{{$no++}}</td>
                                                <td>HS</td> 
                                                <td>Melengkapi Rekening salah</td>
                                                <td class="d-flex justify-content-center">
                                                    @if ($jumlah_belum_melengkapi_rekening_salah)
                                                        <p class="text-danger">({{$jumlah_belum_melengkapi_rekening_salah}})</p>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" checked disabled>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_HS])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            {{-- COLLAPSE MELENGKAPI REKENING SALAH --}}
                                            <tr>
                                                <td colspan="100" class="p-0 border-0">

                                                    <div
                                                        id="melengkapi-rekening-salah"
                                                        class="collapse"
                                                        wire:ignore.self
                                                    >
                                                        <div class="p-3 bg-light">
                                                            <div class="row">
                                                                @if(Auth::user()->roles[0]->name == 
                                                                App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                                [App\Models\AlurPencairan\AlurPencairan::ROLE_HS])
                                                                    <div class="col-auto mb-3">
                                                                        <button type="button" wire:loading.attr="disabled" class="btn btn-success mt-3" wire:click="saveMelengkapiRekeningSalah">
                                                                            Simpan
                                                                        </button>
                                                                    </div>
                                                                @endif

                                                                <table class="table table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Rekening Terbaru</th>
                                                                            <th>No Input Japan</th>
                                                                            <th>Nama Lengkap</th>
                                                                            <th>Tgl Lahir</th>
                                                                            <th>Nominal Cair</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($data_salah_transfers as $index_data_salah_transfer => $tranfer)
                                                                        
                                                                        @if(Auth::user()->roles[0]->name == 
                                                                        App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                                        [App\Models\AlurPencairan\AlurPencairan::ROLE_HS])
                                                                            <tr wire:key="melengkapi-rekening-salah-{{$index_data_salah_transfer}}">
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $loop->iteration }}
                                                                                    </p>
                                                                                </td>

                                                                                <td>
                                                                                    <input placeholder="Rekening Terbaru" type="text" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.rekening_terbaru" class="form-control {{ $data_salah_transfers[$index_data_salah_transfer]['rekening_terbaru'] ? '' : 'is-invalid' }}">
                                                                                    {!! $data_salah_transfers[$index_data_salah_transfer]['id'] ?  '<div class="form-text">Diupdate oleh: ' . $data_salah_transfers[$index_data_salah_transfer]['updator_rekening_terbaru_name'] . '</div>' : ''!!}

                                                                                    @error('data_salah_transfers.{{$index_data_salah_transfer}}.rekening_terbaru')
                                                                                        <div class="text-danger">{{ $message }}</div>
                                                                                    @enderror
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['no_input_jepang']}}</p>
                                                                    
                                                                                    @error('data_salah_transfers.{{$index_data_salah_transfer}}.no_input_jepang')
                                                                                        <div class="text-danger">{{ $message }}</div>
                                                                                    @enderror
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['nama_lengkap']}}</p>
                                                                    
                                                                                    @error('data_salah_transfers.{{$index_data_salah_transfer}}.nama_lengkap')
                                                                                        <div class="text-danger">{{ $message }}</div>
                                                                                    @enderror
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['tanggal_lahir']}}</p>
                                                                    
                                                                                    @error('data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_lahir')
                                                                                        <div class="text-danger">{{ $message }}</div>
                                                                                    @enderror
                                                                                </td>
                                                                                <td>
                                                                                    <div class="input-group mb-3">
                                                                                        <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['nominal_cair']}}</p>
                                                                                        {{-- <select class="form-select" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.mata_uang">
                                                                                            @foreach ($this->mata_uang_choices as $key => $name)
                                                                                                <option value="{{$key}}">{{$name}}</option>
                                                                                            @endforeach
                                                                                        </select> --}}
                                                                                    </div>
                                                                                    @error('data_salah_transfers.{{$index_data_salah_transfer}}.nominal_cair')
                                                                                        <div class="text-danger">{{ $message }}</div>
                                                                                    @enderror
                                                                                </td>
                                                                            </tr>
                                                                        @else
                                                                            <tr wire:key="melengkapi-rekening-salah-{{$index_data_salah_transfer}}">
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $loop->iteration }}
                                                                                    </p>
                                                                                </td>

                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['rekening_terbaru'] ?? '-' }}
                                                                                        <div class="form-text">Diupdate oleh: {{ $data_salah_transfers[$index_data_salah_transfer]['updator_rekening_terbaru_name'] }}</div>
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['no_input_jepang'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['nama_lengkap'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['tanggal_lahir'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['nominal_cair'] }}
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr data-bs-toggle="collapse"
                                                data-bs-target="#transfer-susulan" wire:click="getDataSalahTransfer">
                                                <td>{{$no++}}</td>
                                                <td>Pak Novi</td> 
                                                <td>Transfer susulan</td>
                                                <td class="d-flex justify-content-center">
                                                    @if ($jumlah_belum_transfer_susulan)
                                                       <p class="text-danger"> ({{$jumlah_belum_transfer_susulan}})</p>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" checked disabled>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            {{-- COLLAPSE TRANSFER SUSULAN --}}
                                            <tr>
                                                <td colspan="100" class="p-0 border-0">

                                                    <div
                                                        id="transfer-susulan"
                                                        class="collapse"
                                                        wire:ignore.self
                                                    >
                                                        <div class="p-3 bg-light">
                                                            <div class="row">
                                                                @if(Auth::user()->roles[0]->name == 
                                                                App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                                [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                                    <div class="col-auto mb-3">
                                                                        <button type="button" wire:loading.attr="disabled" class="btn btn-success mt-3" wire:click="saveTransferSusulan">
                                                                            Simpan
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                                <table class="table table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Tgl transfer</th>
                                                                            <th>Rekening Terbaru</th>
                                                                            <th>No Input Japan</th>
                                                                            <th>Nama Lengkap</th>
                                                                            <th>Tgl Lahir</th>
                                                                            <th>Nominal Cair</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($data_salah_transfers as $index_data_salah_transfer => $tranfer)
                                                                        @if(Auth::user()->roles[0]->name == 
                                                                        App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                                        [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                                            <tr wire:key="transfer-susulan-{{$index_data_salah_transfer}}">
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $loop->iteration }}
                                                                                    </p>
                                                                                </td>

                                                                                <td>
                                                                                    <input placeholder="Tgl Transfer" type="date" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_transfer" class="form-control {{ $data_salah_transfers[$index_data_salah_transfer]['tanggal_transfer'] ? '' : 'is-invalid' }}">
                                                                                    {!! $data_salah_transfers[$index_data_salah_transfer]['id'] ?  '<div class="form-text">Diupdate oleh: ' . $data_salah_transfers[$index_data_salah_transfer]['updator_tanggal_transfer_name'] . '</div>' : ''!!}
                                                                                    @error('data_salah_transfers.{{$index_data_salah_transfer}}.tanggal_transfer')
                                                                                        <div class="text-danger">{{ $message }}</div>
                                                                                    @enderror
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['rekening_terbaru'] ?? '-'}}</p>
                                                                                
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['no_input_jepang']}}</p>
                                                                    
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['nama_lengkap']}}</p>
                                                                    
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['tanggal_lahir']}}</p>
                                                                    
                                                                                </td>
                                                                                <td>
                                                                                    <div class="input-group mb-3">
                                                                                        <p class="form-control">{{$data_salah_transfers[$index_data_salah_transfer]['nominal_cair']}}</p>
                                                                                        {{-- <select class="form-select" wire:model="data_salah_transfers.{{$index_data_salah_transfer}}.mata_uang">
                                                                                            @foreach ($this->mata_uang_choices as $key => $name)
                                                                                                <option value="{{$key}}">{{$name}}</option>
                                                                                            @endforeach
                                                                                        </select> --}}
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @else
                                                                            <tr wire:key="transfer-susulan-{{$index_data_salah_transfer}}">
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $loop->iteration }}
                                                                                    </p>
                                                                                </td>

                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['tanggal_transfer'] ?? '-'}}
                                                                                        <div class="form-text">Diupdate oleh: {{ $data_salah_transfers[$index_data_salah_transfer]['updator_tanggal_transfer_name'] }}</div>
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['rekening_terbaru'] ?? '-' }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['no_input_jepang'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['nama_lengkap'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['tanggal_lahir'] }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="form-control">
                                                                                        {{ $data_salah_transfers[$index_data_salah_transfer]['nominal_cair'] }}
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Pak Novi</td> 
                                                <td>Info ke Tim / Grup selesai Transfer susulan</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_PAK_NOVI])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Finance</td> 
                                                <td>Mutasi ulang susulan</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Sales</td> 
                                                <td>Posting konten</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_SALES] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_SALES])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Sales</td> 
                                                <td>Kirim info Nenkin cair, kirim link u lihat Kwitansi + Ichijikin</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_SALES] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_SALES])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>HS</td> 
                                                <td>Upod & Testimoni</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_HS] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_HS])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Finance</td> 
                                                <td>Cek Kwitansi yang di kirim sales</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Finance</td> 
                                                <td>Arsip Resi Transfer</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Finance</td> 
                                                <td>Blok & isi nominal cair + tanggal cair</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_FINANCE])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>Acc Exata</td> 
                                                <td>Arsip print out list cair beserta slip transaksi bank</td>
                                                <td class="d-flex justify-content-center">
                                                    <input 
                                                    {{ (Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA] ? '' : 'disabled') }}
                                                    class="form-check-input" type="checkbox" wire:model.live="alur_proseses.{{$no - 2}}.is_check">
                                                </td>
                                                <td>
                                                    <p class="{{$alur_proseses[$no - 2]['status'] != App\Models\AlurPencairan\AlurPencairanStatus::STATUS_DONE ? 'text-danger' : 'text-success'}}">{{$alur_proseses[$no - 2]['tanggal_update']}} {{$alur_proseses[$no -2]['creator_name']}}</p>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->roles[0]->name == 
                                                    App\Models\AlurPencairan\ALurPencairan::ROLE_ALIASE
                                                    [App\Models\AlurPencairan\AlurPencairan::ROLE_ACC_EXATA])
                                                        <input type="text" class="form-control py-0" wire:model="alur_proseses.{{$no - 2}}.keterangan" placeholder="-- ISI --">
                                                    @endIf
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"> Simpan  </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('css')
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
    </style>
@endpush