@extends('admin.master')
@section('module', $nameItem)
@section('action', $action == 'create' ? 'Thêm' : 'Chỉnh sửa')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $action == 'create' ? 'Thêm' : 'Chỉnh sửa' }}
                            {{ $nameItem }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>Sản phẩm</a></li>
                                <li class="breadcrumb-item active">{{ $action == 'create' ? 'Thêm' : 'Chỉnh sửa' }} sản phẩm
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form
                action="{{ route('admin.' . $nameClass . ($action == 'create' ? '.store' : '.update'), ['uuid' => $page->uuid ?? '']) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @include('admin.partials.error')

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Tiêu đề
                                        {{ $nameItem }} Tiếng việt</label>
                                    <input type="text" id="name_vn" class="form-control" name="name_vn"
                                        value="{{ old('name_vn', $page->name_vn ?? '') }}"
                                        placeholder="Enter your title page ">
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
                                        <input type="text" id="slug" name="slug" class="form-control"
                                            value="{{ old('slug', $page->slug ?? '') }}" placeholder="Slug">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label  class="form-label">Sku</label>
                                            <input type="text"  name="sku" class="form-control"
                                                value="{{ old('sku', $page->sku ?? '') }}" placeholder="Sku">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label  class="form-label">Thương hiệu</label>
                                            <input type="text" name="brand" class="form-control"
                                                value="{{ old('brand', $page->slug ?? '') }}" placeholder="brand">
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Giới thiệu</label>
                                        <textarea id="my-editor-en" class="form-control" name="intro_vn" rows="6" placeholder="Enter your message">{{ old('intro_vn', $page->intro_vn ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Nội dung (Tiếng
                                            việt)</label>
                                        <textarea id="my-editor" class="form-control" name="content_vn" rows="6" placeholder="Enter your message">{{ old('content_vn', $page->content_vn ?? '') }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card -->


                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                            role="tab" aria-selected="true">
                                            Thông tin tổng quan
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata" role="tab"
                                            aria-selected="false" tabindex="-1">
                                            SEO
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="product-price-input">Giá tiền(nhập 0 sẽ
                                                        hiện liên hệ)</label>
                                                    <div class="input-group has-validation mb-3">
                                                        <span class="input-group-text" id="product-price-addon">VND</span>
                                                        <input type="number" class="form-control" placeholder="Enter price"
                                                            name="price" value="{{ old('price', $page->price ?? '') }}">
                                                        <div class="invalid-feedback">Please Enter a product price.</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="product-discount-input">Giảm
                                                        giá</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="product-discount-addon">%</span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter discount" name="discount"
                                                            value="{{ old('discount', $page->discount ?? '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- end tab-pane -->

                                    <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="meta-keywords-input">Meta
                                                        Keywords</label>
                                                    <textarea class="form-control" name="meta_keywords" rows="3" placeholder="Enter your message">{{ old('meta_keywords', $page->meta_keywords ?? '') }}</textarea>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div>
                                            <label class="form-label" for="meta-description-input">Meta
                                                Description</label>
                                            <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter your message">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Hình ảnh sản phẩm</h5>
                            </div>
                            <div class="card-body">
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
                                            <img src="{{ asset('images/products/' . $page->avatar) }}" alt=""
                                                width="200px" height="auto">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="compnayNameinput" class="form-label">Hình ảnh chi tiết
                                            (280x280)</label>
                                        <div class="md-3">
                                            <div class="input-group hdtuto control-group lst increment">
                                                <div class="list-input-hidden-upload">
                                                    <input type="file" name="image_detail[]" id="file_upload"
                                                        class="myfrm form-control hidden">
                                                </div>
                                                <div class="input-group-btn">
                                                    <button class="btn btn-success btn-add-image" type="button"><i
                                                            class="fldemo glyphicon glyphicon-plus"></i>+Add image</button>
                                                </div>
                                            </div>
                                            <div class="list-images">
                                                @if ($action == 'create')
                                                    @php
                                                        $setting = isset($setting) ? $setting : null;
                                                        $images = $setting ? $setting->image_detail : null;
                                                    @endphp
                                                @else
                                                    @php
                                                        $page = isset($page) ? $page : null;
                                                        $images = $page ? $page->image_detail : null;
                                                    @endphp
                                                @endif
                                                @if (isset($images) && !empty($images))
                                                    @foreach (json_decode($images) as $key => $img)
                                                        <div class="box-image">
                                                            <input type="hidden" name="images_uploaded[]"
                                                                value="{{ $img }}"
                                                                id="img-{{ $key }}">
                                                            <img src="{{ asset('images/' . ($action == 'create' ? 'question' : 'products') . '/' . $img) }}"
                                                                class="picture-box"
                                                                {{ $action == 'create' ? 'width="200px"' : 'height="150px"' }}>
                                                            <div class="wrap-btn-delete"><span
                                                                    data-id="img-{{ $key }}"
                                                                    class="btn-delete-image">x</span></div>
                                                        </div>
                                                    @endforeach
                                                    <input type="hidden" name="images_uploaded_origin"
                                                        value="{{ $action == 'create' ? $setting->image_detail : $page->image_detail }}">
                                                    <input type="hidden"
                                                        name="{{ $action == 'create' ? 'id_setting_question' : 'uuid' }}"
                                                        value="{{ $action == 'create' ? $setting->id_setting_question : $page->uuid }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
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
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Hiện thị</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Trang thái</label>

                                    <select class="form-select" name="status">
                                        <option value="1"
                                            {{ (old('status') ?: $page->status ?? '') == 1 ? 'selected' : '' }}>Bật
                                        </option>
                                        <option value="0"
                                            {{ (old('status') ?: $page->status ?? '') == 0 ? 'selected' : '' }}>Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Nội bật</label>

                                    <select class="form-select" name="hot">
                                        <option value="0"
                                            {{ (old('hot') ?: $page->hot ?? '') == 0 ? 'selected' : '' }}>
                                            Ẩn</option>
                                        <option value="1"
                                            {{ (old('hot') ?: $page->hot ?? '') == 1 ? 'selected' : '' }}>
                                            Bật</option>

                                    </select>
                                </div>

                                <div>
                                    <label for="choices-publish-visibility-input" class="form-label">STT</label>
                                    <input type="number" name="stt" class="form-control"
                                        placeholder="Enter your title page" value="{{ old('stt', $page->stt ?? '') }}">
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Chủ đề sản phẩm</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select" id="choices-category-input" name="category_id">
                                    @php
                                        renderCategoryOptions(
                                            $category,
                                            0,
                                            old('category_id') ?: $page->category_id ?? null,
                                            'id_category_product',
                                        );
                                    @endphp
                                </select>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        {{-- <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Giới thiệu sản phẩm(Tiếng việt)</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">Viết 1 đoạn ngắn về sản phẩm dưới 100 từ</p>
                                <textarea class="form-control" name="intro_vn" placeholder="Must enter minimum of a 100 characters" rows="3">{{ old('intro_vn', $page->intro_vn ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Giới thiệu sản phẩm(English)</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">Viết 1 đoạn ngắn về sản phẩm dưới 100 từ</p>
                                <textarea class="form-control" name="intro_en" placeholder="Must enter minimum of a 100 characters" rows="3">{{ old('intro_en', $page->intro_en ?? '') }}</textarea>
                            </div>
                        </div> --}}
                        <!-- end card -->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </form>

        </div>
        <!-- container-fluid -->
    </div>
@endsection
