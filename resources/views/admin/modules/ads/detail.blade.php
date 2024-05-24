@extends('admin.master')
@section('module', $nameItem)
@section('action', 'Add')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('admin.partials.error')
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ $action == 'create' ? 'Thêm' : 'Chỉnh sửa' }}
                                {{ $nameItem }}</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('admin.'.$nameClass.($action == 'create' ? '.store' : '.update'), ['uuid' => $page->uuid ?? '']) }}" method="POST" enctype="multipart/form-data">

                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Tiêu đề
                                                    {{ $nameItem }} Tiếng việt</label>
                                                <input type="text" name="name_vn" class="form-control"
                                                    placeholder="Enter your title page"
                                                    value="{{ old('name_vn', $page->name_vn ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Đường dẫn
                                                    </label>
                                                <input type="text" name="link" class="form-control"
                                                    placeholder="Đường dẫn của quảng cáo"
                                                    value="{{ old('link', $page->link ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="compnayNameinput" class="form-label">Số thứ tự(Hiển thị từ trái sang phải)</label>
                                                <input type="number" name="stt" class="form-control"
                                                placeholder="Enter your title page"
                                                value="{{ old('stt', $page->stt ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Avatar</label>
                                                <input type="file" name="avatar" class="form-control"
                                                  >
                                            </div>
                                        </div>

                                        @if(!empty($page->avatar))
                                        <div class="col-md-6" >
                                            <div class="mb-3" style="display:flex;flex-direction: column;">
                                                <label for="firstNameinput" class="form-label">Avatar hiện tại</label>
                                                <img src="{{asset('images/ads/' .$page->avatar)}}" alt="" width="200px" height="auto">
                                            </div>
                                        </div>
                                        @endif
                                        <!--end col-->
                                        @if($action == 'create')
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <input type="submit" name="return_back" class="btn btn-primary" value="Lưu và tạo mới">
                                                <input type="submit" name="return_list" class="btn btn-primary" value="Lưu và về danh sách">
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <input type="submit" name="return_list" class="btn btn-primary" value="Cập nhật">
                                            </div>
                                        </div>
                                        @endif
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
