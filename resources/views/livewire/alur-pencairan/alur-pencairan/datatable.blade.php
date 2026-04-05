<div class="rounded-5 rounded-bottom-0" style="background-color: #acdce0;">
    <div class="row justify-content-between mb-3 rounded-5 rounded-bottom-0" style="background-color: #327a81;
    border-radius:20px;
    color: white;
    font-size: 1.2em;
    padding: 1rem;
    text-align: center;
    margin:5px;
    text-transform: uppercase;">
        <div class="col-auto mb-2 {{ !isset($show_filter) || $show_filter == true ? '' : 'd-none' }}">
            <label>Show</label>
            <select wire:model.change="length" class="form-select">
                @foreach ($lengthOptions as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4 mb-2 {{ !isset($keyword_filter) || $keyword_filter == true ? '' : 'd-none' }}">
            <label>Pencarian</label>
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control">
        </div>
    </div>

    <div class="position-relative">
        <div wire:loading>
            <div class="position-absolute w-100 h-100">
                <div class="w-100 h-100" style="background-color: grey; opacity:0.2"></div>
            </div>
            <h5 class="position-absolute shadow bg-white p-2 rounded"
                style="top: 50%;left: 50%;transform: translate(-50%, -50%);">Loading...</h5>
        </div>
        <div class="table-users">
            <div class="table-responsive rounded-5 rounded-top-0">
                <table class="table table-hover table-striped text-nowrap table-row-dashed table-row-gray-300 w-100 h-100">
                    <thead>
                        <tr>
                            @foreach ($columns as $index => $col)
                                <th wire:key='datatable_header_{{ $index }}'>
                                    @if (!isset($col['sortable']) || $col['sortable'])
                                        @php $isSortAscending = $col['key'] == $sortBy && $sortDirection == 'asc'@endphp
                                        <button type="button" class='btn p-0 m-0'
                                            wire:click="datatableSort('{{ $col['key'] }}')">
                                            <div class="fw-bold align-items-center d-flex">
                                                <div class='pe-2'>
                                                    {{ $col['name'] }}
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <i
                                                        class="ki-duotone ki-up fs-4 m-0 p-0
                                    {{ $isSortAscending ? 'text-dark' : 'text-secondary' }}"></i>
                                                    <i
                                                        class="ki-duotone ki-down fs-4 m-0 p-0
                                    {{ $isSortAscending ? 'text-secondary' : 'text-dark' }}"></i>
                                                </div>
                                            </div>
                                        </button>
                                    @else
                                        <div class="fs-6 p-2">
                                            {{ $col['name'] }}
                                        </div>
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                        @php
                        $bg_color = '#E4DFB5';
                            switch ($item['type']) {
                                case \App\Models\AlurPencairan\AlurPencairan::TYPE_SPEED_20:
                                    // $bg_color = '#D4EBF8';
                                    $bg_color = '#FAFFCB';
                                    break;
                                case \App\Models\AlurPencairan\AlurPencairan::TYPE_PROSES_80:
                                    // $bg_color = '#E4DFB5';
                                    $bg_color = '#FFCEE3';
                                    break;
                                    
                                default:
                                    $bg_color = '#DDF4E7';
                                    break;
                            }
                        @endphp
                            <tr wire:key='datatable_row_{{ $index }}' style="background-color: {{ $bg_color }};">
                                @foreach ($columns as $col)
                                    @php
                                        $cell_style = '';
                                        if (isset($col['style'])) {
                                            $cell_style = is_callable($col['style'])
                                                ? call_user_func($col['style'], $item, $index)
                                                : $col['style'];
                                            $cell_style = "style='{$cell_class}'";
                                        }

                                        $cell_class = '';
                                        if (isset($col['class'])) {
                                            $cell_class = is_callable($col['class'])
                                                ? call_user_func($col['class'], $item, $index)
                                                : $col['class'];
                                            $cell_class = "'{$cell_class}'";
                                        }
                                    @endphp

                                    @if (isset($col['render']) && is_callable($col['render']))
                                        <td class="px-2 {!! $cell_class !!}" style="{!! $cell_style !!}">
                                            {!! call_user_func($col['render'], $item) !!}
                                        </td>
                                    @elseif (isset($col['key']))
                                        <td class="px-2 {!! $cell_class !!}" style="{!! $cell_style !!}">
                                            {{ $item->{$col['key']} }}
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row justify-content-end mt-3 rounded-top-0" style="background-color: #327a81;
    border-radius:20px;
    color: white;
    font-size: 1.2em;
    padding: 1rem;
    text-align: center;
    margin:5px;
    text-transform: uppercase;">
        <div class="col">
            <em>Total Data: {{ $data->total() }}</em>
        </div>
        <div class="col-auto">
            {{ $data->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
