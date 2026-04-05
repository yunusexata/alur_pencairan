@extends('app.layouts.panel')

@section('title', 'Alur Pencairan')

@section('header')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">ALUR PENCAIRAN</h1>
        <!--end::Title-->

        @can(PermissionHelper::transform(PermissionHelper::ACCESS_ALUR_PENCAIRAN, PermissionHelper::TYPE_CREATE))
            <div class='row'>
                <div class="col-md-auto mt-2">
                    <a class="btn btn-success" href="{{ route('alur_pencairan.create') }}">
                        <i class="ki-duotone ki-plus fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        Tambah Baru
                    </a>
                </div>
            </div>
        @endCan
        
    </div>
@stop

@section('content')

    <div class="card rounded-5 rounded-top-0" style="  background-color: #acdce0;">
        <div class="card-body rounded-5 rounded-top-0">
            <livewire:alur-pencairan.alur-pencairan.datatable lazy>
            <livewire:alur-pencairan.alur-pencairan.edit>
        </div>
    </div>
@stop
