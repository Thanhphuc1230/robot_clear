@extends('admin.master')
@section('module', $nameItem)
@section('action', 'Danh sách')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Quản lý {{ $nameItem }}</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a type="button" href="{{ route('admin.' . $nameClass . '.create') }}"
                                                class="btn btn-success add-btn"><i
                                                    class="ri-add-line align-bottom me-1"></i> Thêm </a>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <form action="{{ route('admin.' . $nameClass . '.index') }}" method="get">
                                                    @csrf
                                                    <input type="text" class="form-control search" name="search"
                                                        placeholder="Search...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort">ID</th>
                                                <th class="sort">Hình ảnh</th>
                                                <th class="sort">Tiêu đề</th>
                                                <th class="sort">Chủ đề</th>
                                                <th class="sort">Status</th>
                                                <th class="sort">Home</th>
                                                <th class="sort">STT</th>
                                                <th class="sort">Created_at</th>
                                                <th class="sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @if (count($list) > 0)
                                                @foreach ($list as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        @php
                                                            $avatar = !empty($item->avatar)
                                                                ? $item->avatar
                                                                : 'default_user.png';
                                                        @endphp
                                                        <td><img src="{{ asset('images/category_product/' . $avatar) }}"
                                                                width="50px"></td>
                                                        <td>{{ $item->name_vn }}</td>
                                                        <td>@php $parent_name = getParentCategory($item->parent_id ,'CateProduct') @endphp {{ $parent_name }}</td>
                                                        <td class="status">
                                                            @if ($item->status == 1)
                                                                <a href="{{ route('admin.' . $nameClass . '.status', ['uuid' => $item->uuid, 'status' => 0, 'name' => 'status']) }}"
                                                                    onclick="return confirm('Xác nhận tắt kích hoạt {{ $nameItem }} ?')">
                                                                    <span
                                                                        class="badge bg-success-subtle text-success text-uppercase">Active</span>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('admin.' . $nameClass . '.status', ['uuid' => $item->uuid, 'status' => 1, 'name' => 'status']) }}"
                                                                    onclick="return confirm('Xác nhận kích hoạt {{ $nameItem }} ?')">
                                                                    <span
                                                                        class="badge bg-danger-subtle text-danger text-uppercase">Block</span>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="status">
                                                            @if ($item->home == 1)
                                                                <a href="{{ route('admin.' . $nameClass . '.status', ['uuid' => $item->uuid, 'status' => 0, 'name' => 'home']) }}"
                                                                    onclick="return confirm('Xác nhận tắt kích hoạt {{ $nameItem }} ra trang chủ?')">
                                                                    <span
                                                                        class="badge bg-success-subtle text-success text-uppercase">Active</span>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('admin.' . $nameClass . '.status', ['uuid' => $item->uuid, 'status' => 1, 'name' => 'home']) }}"
                                                                    onclick="return confirm('Xác nhận kích hoạt {{ $nameItem }} ra trang chủ ?')">
                                                                    <span
                                                                        class="badge bg-danger-subtle text-danger text-uppercase">Block</span>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->stt }}</td>
                                                        <td class="date">
                                                            {{ $item->updated_at ? $item->updated_at->format('d-m-Y') : $item->created_at->format('d-m-Y') }}
                                                        </td>

                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <a href="{{ route('admin.' . $nameClass . '.edit', ['uuid' => $item->uuid, 'page' => $list->currentPage()]) }}"
                                                                        class="btn btn-sm btn-success edit-item-btn">Edit</a>
                                                                </div>
                                                                <div class="remove">
                                                                    <a href="{{ route('admin.' . $nameClass . '.destroy', ['uuid' => $item->uuid]) }}"
                                                                        class="btn btn-sm btn-danger remove-item-btn"
                                                                        onclick="return confirm('Xác nhận xóa {{ $nameItem }} ?')">Remove</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" style="text-align:center">Chưa có dữ liệu</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                        {!! $list->appends(request()->except('page'))->links() !!}
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
        <!-- container-fluid -->
    </div>

@endsection
