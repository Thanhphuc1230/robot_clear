   <!--start back-to-top-->
   <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin_style/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_style/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_style/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin_style/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin_style/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin_style/assets/js/plugins.js') }}"></script>

    <script src="{{ asset('admin_style/code.jquery.com/jquery-3.6.0.min.js') }}"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="{{ asset('admin_style/cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_style/cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin_style/cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_style/cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin_style/cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin_style/cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_style/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin_style/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin_style/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>

    <script src="{{asset('admin_style/assets/js/pages/datatables.init.js') }}"></script>
    <!-- App js -->
    <script src="{{asset('admin_style/assets/js/app.js') }}"></script>


    {{-- upload file images --}}
    <script type="text/javascript">
        $(document).ready(function() {
        $(".btn-add-image").click(function(){
            $('#file_upload').trigger('click');
        });
    
        $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
            let today = new Date();
            let time = today.getTime();
            let image = event.target.files[0];
            let file_name = event.target.files[0].name;
            let box_image = $('<div class="box-image"></div>');
            box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box" width="200px">');
            box_image.append('<div class="wrap-btn-delete"><span data-id='+time+' class="btn-delete-image">x</span></div>');
            $(".list-images").append(box_image);
    
            $(this).removeAttr('id');
            $(this).attr( 'id', time);
            let input_type_file = '<input type="file" name="image_detail[]" id="file_upload" class="myfrm form-control hidden">';
            $('.list-input-hidden-upload').append(input_type_file);
        });
    
        $(".list-images").on('click', '.btn-delete-image', function(){
            let id = $(this).data('id');
            $('#'+id).remove();
            $(this).parents('.box-image').remove();
        });
        });
    </script>

<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>

<script>
    CKEDITOR.replace('my-editor-en', options);
    CKEDITOR.replace('my-editor', options);
    CKEDITOR.replace('my-intro-en', options);
    CKEDITOR.replace('my-intro', options);
</script>



{{-- render avatar --}}
<script>
document.getElementById('fileInput').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (!file) return;
  
  const reader = new FileReader();
  reader.onload = function(e) {
    document.getElementById('imageContainer').innerHTML = `<img src="${e.target.result}" style="max-width: 100%">`;
  };
  reader.readAsDataURL(file);
});
</script>

{{-- create slug follow name_vn --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('name_vn');
    const slugInput = document.getElementById('slug');

    titleInput.addEventListener('input', function () {
        const title = titleInput.value;

        // Loại bỏ dấu tiếng Việt
        const slug = title
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .trim()
            // Thay thế các ký tự không phải chữ cái hoặc số bằng dấu gạch ngang
            .replace(/[^a-z0-9]+/g, '-')
            // Loại bỏ các dấu gạch ngang ở đầu và cuối
            .replace(/^-+|-+$/g, '');

        slugInput.value = slug;
    });
});

// Checkbox all
$(document).ready(function() {
           $('#masterCheckbox').click(function() {
               // Lấy trạng thái của checkbox master
               var isChecked = $(this).prop('checked');

               // Lặp qua tất cả các ô checkbox trong bảng
               $('table tbody input[type="checkbox"]').each(function() {
                   // Đặt trạng thái của các ô checkbox khác bằng với checkbox master
                   $(this).prop('checked', isChecked);
               });
           });
       });
       // submit delete all
       $(document).ready(function() {
           $('#deleteSelectedItems').click(function() {
               // Sử dụng jQuery để chọn biểu mẫu và gọi hàm submit() của nó
               $('form').submit();
           });
       });
</script>