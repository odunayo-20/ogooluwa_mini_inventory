@extends('layouts.master')

@section('title', 'Report | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Report Table</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Report</li>
                <li class="breadcrumb-item active"><a href="{{ route('report.daily') }}">Daily Report</a></li>
                <li class="breadcrumb-item"><a href="{{ route('report.weekly') }}">Weekly Report</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('report.monthly') }}">Monthly Report</a></li>

            </ul>
        </div>
        <div class="d-flex justify-content-between">
            <a class="btn btn-primary" href="{{ route('sales.index') }}"><i class="fa fa-plus"></i> View Sales</a>
            {{-- <a class="btn btn-danger" href="{{ route('report.download', 'pdf') }}">Download PDF</a> --}}


        </div>

        <h2>Academic Sales Report</h2>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">

                        <form action="{{ route('report.downloadAcademicYear', 'pdf')}}" method="post">
                            @csrf
                        <div class="form-group col-md-3">
                            <label>Academic Session</label>
                            <select name="academic_session_year" class="form-control">
                                <option value="">--Select Session--</option>
                                @foreach ($availableSessions as $session)
                                    <option value="{{ $session }}">{{ $session }}</option>
                                @endforeach
                            </select>
                            @error('academic_session_year') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                        <button type="submit" class="btn btn-danger">Download PDF</button>
                    </form>


                    </div>
                </div>
            </div>
        </div>
        <h2>Academic Session and Terms Sales Report</h2>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">

                        <form action="{{ route('report.downloadAcademicYearTerm', 'pdf')}}" method="post">
                            @csrf
                            <div class="row">

                        <div class="form-group col-md-3">
                            <label>Academic Session</label>
                            <select name="academic_session" class="form-control">
                                <option value="">Select Session</option>
                                @foreach ($availableSessions as $session)
                                    <option value="{{ $session }}">{{ $session }}</option>
                                @endforeach
                            </select>
                            @error('academic_session') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Terms</label>
                            <select name="term" name="" id="" class="form-control">
                                <option value="">--Select Terms--</option>
                                <option value="Frist Term">First Term</option>
                                <option value="Second Term">Second Term</option>
                                <option value="Third Term">Third Term</option>
                            </select>
                            @error('term') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                    </div>

                        <button type="submit" class="btn btn-danger">Download PDF</button>
                    </form>


                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
@endpush
