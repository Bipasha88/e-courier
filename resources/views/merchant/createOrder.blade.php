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
                            <?php $row_num=0;?>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Weight</th>
                                            <th>Product Price</th>
                                            <th>Courier Charge</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="row_container">

                                        <tr id="div_{{$row_num}}">
                                            <td>
                                                <select class="form-control" name="productname[]" id="productname0" onclick="select2()">
                                                    @foreach($products as $product)
                                                    <option>{{$product->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="productweight[]" class="form-control" placeholder="">
                                            </td>
                                            <td>
                                                <input type="text" name="productprice[]" class="form-control" placeholder="" id="quantity0">
                                            </td>
                                            <td>
                                                <input type="text" name="couriercharge[]" class="form-control" placeholder="" id="unitprice0">
                                            </td>
                                            <td>
                                                <input type="text" name="total[]" class="form-control total" placeholder="Total" id="total0" onclick="total()" style="cursor: pointer;" readonly>
                                            </td>
                                            <td>
                                                <a href="javascript:0" class="btn btn-danger"><i class="fa fa-minus" onclick="$('#div_{{$row_num}}').remove();"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a href="javascript:0" class="btn btn-success" onclick="addrow();"><i class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <strong>Sub Total:</strong>
                                            </td>
                                            <td>
                                                <input type="text" onclick="totalsub();" name="subtotal" class="form-control" id="subtotal" value="0.00" readonly>
                                            </td>
                                            <td></td>
                                        </tr>


                                        </tbody>
                                    </table>
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

    <script type="text/javascript">
        var RowNum = '{{$row_num}}';

        function total() {
            /*var quantity = document.getElementById("quantity").value;*/
            var quantity = $("#quantity" + RowNum).val();

            var unitprice = $("#unitprice" + RowNum).val();
            var total = (parseInt(quantity) + parseInt(unitprice));
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
        function addrow(){
            RowNum++;
            var html = "";
            html += '<tr id="div_'+RowNum+'">';
            html +='<td>';
            html +='<select class="form-control" name="productname[]" onclick="select2()" id="productname'+RowNum+'" > @foreach($products as $product)<option>{{$product->name}}</option> @endforeach </select>';
            html +='</td>';
            html +='<td>';
            html +='<input type="text" name="productweight[]" class="form-control" placeholder="">';
            html +='</td>';
            html +='<td>';
            html +='<input type="text" id="quantity'+RowNum+'" name="productprice[]" class="form-control" placeholder="">';
            html +='</td>';
            html +='<td>';
            html +='<input type="text" id="unitprice'+RowNum+'" name="couriercharge[]" class="form-control" placeholder="">';
            html +='</td>';
            html +='<td>';
            html +='<input type="text" name="total[]" class="form-control total" onclick="total()" placeholder="Total" id="total'+RowNum+'" style="cursor: pointer;" readonly>';
            html +='</td>';
            html +='<td>';
            html +='<a href="javascript:0" id="medicine_name'+RowNum+'" class="btn btn-danger"><i class="fa fa-minus"  onclick="$(\'#div_'+RowNum+'\').remove();"></i></a>';
            html +='</td>';
            html +='</tr>';

            $('.row_container').append(html);
        }



    </script>

    <script type="text/javascript">

    </script>

@endsection
