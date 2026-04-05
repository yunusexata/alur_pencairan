@extends('app.layouts.panel')

@section('title', 'Alur Proses - Speed 20')

@section('header')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Alur Proses - Speed 20</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">Alur Proses - Speed 20</li>
            {{-- <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li> --}}
        </ul>
        <!--end::Breadcrumb-->
        
    </div>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <livewire:alur-pencairan.alur-proses-speed-20.detail>
        </div>
    </div>
@stop
