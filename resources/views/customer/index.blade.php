

@extends('layouts.master')

@section('title', 'Student | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Manage Student</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active"><a href="#">Manage Student</a></li>
            </ul>
        </div>
        <div class="">
            <a class="btn btn-primary" href="{{route('customer.create')}}"><i class="fa fa-plus"></i> Add New Student</a>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body"  style="overflow: auto">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Student </th>
                                <th>Email</th>
                                <th>Mobile </th>
                                <th>Address </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $customers as $customer)
                            <tr>
                                <td>{{ $customer->name }} </td>
                                <td>{{ $customer->email }} </td>
                                <td>{{ $customer->mobile }} </td>
                                <td>{{ $customer->address }} </td>
                                 <td>
                                    <a class="btn btn-primary btn-sm" href="{{route('customer.edit', $customer->id)}}"><i class="fa fa-edit" ></i></a>
                                    <form class="d-inline" action="{{ route('customer.destroy',$customer->id) }}" method="POST" onsubmit="return ConfirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm waves-effect" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    <script>
                                    function ConfirmDelete(){
                                    return confirm("Are You want to delete this?");
                                    }
                                    </script>


                                    {{-- <button class="btn btn-danger btn-sm waves-effect" type="submit" onclick="deleteTag({{ $customer->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $customer->id }}" action="{{ route('customer.destroy',$customer->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>



@endsection

@push('js')
    <script type="text/javascript" src="{{asset('/')}}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteTag(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
