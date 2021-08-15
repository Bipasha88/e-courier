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
                                <div id="ptr_clone" >
                                <table name="cart" class="table" id="products_table">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Weight/Type</th>
                                        <th>Price</th>
                                        <th>Courier Charge</th>
                                        <th>Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach (old('products', ['']) as $index => $oldProduct)
                                        <tr id="product{{ $index }}" name="line_items">
                                            <td>
                                                <input type="text" name="products[]" class="form-control products" value="{{ old('products.' . $index)  }}" />
                                            </td>
                                            <td>
                                                <input type="text" name="weights[]" class="form-control" value="{{ old('weights.' . $index)  }}" />
                                            </td>
                                            <td>
                                                <input type="text" id="" name="productprices[]"

                                                       class="form-control number" value="{{ old('productprices.' . $index)  }}" />
                                            </td>
                                            <td>
                                                <input type="text" name="charges[]" class="form-control" value="{{ old('charges.' . $index)  }}" />
                                            </td>
                                            <td>
                                                <input type="text" id="" name="prices[]"

                                                       class="form-control number" value="{{ old('prices.' . $index)  }}" />
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr id="product{{ count(old('products', [''])) }}"></tr>

                                    </tbody>
                                    <tfoot>
                                    <th colspan="4" class="text-right">Sub Total</th>
                                    <th class="text-right" id="tAmount">0.00</th>
                                    <th></th>
                                    </tfoot>
                                </table>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="add_row" class="btn btn-success pull-left">+ Add Row</button>
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
   <script>
       $(document).ready(function(){
           let row_number = {{ count(old('products', [''])) }};
           $("#add_row").on('click',function(e){
               e.preventDefault();
               let new_row_number = row_number - 1;
               $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');

               $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
               row_number++;
           });
           $("#delete_row").on('click',function(e){
               e.preventDefault();
               if(row_number > 1){
                   $("#product" + (row_number - 1)).html('');
                   row_number--;
               }
           });

           $('[name="prices[]"]').keyup(function() {
               calc()
           });

           $('#add_row').click(function(){
               var tr = $('#ptr_clone tr').clone()


               $('[name="prices[]"]').keyup(function(){
                   calc()
               })
               $('.number').on('input keyup keypress',function(){
                   var val = $(this).val()
                   val = val.replace(/[^0-9]/, '');
                   val = val.replace(/,/g, '');
                   val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
                   $(this).val(val)
               })});
                   function calc(){

                       var total = 0 ;
                       $('#products_table [name="prices[]"]').each(function(){
                           var p = $(this).val();
                           p =  p.replace(/,/g,'')
                           p = p > 0 ? p : 0;
                           total = parseFloat(p) + parseFloat(total)
                       })
                       if($('#tAmount').length > 0)
                           $('#tAmount').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
                   }

           });


   </script>

@endsection
