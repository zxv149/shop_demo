@extends('frontend.layouts.master')
@section('title', 'Product List')
@section('content')
    <div class="container">
        <section class="page-section my-5 p-5">
            <div class="row">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th scope="col">圖片</th>
                        <th scope="col">商品名稱</th>
                        <th scope="col">價格</th>
                        <th scope="col">數量</th>
                        <th scope="col">小計</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($cart as $product)
                        <tr>
                            <td class="align-middle"><img src="{{ asset('uploads/product/'. $product['image']) }}" width="100px"></td>
                            <td class="align-middle">{{ $product['title'] }}</td>
                            <td class="align-middle" id="price_{{ $product['id'] }}">{{ $product['price'] }}</td>
                            <td class="align-middle">
                                <input type="number" min="1" class="amount form-control"
                                       id="amount_{{ $product['id'] }}"
                                       data-id="{{ $product['id'] }}"
                                       value="{{ $product['qty'] }}"
                                       onfocus="this.select()">
                                </td>
                            <td class="align-middle" id="count_{{ $product['id'] }}">{{ $product['price']*$product['qty'] }}</td>
                            <td class="align-middle">
                                <form method="POST" action="{{ route('cart.delete', $product['id']) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-secondary">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No Product</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>

            @if (count($cart) >= 1)
                <div class="">
                    <div class="form-control">
                        <label for="payment">付款方式：</label>
                        <select class="form-control" name="payment" id="payment">
                            <option value="cash">貨到付款</option>
                            <option value="card">線上刷卡</option>
                        </select>
                    </div>
                    <br>
                    <a href="{{ route('cart.check') }}" class="btn btn-primary pull-right">結帳</a>
                </div>

            @else

            @endif

        </section>
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('.amount').bind('change blur', function (event) {
            if (event.keyCode != 8) {
                var id = $(this).attr('data-id');
                var amount = isNaN($(this).val()) ? '1' : $(this).val();
                var stock = fn_get_stock(id,amount);
                if (parseInt(stock) >= parseInt(amount) && parseInt(amount) > 0) {
                    $(this).val(amount);
                }
                else {
                    if (parseInt(amount) < 1 && parseInt(stock) > 0) {
                        $(this).val('1');
                    } else {
                        $(this).val(stock);
                    }
                }

                var qty =  $(this).val();

                $('#count_' + id).text(parseInt(qty)*parseInt($('#price_' + id).text()));
            }
        });

        $('#payment').bind('change', function (event) {
            var payment = $(this).val();
            console.log(payment + '1');
            $.ajax({
                url: '{{ route('cart.payment') }}',
                type: 'POST',
                data: {payment:payment},
                dataType: 'text',
                async: false,
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                },

                success: function (msg) {
                    console.log(msg);
                },

                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });

        function fn_get_stock(id,amount) {
            var _quantity = isNaN(amount) ? '1' : amount;
            var _data = {
                "id":id,
                "qty":_quantity
            };
            if ('' != id && !isNaN(id) && parseInt(id) > 0) {
                $.ajax({
                    url: '{{ route('cart.update') }}',
                    type: 'post',
                    data:_data,
                    dataType: 'json',
                    async: false,
                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                    },

                    success: function (msg) {
                        console.log(msg);
                        amount = parseInt(msg);
                    },

                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            }
            return amount;
        }
    });
</script>

@endpush