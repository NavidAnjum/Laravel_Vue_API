@extends('layout/dashboard')

@section('dashboard_main_content')

    <div class="row">
        <div class="offset-lg-1 col-lg-10 offset-lg-1">
            <div id="app">
                <p>
                    @if(!empty($message))
                        {{$message}}
                    @endif

                    @if(empty($dbname))
                            <?php $dbname = 'ZSML'; ?>
                        @endif
                </p>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Supplier Seller Name</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($seller_list))
                        <?php $counter = 1; ?>
                        @forelse($seller_list as $data)

                            <tr>
                                <th scope="row">{{ $counter }}</th>
                                <td>{{ $data->supplier}}</td>
                                <td>
                                    @if ($dbname == 'ysml')
                                        <button class="btn btn-sm"><a href="{{ url($dbname.'/api/seller_update/'.$data->id) }}"> Update </a></button>
                                    @elseif ($dbname == 'zsuml')
                                        <button class="btn btn-sm"><a href="{{ url($dbname.'/api/seller_update/'.$data->id) }}"> Update </a></button>
                                    @else
                                        <button class="btn btn-sm"><a href="{{ url($dbname.'/seller_update/'.$data->id) }}"> Update </a></button>
                                    @endif

                                </td>
                            </tr>
                            <?php $counter++; ?>
                        @empty
                            <li>No data found</li>
                        @endforelse

                    @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <!-- /.container-fluid is on dashboard not here -->


@endsection
