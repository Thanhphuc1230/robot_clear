@extends('admin.master')
@section('module', $nameItem)
@section('action', 'Thông tin đơn hàng')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('admin.partials.error')
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thông tin đơn hàng của {{ $user_order->fullname_order }}
                            </h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="" method="POST" enctype="multipart/form-data">

                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Họ và tên</label>
                                                <input type="text" name="fullname_order" class="form-control"
                                                    placeholder="Enter your title page"
                                                    value="{{ old('fullname_order', $user_order->fullname_order ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Số điện thoại
                                                </label>
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="Đường dẫn của quảng cáo"
                                                    value="{{ old('phone', $user_order->phone ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Email
                                                </label>
                                                <input type="text" name="email" class="form-control"
                                                    placeholder="Đường dẫn của quảng cáo"
                                                    value="{{ old('email', $user_order->email ?? '') }}">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">Địa chỉ
                                                    </label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Đường dẫn của quảng cáo"
                                                        value="{{ old('address', $user_order->address ?? '') }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label">Phương thức thanh
                                                            toán
                                                            :{{ $user_order->checkout_payment_method == 'cash' ? ' Tiền mặt' : ' Chuyển khoản' }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Thông tin sản phẩm</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort">ID</th>
                                                <th class="sort">Hình ảnh</th>
                                                <th class="sort">Tên sản phẩm</th>
                                                <th class="sort">Giá</th>
                                                <th class="sort">Số lượng</th>
                                                <th class="sort">Tổng đơn</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @if (count($list) > 0)
                                                @foreach ($list as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><img src="{{ asset('images/products/' . $item->avatar) }}"
                                                                width="50px"></td>
                                                        <td>{{ $item->name_vn }}</td>
                                                        @php
                                                            if ($item->price == 0) {
                                                                $totalPrice = 'Liên hệ';
                                                            } else {
                                                                $totalPrice =
                                                                    number_format($item->price * $item->quantity) .
                                                                    ' VND';
                                                            }
                                                        @endphp
                                                        <td>{{ $totalPrice }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $totalPrice }} </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center">Chưa có dữ liệu</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Tổng hóa đơn</td>
                                                <td>{{ $totalPrice }} </td>
                                                <td>
                                                    <form action="{{ route('admin.order.index') }}" method="GET">
                                                        <button type="submit" class="btn btn-primary">Quay lại danh
                                                            sách</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                        {{-- {!!$list->links()!!} --}}
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>

        </div>
    </div>

    <!-- container-fluid -->
@endsection
