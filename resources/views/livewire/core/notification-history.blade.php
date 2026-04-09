<div>

    {{-- HEADER --}}
    <div class="d-flex flex-column bgi-no-repeat rounded-top px-9 pt-8 pb-6"
        style="background-image:url('{{ asset('assets/media/misc/menu-header-bg.jpg') }}')">

        <h3 class="text-white fw-semibold m-0">
            Riwayat Pencairan
        </h3>
    </div>


    {{-- SCROLL AREA --}}
    <div
        class="scroll-y mh-300px my-5 px-8"
        x-data
        x-init="$wire.loadNotifications()"
        x-on:scroll.debounce.200ms="
            if ($el.scrollTop + $el.clientHeight >= $el.scrollHeight - 20) {
                $wire.dispatch('load-more')
            }
        "
    >

        {{-- EMPTY STATE --}}
        @if($this->notifications->isEmpty())
            <div class="text-center py-10 text-gray-400">
                Tidak ada notifikasi
            </div>
        @endif
        
        {{-- NOTIFICATION LIST --}}
        @foreach ($this->notifications as $notif)
        {{-- {{dd($notif['status'])}} --}}

            <div class="d-flex flex-stack py-4 border-bottom">

                {{-- LEFT --}}
                <div class="d-flex align-items-center">

                    {{-- CONTENT --}}
                    <div class="mb-0 me-2">

                        <div
                           class="fs-6 text-{{$notif['status']}} text-hover-primary fw-bolder">
                            {{ $notif->title }}
                        </div>

                        <div class="text-gray-400 fs-7">
                            {{ $notif->note }}
                        </div>

                    </div>

                </div>

                {{-- TIME --}}
                <span class="badge badge-light fs-8 d-flex flex-col row">
                    <span>
                        {{ $notif->created_at->diffForHumans() }}
                    </span>
                    <span class="mt-2 text-success">
                        {{ $notif->creator->name }}
                    </span>
                </span>
            </div>

        @endforeach


        {{-- LOADING --}}
        <div wire:loading.flex class="justify-content-center py-4">
            <span class="spinner-border spinner-border-sm"></span>
        </div>

    </div>

</div>