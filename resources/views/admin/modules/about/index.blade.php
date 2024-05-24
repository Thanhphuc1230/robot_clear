@extends('admin.master')
@section('module', 'About')
@section('action', 'Infomation')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('admin.partials.error')
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Giới thiệu website</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('admin.about.update', ['id' => $about->id_about]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        {{-- info website --}}
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Tiêu đề</label>
                                                <input type="text" name="name_vn" class="form-control"
                                                    placeholder="Enter your title page"
                                                    value="{{ old('name_vn', $about->name_vn) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Logo</label>
                                                <input type="file" name="avatar" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Avatar</label>
                                                <img src="{{ asset('images/about/' . $about->avatar) }}" alt="avatar"
                                                    width="150px">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-publish-status-input" class="form-label">Trang
                                                    thái</label>

                                                <select class="form-select" name="status">
                                                    <option value="1"
                                                        {{ (old('status') ?: $about->status ?? '') == 1 ? 'selected' : '' }}>
                                                        Bật
                                                    </option>
                                                    <option value="0"
                                                        {{ (old('status') ?: $about->status ?? '') == 0 ? 'selected' : '' }}>
                                                        Ẩn</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Nội dung</label>
                                                <textarea class="form-control" name="content" id="my-editor" rows="6" placeholder="Enter your message">{{ old('content', $about->content) }}</textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
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
