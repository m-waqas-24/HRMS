@extends('admin.layouts.app')

@section('styles')
<style>
    .table td{
        width: 30% !important;
    }
</style>
@endsection

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">

        <div class="card mt-2">
            <div class="card-body">
                <h3>Candidate</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a  href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a  href="{{ route('admin.recruitments.index') }}">Candidate</a>
                        </li>
                        <li class="breadcrumb-item active">View Candidate</li>
                    </ol>
                </nav>
            </div>
        </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card" style="height: 320px">
                                        <div class="card-body">
                                            <h6 class="card-title">Basic Details</h6>
                                            <div class="table-responsive border-top">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <img src="{{ asset('assets/user.jpg') }}" width="50" height="50" alt="">
                                                                <span class="font-weight-bold ">{{ $candidate->name }} </span><br>
                                                                <small>{{ $candidate->phone }}</small>
                                                            </td>
                                                            <td class="py-2 px-0"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

    </div>
</div><!-- end app-content-->

@endsection