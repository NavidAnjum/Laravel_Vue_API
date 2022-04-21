@extends('layout/dashboard')

@section('dashboard_main_content')

    <div class="row">
        <div class="offset-lg-1 col-lg-10 offset-lg-1">
            <form method="get">
                    <div class="mb-3">

                        <label for="" class="form-label">PO Number</label>
                        <select class="form-control" name="po_number" id="po_number">
                            @foreach($ponumbers as $ponumber)
                            <option value="{{$ponumber}}">{{$ponumber}}</option>
                             @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" onclick="generate_barcode()">Generate Barcode</button>
                    </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid is on dashboard not here -->


@endsection

@section('dashboard_script')
    <script>

   function generate_barcode(){
        let po_number=document.getElementById("po_number").value;
       window.open("pdf/"+po_number, '_blank').focus();

    }

    </script>
@endsection


