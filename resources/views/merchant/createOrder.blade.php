@extends('merchant.layouts._main')

@section('title', 'Merchant Dashboard')

@section('styles')
    <link href="/admintheme/css/select2.min.css" rel="stylesheet">


@endsection
@section('content')
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create a Order!</h1>
                    </div>
                    <form name="cart" class="user" action="{{route('storeorder')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">

                            <div class="col-sm-6">
                                <input type="text" class="form-control "
                                       placeholder="Sender Name" name="sender_name" value="{{ $sender->name }}" required autofocus>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control "
                                       placeholder="Customer Name" name="customer_name" value="{{ old('customer_name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-sm-6">
                                <input type="text" class="form-control "
                                       placeholder="Sender Email" name="sender_email" value="{{$sender->email}}" required autofocus>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control "
                                       placeholder="Customer Email" name="customer_email" value="{{ old('customer_email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-sm-6">
                                <input type="text" class="form-control "
                                       placeholder="Sender Phone Number" name="sender_phone" value="{{ $sender->phone }}" required autofocus>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control "
                                       placeholder="Customer Phone Number" name="customer_phone" value="{{ old('customer_phone') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-sm-6">
                                <input type="text" class="form-control "
                                       placeholder="Sender Address" name="sender_address" value="{{ $sender->address }}" required autofocus>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control "
                                       placeholder="Customer Address" name="customer_address" value="{{ old('customer_address') }}" required autofocus>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                Products
                            </div>

                            <div class="card-body">
                                <table class="table" id="products_table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $select2=5;?>
                                    @foreach (old('products', ['']) as $index => $oldProduct)
                                        <tr id="product{{ $index }}">
                                            <td>
                                                <select class="form-control productname{{$select2}}" name="productname[]" id="productname{{$index}}" onclick="select2()">
                                                    @foreach($products as $product)
                                                        <option>{{$product->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="quantities[]" class="form-control" value="{{ old('quantities.' . $index) ?? '1' }}" />
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr id="product{{ count(old('products', [''])) }}"></tr>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                        <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Create
                        </button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/admintheme/dist/jautocalc.js"></script>
    <script src="/admintheme/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            let row_number = {{ count(old('products', [''])) }};
            var SELECT2 = '{{$select2}}';

            $("#add_row").click(function(e){
                //e.preventDefault();
                let new_row_number = row_number - 1;
                $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
                var html = "";
                html += '<tr id="product' + (row_number + 1) + '">';
                html += '<td>';
                html += '<select class="form-control productname' + (row_number + 1) + '" name="productname[]" onclick="select2()"></select>';
                html += '</td>';
                html += '</tr>';
                $('#products_table').append(html);
                row_number++;
                SELECT2++;
                <?php $select2++?>
            });
            select2()
            {
                $(".productname" + SELECT2).select2({
                    tags: true
                });
            }



            $("#delete_row").click(function(e){
                e.preventDefault();
                if(row_number > 1){
                    $("#product" + (row_number - 1)).html('');
                    row_number--;
                    SELECT2--;
                }
            });
        });
    </script>

    <script type="text/javascript">
        var RowNum = '';
        function total() {
            /*var quantity = document.getElementById("quantity").value;*/
            var quantity = $("#quantity" + RowNum).val();
            var unitprice = $("#unitprice" + RowNum).val();
            var total = (parseInt(quantity) * parseInt(unitprice));
            console.log(quantity,unitprice);
            console.log(total);
            $('#total' + RowNum).val(total);
        }
        function totalsub(){
            var total = 0;
            $('.total').each(function (index, element) {
                total = total + parseFloat($(element).val());
            });
            $('#subtotal').val(total);
        }
        function select2() {
            $("#productname" + RowNum).select2({
                tags: true
            });
            console.log('true');
        }
    </script>

    <script type="text/javascript">
    </script>

@endsection
