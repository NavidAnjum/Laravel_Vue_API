@extends('layout/dashboard')

@section('dashboard_main_content')
    <!-- /.start of container-fluid is on dashboard not here -->

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Move Order</h1>

    <div class="row">

        <div class="offset-lg-3 col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Move Order Date</h6>
                </div>
                <div class="card-body">
                    <p >Please add all information about Move Order</p>
                    <!-- Circle Buttons (Default) -->
                    <form action="{{'move_order}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Move Order Date</label>
                            <input type="date" required class="form-control" name="date" id="date" placeholder="">

                        </div>
                        <div class="mb-3">
                            <label for="po" class="form-label">PO Number</label>
                            <select required class="browser-default custom-select form-control ">
                                <option selected>Select PO Number</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="po" class="form-label">TC Number</label>
                            <input type="text" class="form-control" name="tc_number" id="tc_number" placeholder="">

                        </div>
                        <div class="mb-3">
                            <label for="po" class="form-label">Invoice Number</label>
                            <input type="text" class="form-control" name="invoice_number" id="invoice_number" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="po" class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="">
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
