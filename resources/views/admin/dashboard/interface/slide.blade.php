
@extends('admin.template.main')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Slide Images</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Slide Image Atas</h6>
    </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Slide palutungan</th>
                <th>Slide Linggarjati</th>
                <th>Slide Linggasana</th>
                <th>Slide Apuy</th>
            </tr>
        </thead>
            
        <tbody>
            <tr>
                @if (isset($data))
                    <td><img width="200px" src="{{ asset('storage/'. $data->slide_palutungan) }}" alt=""></td>
                    <td><img width="200px" src="{{ asset('storage/'.  $data->slide_linggarjati) }}" alt=""></td>
                    <td><img width="200px" src="{{ asset('storage/'.  $data->slide_linggasana) }}" alt=""></td>
                    <td><img width="200px" src="{{ asset('storage/'.  $data->slide_apuy) }}" alt=""></td>
                @else
                    <td>Tidak Tersedia</td>
                    <td>Tidak Tersedia</td>
                    <td>Tidak Tersedia</td>
                    <td>Tidak Tersedia</td>
                @endif
                
            </tr>
        </tbody>
    </table>

        <div class="card-body">
            <div class="table-responsive">
                <form action="/dashboard/interface/slide/" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="1">
                    <div class="my-3">
                        @if (isset($data))
                        <input type="hidden" name="old_palutungan" value="{{ $data->slide_palutungan }}">
                        @endif
                    <label for="slide_palutungan">Ubah Slide Palutungan :</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" id="slide_palutungan" name="slide_palutungan" onchange="previewImage()" required>
                        <img src="" class="img-palutungan ml-3" width="200px">
                    </div>
                    <hr>
                    <div class="mb-3">
                        @if (isset($data))
                        <input type="hidden" name="old_linggarjati" value="{{ $data->slide_linggarjati }}">
                        @endif
                    <label for="slide_linggarjati">Ubah Slide Linggarjati :</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" id="slide_linggarjati" name="slide_linggarjati" onchange="previewImage2()" required>
                        <img src="" class="img-linggarjati mt-3" width="200px">
                    </div>
                    <hr>
                    <div class="mb-3">
                        @if (isset($data))
                        <input type="hidden" name="old_linggasana" value="{{ $data->slide_linggasana }}">
                        @endif
                    <label for="slide_linggasana">Ubah Slide Linggasana :</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" id="slide_linggasana" name="slide_linggasana" onchange="previewImage3()" required>
                        <img src="" class="img-linggasana mt-3" width="200px">
                    </div>
                    <hr>
                    <div class="mb-3">
                        @if (isset($data))
                        <input type="hidden" name="old_apuy" value="{{ $data->slide_apuy }}">
                        @endif
                    <label for="slide_apuy">Ubah Slide Apuy :</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" id="slide_apuy" name="slide_apuy" onchange="previewImage4()" required>
                        <img src="" class="img-apuy mt-3" width="200px">
                    </div>
                    <hr>
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Save</span>
                        </button>
                </div>
                </form>
            </div>
        </div>
</div>

<script>
    
    function previewImage(){
    const slide_palutungan =document.querySelector('#slide_palutungan');
    const imgPreview1 = document.querySelector('.img-palutungan');

    imgPreview1.style.display ='block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(slide_palutungan.files[0]);

    oFReader.onload = function(oFREvent){
    imgPreview1.src = oFREvent.target.result;
}
}
    function previewImage2(){
    const slide_linggarjati =document.querySelector('#slide_linggarjati');
    const imgPreview1 = document.querySelector('.img-linggarjati');

    imgPreview1.style.display ='block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(slide_linggarjati.files[0]);

    oFReader.onload = function(oFREvent){
    imgPreview1.src = oFREvent.target.result;
}
}
    function previewImage3(){
    const slide_linggasana =document.querySelector('#slide_linggasana');
    const imgPreview1 = document.querySelector('.img-linggasana');

    imgPreview1.style.display ='block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(slide_linggasana.files[0]);

    oFReader.onload = function(oFREvent){
    imgPreview1.src = oFREvent.target.result;
}
}
    function previewImage4(){
    const slide_apuy =document.querySelector('#slide_apuy');
    const imgPreview1 = document.querySelector('.img-apuy');

    imgPreview1.style.display ='block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(slide_apuy.files[0]);

    oFReader.onload = function(oFREvent){
    imgPreview1.src = oFREvent.target.result;
}
}
</script>

@endsection