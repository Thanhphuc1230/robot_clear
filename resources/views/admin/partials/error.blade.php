@if ($errors->any())
    <div class="alert alert-danger mb-xl-0" role="alert" style="list-style-type: none">
        @foreach ($errors->all() as $error)
            <li>
                <h4>{{ $error }}</h4>
            </li>
        @endforeach
    </div>
@endif
@if (Session::get('error'))
    <div class="alert alert-danger mb-xl-0" role="alert"  style="list-style-type: none">
        <li>
            <h4>{!! Session::get('error') !!}</h4>
        </li>
    </div>
@endif
