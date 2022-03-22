@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">PR Creation</h1>
    <div id="app">
        <
    </div>

    <div class="row">

        <div class="offset-lg-3 col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">PO Creation Details</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about PO.</p>
                    <!-- Circle Buttons (Default) -->
                    <form action="{{'po_creation'}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Date</label>
                            <input type="date" required class="form-control" name="date" id="date" placeholder="">

                        </div>
                        <div class="mb-3">
                            <label for="item_category" class="form-label">PR Number</label>
                            <input type="text" required class="form-control" name="pr_number" id="pr_number" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Serial Number</label>
                            <input type="text" required  class="form-control" name="serial_number" id="serial_number" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="per_unit_price" class="form-label">Type of Rw Martial</label>
                            <input type="text" required class="form-control" name="type_of_raw_matrial" id="type_of_raw_matrial" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" required class="form-control" name="quantity" id="quantity" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Quality</label>
                            <input type="text" required class="form-control" name="quality" id="quality" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="supplier_id" class="form-label">Remarks</label>
                            <textarea type="text"  class="form-control" name="remarks" id="remarks" placeholder="">
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>



    </div>


    <!-- /.container-fluid is on dashboard not here -->


    {{--@endsection--}}

    {{--@section('script')--}}
    {{--<script >--}}
    {{--    $('.livesearch').select2({--}}
    {{--        placeholder: 'Select item',--}}
    {{--        ajax: {--}}
    {{--            url: '/item_search',--}}
    {{--            dataType: 'json',--}}
    {{--            delay: 250,--}}
    {{--            processResults: function (data) {--}}
    {{--                return {--}}
    {{--                    results: $.map(data, function (item) {--}}
    {{--                        return {--}}
    {{--                            text: item.item_name,--}}
    {{--                            id: item.item_id--}}
    {{--                        };--}}
    {{--                    })--}}
    {{--                };--}}
    {{--            },--}}
    {{--            cache: true--}}
    {{--        }--}}
    {{--    });--}}

    {{--</script>--}}

@endsection
