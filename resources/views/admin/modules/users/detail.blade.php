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
                                                <label for="firstNameinput" class="form-label">Họ và tên </label>
                                                <input type="text" name="fullname" class="form-control"
                                                    placeholder="vd: Nguyễn văn A"
                                                    value="{{ old('fullname', $page->fullname ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control"
                                                    placeholder="vd: tk1230"
                                                    value="{{ old('username', $page->username ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="vd: 123@gmail.com"
                                                    value="{{ old('email', $page->email ?? '') }}">
                                            </div>
                                        </div>
                                        @if($action == 'edit')
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Mật khẩu cũ</label>
                                                <input type="password" name="old_password" class="form-control"
                                                   >
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Mật khẩu</label>
                                                <input type="password" name="password" class="form-control"
                                                   >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Xác nhận mật khẩu</label>
                                                <input type="password" name="password_confirmation" class="form-control"
                                                   >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone-field" class="form-label">Quyền hạn</label>
                                                <select class="form-select mb-3" aria-label="Default select example"
                                                    name="level">
                                                    <option value="1"
                                                        {{ (old('level') ?: $page->level ?? '') == 1 ? 'selected' : '' }}>
                                                        Admin</option>
                                                        <option value="2"
                                                        {{ (old('level') ?: $page->level ?? '') == 2 ? 'selected' : '' }}>
                                                        Staff</option>
                                                        {{-- <option value="3"
                                                        {{ (old('level') ?: $page->level ?? '') == 3 ? 'selected' : '' }}>
                                                        User</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Avatar</label>
                                                <input type="file" id="fileInput" name="avatar" class="form-control">
                                                <div id="imageContainer"></div>
                                            </div>
                                        </div>

                                        @if(!empty($page->avatar))
                                        <div class="col-md-6" >
                                            <div class="mb-3" style="display:flex;flex-direction: column;">
                                                <label for="firstNameinput" class="form-label">Avatar hiện tại</label>
                                                <img src="{{asset('images/users/' .$page->avatar)}}" alt="" width="200px" height="auto">
                                            </div>
                                        </div>
                                        @endif
                                        <!--end col-->
                                        <div class="text-end mb-3">
                                            @if ($action == 'create')
                                                <input type="submit" name="return_back" class="btn btn-primary" value="Lưu và tạo mới">
                                                <input type="submit" name="return_list" class="btn btn-primary"
                                                    value="Lưu và về danh sách">
                                            @else
                                                <input type="submit" name="return_list" class="btn btn-primary" value="Cập nhật">
                                            @endif
                                        </div>
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
