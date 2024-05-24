@extends('admin.master')
@section('module', $nameItem)
@section('action', 'Quản lý')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('admin.partials.error')
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Quản lý trang menu</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row justify-content-evenly mb-4">
                                    <div class="col-lg-4">
                                        <div class="mt-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="flex-shrink-0 me-1">
                                                    <i
                                                        class="ri-pencil-fill fs-24 align-middle text-success me-1"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-16 mb-0 fw-semibold">Chọn lựa</h5>
                                                </div>
                                            </div>

                                            <div class="accordion accordion-border-box" id="genques-accordion">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="genques-headingOne">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#genques-collapseOne"
                                                            aria-expanded="false" aria-controls="genques-collapseOne">
                                                            Trang nội dung
                                                        </button>
                                                    </h2>
                                                    <div id="genques-collapseOne" class="accordion-collapse collapse"
                                                        aria-labelledby="genques-headingOne"
                                                        data-bs-parent="#genques-accordion" style="">
                                                        <div class="accordion-body">
                                                            <form action="{{ route('admin.menu.store') }}" method="POST">
                                                                @csrf
                                                                @foreach ($pageContent as $item)
                                                                    <div class="form-check mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="object_ids[]" value="{{ $item->id_page }}"
                                                                            id="formCheck{{ $item->id_page }}">
                                                                        <label class="form-check-label"
                                                                            for="formCheck{{ $item->id_page }}">
                                                                            {{ $item->name_vn }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                                <p class="text-muted">Chọn vị trí thêm vào</p>
                                                                <select class="form-select"
                                                                    aria-label=".form-select-sm example" name="parent_id">
                                                                    <option value="0" selected="">Chủ đề cha
                                                                    </option>
                                                                    @foreach ($menus as $item)
                                                                        <option value="{{ $item->id_menu }}">
                                                                            {{ $item->name_vn }}</option>
                                                                        @if ($item->children)
                                                                            @foreach ($item->children as $child)
                                                                                <option value="{{ $child->id_page }}">
                                                                                    |---{{ $child->name_vn }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" name="type" value="page">
                                                                <div class="col-lg-12" style="padding-top: 1rem">
                                                                    <div class="text-start">
                                                                        <input type="submit"
                                                                            class="btn btn-secondary waves-effect waves-light"
                                                                            value="Thêm vào menu">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="genques-headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#genques-collapseTwo"
                                                            aria-expanded="false" aria-controls="genques-collapseTwo">
                                                            Chuyên mục bài viết
                                                        </button>
                                                    </h2>
                                                    <div id="genques-collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="genques-headingTwo"
                                                        data-bs-parent="#genques-accordion" style="">
                                                        <div class="accordion-body">
                                                            <form action="{{ route('admin.menu.store') }}" method="POST">
                                                                @csrf
                                                                @foreach ($category_new as $item)
                                                                    <div class="form-check mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="object_ids[]"
                                                                            value="{{ $item->id_category_new }}"
                                                                            id="formCheck{{ $item->uuid }}">
                                                                        <label class="form-check-label"
                                                                            for="formCheck{{ $item->uuid }}">
                                                                            {{ $item->name_vn }}
                                                                        </label>
                                                                    </div>
                                                                    @if ($item->children)
                                                                        @foreach ($item->children as $child)
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" name="object_ids[]"
                                                                                    value="{{ $child->id_category_new }}"
                                                                                    id="formCheck{{ $child->uuid }}">
                                                                                <label class="form-check-label"
                                                                                    for="formCheck{{ $child->uuid }}">
                                                                                    |--{{ $child->name_vn }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                                <p class="text-muted">Chọn vị trí thêm vào</p>
                                                                <select class="form-select"
                                                                    aria-label=".form-select-sm example" name="parent_id">
                                                                    <option value="0" selected="">Chủ đề cha
                                                                    </option>
                                                                    @foreach ($menus as $item)
                                                                        <option value="{{ $item->id_menu }}">
                                                                            {{ $item->name_vn }}</option>
                                                                        @if ($item->children)
                                                                            @foreach ($item->children as $child)
                                                                                <option value="{{ $child->id_page }}">
                                                                                    |---{{ $child->name_vn }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" name="type" value="cate_new">
                                                                <div class="col-lg-12" style="padding-top: 1rem">
                                                                    <div class="text-start">
                                                                        <input type="submit"
                                                                            class="btn btn-secondary waves-effect waves-light"
                                                                            value="Thêm vào menu">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="genques-headingThree">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#genques-collapseThree" aria-expanded="false"
                                                            aria-controls="genques-collapseThree">
                                                            Danh mục sản phẩm
                                                        </button>
                                                    </h2>
                                                    <div id="genques-collapseThree" class="accordion-collapse collapse"
                                                        aria-labelledby="genques-headingThree"
                                                        data-bs-parent="#genques-accordion" style="">
                                                        <div class="accordion-body">
                                                            <form action="{{ route('admin.menu.store') }}" method="POST">
                                                                @csrf
                                                                @foreach ($category_product as $item)
                                                                    <div class="form-check mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="object_ids[]"
                                                                            value="{{ $item->id_category_product }}"
                                                                            id="formCheck{{ $item->uuid }}">
                                                                        <label class="form-check-label"
                                                                            for="formCheck{{ $item->uuid }}">
                                                                            {{ $item->name_vn }}
                                                                        </label>
                                                                    </div>
                                                                    @if ($item->children)
                                                                        @foreach ($item->children as $child)
                                                                            <div class="form-check mb-2">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" name="object_ids[]"
                                                                                    value="{{ $child->id_category_product }}"
                                                                                    id="formCheck{{ $child->uuid }}">
                                                                                <label class="form-check-label"
                                                                                    for="formCheck{{ $child->uuid }}">
                                                                                    |--{{ $child->name_vn }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                                <p class="text-muted">Chọn vị trí thêm vào</p>
                                                                <select class="form-select"
                                                                    aria-label=".form-select-sm example" name="parent_id">
                                                                    <option value="0" selected="">Chủ đề cha
                                                                    </option>
                                                                    @foreach ($menus as $item)
                                                                        <option value="{{ $item->id_menu }}">
                                                                            {{ $item->name_vn }}</option>
                                                                        @if ($item->children)
                                                                            @foreach ($item->children as $child)
                                                                                <option value="{{ $child->id_page }}">
                                                                                    |---{{ $child->name_vn }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" name="type" value="cate_product">
                                                                <div class="col-lg-12" style="padding-top: 1rem">
                                                                    <div class="text-start">
                                                                        <input type="submit"
                                                                            class="btn btn-secondary waves-effect waves-light"
                                                                            value="Thêm vào menu">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="genques-headingFour">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#genques-collapseFour" aria-expanded="false"
                                                            aria-controls="genques-collapseFour">
                                                            Thêm liên kết
                                                        </button>
                                                    </h2>
                                                    <div id="genques-collapseFour" class="accordion-collapse collapse"
                                                        aria-labelledby="genques-headingFour"
                                                        data-bs-parent="#genques-accordion" style="">
                                                        <div class="accordion-body">
                                                            <form action="{{ route('admin.menu.store') }}" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="product-title-input">Tiêu đề
                                                                       </label>
                                                                    <input type="text" class="form-control" name="name_vn" value="{{old('name_vn')}}"
                                                                       >
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="product-title-input">Đường dẫn</label>
                                                                    <input type="text" class="form-control" name="link" value="{{old('link')}}"
                                                                       >
                                                                </div>
                                                                <input type="hidden" name="type" value="link">
                                                                <p class="text-muted">Chọn vị trí thêm vào</p>
                                                                <select class="form-select"
                                                                    aria-label=".form-select-sm example" name="parent_id">
                                                                    <option value="0" selected="">Chủ đề cha
                                                                    </option>
                                                                    @foreach ($menus as $item)
                                                                        <option value="{{ $item->id_menu }}">
                                                                            {{ $item->name_vn }}</option>
                                                                        @if ($item->children)
                                                                            @foreach ($item->children as $child)
                                                                                <option value="{{ $child->id_page }}">
                                                                                    |---{{ $child->name_vn }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" name="type" value="cate_product">
                                                                <div class="col-lg-12" style="padding-top: 1rem">
                                                                    <div class="text-start">
                                                                        <input type="submit"
                                                                            class="btn btn-secondary waves-effect waves-light"
                                                                            value="Thêm vào menu">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end accordion-->
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="flex-shrink-0 me-1">
                                                    <i
                                                        class="ri-file-list-line fs-24 align-middle text-success me-1"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-16 mb-0 fw-semibold">Main Menu</h5>
                                                </div>
                                            </div>
                                            <div class="list-group col nested-list nested-sortable">
                                                @foreach ($menus as $item)
                                                    <div class="list-group-item nested-1"> <span class="fs-15"
                                                           >{{ $item->name_vn }}   </span>
                                                            <span style="float: right">
                                                                <button class="btn btn-secondary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#showModal{{$item->id_menu}}">Edit</button>
                                                                <a href="{{ route('admin.menu.destroy', ['uuid' => $item->uuid]) }}"  onclick="return confirm('Xác nhận xóa menu ?')"  class="btn btn-sm btn-danger remove-item-btn">Remove</a>
                                                                    </span>
                                                        <div class="list-group nested-list nested-sortable">
                                                            @if ($item->children)
                                                                @foreach ($item->children as $child)
                                                                    <div class="list-group-item nested-2" style="padding-right: unset">
                                                                        <span>{{ $child->name_vn }}</span><span style="float: right">
                                                                            <button class="btn btn-secondary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#showModal{{$item->id_menu}}">Edit</button>
                                                                            <a href="{{ route('admin.menu.destroy', ['uuid' => $child->uuid]) }}" onclick="return confirm('Xác nhận xóa menu ?')"    class="btn btn-sm btn-danger remove-item-btn">Remove</a>
                                                                                </span>
                                                                        </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!--end accordion-->
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    @foreach ($menus as $item)
    <div class="modal fade" id="showModal{{$item->id_menu}}" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form class="tablelist-form" action="{{ route('admin.menu.update', ['uuid' => $item->uuid ]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Tiêu đề</label>
                            <input type="text" name="name_vn" value="{{$item->name_vn}}" class="form-control" placeholder="Enter Name" required="">
                        </div>

                        <div class="mb-3">
                            <label for="email-field" class="form-label">STT</label>
                            <input type="number" value="{{$item->stt}}" name="stt" class="form-control" placeholder="Enter STT" required="">
                        </div>

                        <div>
                            <label for="status-field" class="form-label">Tình trạng</label>
                            <select class="form-control" data-trigger="" name="status" id="status-field" required="">
                                <option value="1">Bật</option>
                                <option value="0">Tắt</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: block;">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Update</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
