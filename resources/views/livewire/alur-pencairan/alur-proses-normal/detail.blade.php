<div>

    <form wire:submit.prevent="store">
        
    <div wire:loading wire:target="images, store"
     class="position-fixed top-0 start-0 w-100 h-100 
            bg-dark bg-opacity-50 
            justify-content-center align-items-center"
     style="z-index:9999;">

        <div class="bg-white p-4 rounded shadow">
            <p class="text-dark" style="font-size: 1.5rem; width: 100%; text-align: center;"> 
                <i class="text-dark animate-wand fas fa-wand-magic-sparkles text-dark"></i> &nbsp; Sedang Memproses
            </p>
        </div>
    </div>
        <div class="row">
            <div class="col-auto mb-3">
                <button type="button" wire:loading.attr="disabled" class="btn btn-info mt-3" wire:click="addAlurProses()">
                    Tambah Alur Proses
                </button>
            </div>
            @foreach ($alur_proseses as $index => $proses)
                <div class="row" wire:key="alur-proses-{{$proses['alur_proses_detail_id']}}">
                    <div class="row col-md-10">
                        <div class="col-auto">
                            @if (!$index)
                                <label class="mb-3">Nomor Urut</label>
                            @endif
                             <input
                            type="number"
                            wire:model.lazy="alur_proseses.{{ $index }}.nomor_urut"
                            class="form-control"
                        >
                            @error('alur_proseses.{{$index}}.nomor_urut')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 text-center">
                            @if (!$index)
                                <label class="mb-3">Jabatan</label>
                            @endif
                            <select class="form-select mb-2 @error('role') is-invalid @enderror" wire:model="alur_proseses.{{$index}}.role_name">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" class="text-center">{{ $role }}</option>
                                @endforeach
                            </select>

                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            @if (!$index)
                                <label class="mb-3">Nama Alur Proses</label>
                            @endif
                            <input placeholder="Nama Alur Proses" type="text" wire:model="alur_proseses.{{$index}}.name" class="form-control mb-2">
    
                            @error('alur_proseses.{{$index}}.name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row col-md-2 d-flex align-items-end">
                        @if (!$index)
                            <label class="mb-3">Aksi</label>
                        @endif
                        <div class="col-auto" >
                            <button type="button" wire:loading.attr="disabled" class="btn btn-danger mb-2" wire:click="removeAlurProses('{{$index}}')">
                                <i class="ki-duotone ki-trash fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mt-3">
            Save
        </button>
        

    </form>

</div>

@push('css')
    <style>
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