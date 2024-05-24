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
                                <form
                                    action="{{ route('admin.' . $nameClass . ($action == 'create' ? '.store' : '.update'), ['uuid' => $page->uuid ?? '']) }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="product-title-input">Tiêu đề
                                                    {{ $nameItem }} Tiếng việt</label>
                                                <input type="text" id="name_vn" class="form-control" name="name_vn"
                                                    value="{{ old('name_vn', $page->name_vn ?? '') }}">
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Tiêu đề
                                                    {{ $nameItem }} English</label>
                                                <input type="text" name="name_en" class="form-control"
                                                    placeholder="Enter your title page"
                                                    value="{{ old('name_en', $page->name_en ?? '') }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Slug</label>
                                                <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}" placeholder="Slug" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Giới thiệu(Tiếng việt)</label>
                                                <textarea class="form-control" name="intro_vn" rows="6" placeholder="Enter your message">{{ old('intro_vn', $page->intro_vn ?? '') }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Giới thiệu(English)</label>
                                                <textarea class="form-control" name="intro_en" rows="6" placeholder="Enter your message">{{ old('intro_en', $page->intro_en ?? '') }}</textarea>
                                            </div>
                                        </div> --}}
                                        <!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastNameinput" class="form-label">Meta keywords</label>
                                                <textarea class="form-control" name="meta_keywords" rows="3" placeholder="Enter your message">{{ old('meta_keywords', $page->meta_keywords ?? '') }}</textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="compnayNameinput" class="form-label">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter your message">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone-field" class="form-label">Trang này thuộc</label>
                                                <select class="form-select mb-3" aria-label="Default select example"
                                                    name="category_id">
                                                        @foreach ($category as $item)
                                                        <option value="{{ $item->id_category_new }}"
                                                            {{ (old('parent_id') ?: $page->parent_id ?? '') == $item->id_category_new ? 'selected' : '' }}>
                                                            {{ $item->name_vn }}
                                                        </option>
                                                        @if ($item->children)
                                                            @foreach ($item->children as $child)
                                                                <option value="{{ $child->id_category_new }}"
                                                                    {{ (old('parent_id') ?: $page->parent_id ?? '') == $child->id_category_new ? 'selected' : '' }}>
                                                                    |---{{ $child->name_vn }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="compnayNameinput" class="form-label">Số thứ tự</label>
                                                <input type="number" name="stt" class="form-control"
                                                    placeholder="Enter your title page"
                                                    value="{{ old('stt', $page->stt ?? '') }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Nội dung (Tiếng
                                                    việt)</label>
                                                <textarea id="my-editor" class="form-control" name="content_vn" rows="6" placeholder="Enter your message">{{ old('content_vn', $page->content_vn ?? '') }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Nội dung (English)</label>
                                                <textarea id="my-editor-en" class="form-control" name="content_en" rows="6" placeholder="Enter your message">{{ old('content_en', $page->content_en ?? '') }}</textarea>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Avatar</label>
                                                <input type="file" id="fileInput" name="avatar" class="form-control">
                                                <div id="imageContainer"></div>
                                            </div>
                                        </div>

                                        @if (!empty($page->avatar))
                                            <div class="col-md-6">
                                                <div class="mb-3" style="display:flex;flex-direction: column;">
                                                    <label for="firstNameinput" class="form-label">Avatar hiện tại</label>
                                                    <img src="{{ asset('images/news/' . $page->avatar) }}" alt=""
                                                        width="200px" height="auto">
                                                </div>
                                            </div>
                                        @endif
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="text-end mb-3">
                                                @if ($action == 'create')
                                                    <input type="submit" name="return_back" class="btn btn-primary" value="Lưu và tạo mới">
                                                    <input type="submit" name="return_list" class="btn btn-primary"
                                                        value="Lưu và về danh sách">
                                                @else
                                                    <input type="submit" name="return_list" class="btn btn-primary" value="Cập nhật">
                                                @endif
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
