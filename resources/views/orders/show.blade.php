@extends('front.layout.master')
@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container">
    <style>

        .order-details {
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .order-details h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }
        .order-details p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }
        .order-total {
            font-size: 18px;
            font-weight: bold;
            color: #d9534f;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            border: 1px solid #dee2e6;
        }
        .table td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: center;
        }
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;


        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #e9ecef;
        }
    </style>

    <div class="order-details">
        <h1>Chi tiết đơn hàng #{{ $order->id }}</h1>
        <p>Ngày đặt hàng: <span>{{ $order->created_at->format('d/m/Y H:i') }}</span></p>
        <p class="order-total">Tổng tiền: {{ number_format($order->orderItems->sum(fn($item) => $item->product_price * $item->quantity), 0, ',', '.') }}đ</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
            <tr>
                <td><img src="{{ asset($item->product_image) }}" alt="{{ $item->product_name }}" class="product-image"></td>
                <td>{{ $item->product_name }}</td>
                <td>{{ number_format($item->product_price, 0, ',', '.') }}đ</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->product_price * $item->quantity, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
