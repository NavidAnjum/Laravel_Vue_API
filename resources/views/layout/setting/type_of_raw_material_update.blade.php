@extends('layout/dashboard')

@section('dashboard_main_content')

    <div class="row">
        <div class="offset-lg-1 col-lg-10 offset-lg-1">
            <div id="app">

                @if(!empty($type_of_raw_material_update))
                    @forelse($type_of_raw_material_update as $data)

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Type of Raw Material Update</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ '/'.$org.'/update_type_of_raw_material/'.$data->id }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" required class="form-control" name="name_type_of_raw_material" id="name_type_of_raw_material" value="{{ $data->type_of_raw_material}}">
                                        <input type="hidden" name="org" value="{{ $org }}" >

                                        <div class="mt-2 mb-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <li>No data found</li>
                    @endforelse

                @endif
            </div>
        </div>
    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection
