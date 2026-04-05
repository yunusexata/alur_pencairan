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
            <div class="col-md-4 mb-3">
                <label>Judul</label>
                <input placeholder="Judul" type="text" wire:model="judul" class="form-control">

                @error('judul')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 mb-3">
                <label>Qty cair</label>
                <input placeholder="Qty cair" type="number" wire:model="qty_cair" class="form-control">

                @error('qty_cair')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-auto">
                <label>Jenis Pencairan</label>
                <select class="form-select mb-2 @error('type') is-invalid @enderror" wire:model="type">
                    @foreach (\App\Models\AlurPencairan\AlurPencairan::TYPE_CHOICE as $type)
                        <option value="{{ $type }}" class="text-center">{{ $type }}</option>
                    @endforeach
                </select>

                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
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