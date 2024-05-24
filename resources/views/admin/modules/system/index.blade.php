@extends('admin.master')
@section('module', 'System')
@section('action', 'Infomation')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            @include('admin.partials.error')
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thông tin website</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('admin.system.update',['id'=>$system->id_system]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        {{-- info website --}}
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Tên website</label>
                                                <input type="text" name="meta_name" class="form-control"
                                                    placeholder="Enter your title page" value="{{ old('meta_name',$system->meta_name) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Địa chỉ</label>
                                                <input type="text" name="address" class="form-control"
                                                    placeholder="Enter your title page" value="{{ old('address',$system->address) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Email</label>
                                                <input type="text" name="email" class="form-control"
                                                    placeholder="Enter your title page" value="{{ old('email',$system->email) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Email nhận thông báo</label>
                                                <input type="text" name="email_alert" class="form-control"
                                                    placeholder="Enter your title page" value="{{ old('email_alert',$system->email_alert) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Hotline</label>
                                                <input type="text" name="hotline" class="form-control"
                                                    placeholder="Enter your title page" value="{{ old('hotline',$system->hotline) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Favicon</label>
                                                <img src="{{asset('images/logo/'.$system->favicon)}}" alt="favicon" width="150px">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Logo</label>
                                                <img src="{{asset('images/logo/'.$system->logo)}}" alt="logo" width="150px">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Favicon</label>
                                                <input type="file" name="favicon" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Logo</label>
                                                <input type="file" name="logo" class="form-control">
                                            </div>
                                        </div>

                                        {{-- Social media --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Facebook</label>
                                                <input type="text" name="link_facebook" class="form-control"
                                                    placeholder="Link to Facebook" value="{{ old('link_facebook',$system->link_facebook) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Twtter</label>
                                                <input type="text" name="link_twitter" class="form-control"
                                                    placeholder="Link to Twtter" value="{{ old('link_twitter',$system->link_twitter) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Youtube</label>
                                                <input type="text" name="link_youtube" class="form-control"
                                                    placeholder="Link to Youtube" value="{{ old('link_youtube',$system->link_youtube) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Instagram</label>
                                                <input type="text" name="link_instagram" class="form-control"
                                                    placeholder="Link to Instagram" value="{{ old('link_instagram',$system->link_instagram) }}">
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Zalo</label>
                                                <input type="text" name="link_zalo" class="form-control"
                                                    placeholder="Link to Zalo" value="{{ old('link_zalo',$system->link_zalo) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Thông tin chuyển khoản</label>
                                                <textarea class="form-control" name="stk" rows="5" placeholder="Enter your stk">{{ old('stk',$system->stk) }}</textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="lastNameinput" class="form-label">Meta keywords(Website
                                                    Keyword)</label>
                                                <textarea class="form-control" name="meta_keyword" rows="5" placeholder="Enter your message">{{ old('meta_keyword',$system->meta_keyword) }}</textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="compnayNameinput" class="form-label">Meta Description(Website
                                                    Description)</label>
                                                <textarea class="form-control" name="meta_description" rows="5" placeholder="Enter your message">{{ old('meta_description',$system->meta_description) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="compnayNameinput" class="form-label">Iframe Map</label>
                                                <textarea class="form-control" name="map" rows="5" placeholder="Enter your message">{{ old('map',$system->map) }}</textarea>
                                            </div>
                                        </div>

                                        <!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Script Header()</label>
                                                <textarea class="form-control" name="header_js" rows="6" placeholder="Enter your message">{{ old('header_js',$system->header_js) }}</textarea>
                                                <label for="phonenumberInput" class="form-label">Insert script into header
                                                    (google analytics code, google main code..)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Script Body</label>
                                                <textarea class="form-control" name="body_js" rows="6" placeholder="Enter your message">{{ old('body_js',$system->body_js) }}</textarea>
                                                <label for="phonenumberInput" class="form-label">Insert the script right
                                                    after the body tag</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Script Footer</label>
                                                <textarea class="form-control" name="footer_js" rows="6" placeholder="Enter your message">{{ old('footer_js',$system->footer_js) }}</textarea>
                                                <label for="phonenumberInput" class="form-label">Insert script into footer
                                                    (chat code, statistics code...)</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Footer</label>
                                                <textarea class="form-control" name="footer" id="my-editor" rows="6" placeholder="Enter your message">{{ old('footer',$system->footer) }}</textarea>
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
