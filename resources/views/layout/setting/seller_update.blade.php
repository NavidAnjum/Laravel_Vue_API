@extends('layout/dashboard')

@section('dashboard_main_content')

    <div class="row">
        <div class="offset-lg-1 col-lg-10 offset-lg-1">
            <div id="app">

                @if(!empty($seller))
                    @forelse($seller as $data)

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Seller Update</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ '/'.$org.'/update_seller/'.$data->id }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" required class="form-control" name="seller" id="seller" value="{{ $data->supplier}}">
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
