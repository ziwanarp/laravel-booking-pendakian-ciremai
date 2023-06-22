@extends('user.template.main')

@section('container')


	<div class="hero">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-7">
					<div class="intro-wrap">
						<h1 class="mb-5"><span class="d-block">Gunung Ciremai</span> Via <span class="typed-words"></span></h1>

						<div class="row">
							<div class="col-12">
								<form class="form" method="post" action="/checkkuota">
									@csrf
									<div class="row mb-2">
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-4">
											<label for="jalur"><strong>Jalur Pendakian :</strong></label>
											<select name="jalur" id="jalur" class="form-control custom-select" required>
												<option value="">Pilih Jalur</option>
												@foreach ($jalur as $j)
												<option value="{{ $j->first()->jalur }}">{{ $j->first()->jalur }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-5">
											<label for="tanggal"><strong>Tanggal Mendaki :</strong></label>
											<input type="date" class="form-control" min="{{$today}}" name="tanggal" id="tanggal" required>
										</div>
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-3">
											<label for="jumlah_kuota"><strong>Jumlah Pendaki :</strong></label>
											<input type="number" id="jumlah_kuota" name="jumlah_kuota" min="4" value="4" class="form-control"required>
											<small>Minimal 4 orang.</small>
										</div>

									</div>    
									<div class="row align-items-center">
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-4">
											<input type="submit" class="btn btn-primary btn-block" >
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="slides">

						@if (isset($data->slide_palutungan))
						<img src="{{ asset('storage/'. $data->slide_palutungan) }}" alt="Image" class="img-fluid active">
						@else
						<img src="https://img.celebrities.id/okz/900/74f4DW/master_7352b7ZXwq_2135_gunung_merapi.jpg" alt="Image" class="img-fluid">
						@endif
						
						@if (isset($data->slide_linggarjati))
						<img src="{{ asset('storage/'. $data->slide_linggarjati) }}" alt="Image" class="img-fluid">
						@else
						<img src="https://cdn.idntimes.com/content-images/community/2021/10/165979415-454802692424765-4742859987778341157-n-07a4f29dba4b014075e472810bb49bf0-64be3022557f8c356cf768ba5eb5dcf2.jpg" alt="Image" class="img-fluid">
						@endif

						@if (isset($data->slide_linggasana))
						<img src="{{ asset('storage/'. $data->slide_linggasana) }}" alt="Image" class="img-fluid">
						@else
						<img src="http://assets.kompasiana.com/items/album/2021/04/18/whatsapp-image-2021-04-18-at-20-54-13-607c3afb8ede4862a7205292.jpeg" alt="Image" class="img-fluid">
						@endif

						@if (isset($data->slide_apuy))
						<img src="{{ asset('storage/'. $data->slide_apuy) }}" alt="Image" class="img-fluid">
						@else
						<img src="https://cdn.idntimes.com/content-images/post/20210722/66894905-415343555748382-9087086629507969679-n-aacf0245646b4da0dc870da72b3c0582.jpg" alt="Image" class="img-fluid">
						@endif
					
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="untree_co-section">
		<div class="container">
			<div class="row mb-5 justify-content-center">
				<div class="col-lg-6 text-center">
						@if (isset($data->tentang_title) )	
							<h2 class="section-title text-center mb-3">{{ $data->tentang_title }}</h2>
							<p>{{ $data->tentang_body }}</p>
						@else
							<h2 class="section-title text-center mb-3">Lorem Ipsum</h2>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, maxime aspernatur? Saepe blanditiis repudiandae quidem nemo provident eveniet placeat nihil ab debitis, odio hic molestiae fugit, architecto incidunt, sit voluptate nisi quas id optio delectus laudantium unde animi. Aliquam, saepe! Sapiente dicta aut sed praesentium, possimus saepe molestiae aperiam hic magni debitis, quisquam fugit, eligendi provident rerum odit nostrum accusamus nesciunt fuga voluptatem. Nemo consectetur ipsum laudantium laboriosam praesentium. Cum assumenda deserunt omnis est modi quibusdam excepturi mollitia maiores quo hic vel debitis accusantium quis libero, eveniet totam, aspernatur sapiente voluptas! Hic accusantium pariatur odio magnam ratione, earum facere ipsa!</p>
						@endif
				</div>
			</div>
			<div class="row align-items-stretch">
				<div class="col-lg-4 order-lg-1">
					@if (isset($data->slide_palutungan))
					<div class="h-100"><div class="frame h-100"><div class="feature-img-bg h-100" style="background-image: url('{{ asset('storage/'. $data->slide_palutungan) }}');"></div></div></div>
					@else
					<div class="h-100"><div class="frame h-100"><div class="feature-img-bg h-100" style="background-image: url('https://img.celebrities.id/okz/900/74f4DW/master_7352b7ZXwq_2135_gunung_merapi.jpg');"></div></div></div>
					@endif
				</div>

				<div class="col-6 col-sm-6 col-lg-4 feature-1-wrap d-md-flex flex-md-column order-lg-1" >

					<div class="feature-1 d-md-flex">
						<div class="align-self-center">
							<span class="flaticon-house display-4 text-primary"></span>
							<h3>Pos Pendakian</h3>
							<p class="mb-0">Di setiap jalur, terdapat beberapa Pos Pendakian yang dapat digunakan untuk Camp / Istirahat .</p>
						</div>
					</div>

					<div class="feature-1 ">
						<div class="align-self-center">
							<span class="flaticon-restaurant display-4 text-primary"></span>
							<h3>Voucher Makan</h3>
							<p class="mb-0">Di beberapa Jalur pendakian setiap Booking-Pendakian bisa mendapatkan Voucher makan 1x Voucher untuk 1 orang.</p>
						</div>
					</div>

				</div>

				<div class="col-6 col-sm-6 col-lg-4 feature-1-wrap d-md-flex flex-md-column order-lg-3" >

					<div class="feature-1 d-md-flex">
						<div class="align-self-center">
							<span class="flaticon-mail display-4 text-primary"></span>
							<h3>Pendaftaran Mudah</h3>
							<p class="mb-0">Daftar / Masuk dengan 1 akun untuk dapat melalukan Booking Pendaftaran Pendakian.</p>
						</div>
					</div>

					<div class="feature-1 d-md-flex">
						<div class="align-self-center">
							<span class="flaticon-phone-call display-4 text-primary"></span>
							<h3>Telp Kesehatan</h3>
							<p class="mb-0">Rumah Sakit terdekat, Telp. +62232873206.</p>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

	<div class="untree_co-section">
		<div class="container">
			<div class="row text-center justify-content-center mb-5">
				<div class="col-lg-7"><h2 class="section-title text-center">Jalur Pendakian Tersedia</h2></div>
			</div>

			<div class="owl-carousel owl-3-slider">

				<div class="item">
					<form action="/checkkuota/jalur" method="post">
						@csrf
						<input type="hidden" name="jalur" value="Palutungan">
					<button type="submit" class="media-thumb border-0" >
						<div class="media-text">
							<h3>Jalur Palutungan</h3>
							<span class="location">Kuningan</span>
						</div>
						@if (isset($data->slide_palutungan))
						<img src="{{ asset('storage/'. $data->slide_palutungan) }}" alt="Image" class="img-fluid">
						@else
						<img src="https://img.celebrities.id/okz/900/74f4DW/master_7352b7ZXwq_2135_gunung_merapi.jpg" alt="Image" class="img-fluid">
						@endif
					</button>
				</form>
				</div>

				<div class="item">
					<form action="/checkkuota/jalur" method="post">
						@csrf
						<input type="hidden" name="jalur" value="Linggarjati">
					<button type="submit" class="media-thumb border-0" >
						<div class="media-text">
							<h3>Jalur Linggarjati</h3>
							<span class="location">Kuningan</span>
						</div>
						@if (isset($data->slide_linggarjati))
						<img src="{{ asset('storage/'. $data->slide_linggarjati) }}" alt="Image" class="img-fluid">
						@else
						<img src="https://cdn.idntimes.com/content-images/community/2021/10/165979415-454802692424765-4742859987778341157-n-07a4f29dba4b014075e472810bb49bf0-64be3022557f8c356cf768ba5eb5dcf2.jpg" alt="Image" class="img-fluid">
						@endif
					</button>
				</form>
				</div>

				<div class="item">
					<form action="/checkkuota/jalur" method="post">
						@csrf
						<input type="hidden" name="jalur" value="Linggasana">
					<button type="submit" class="media-thumb border-0" >
						<div class="media-text">
							<h3>Jalur Linggasana</h3>
							<span class="location">Kuningan</span>
						</div>
						@if (isset($data->slide_linggasana))
						<img src="{{ asset('storage/'. $data->slide_linggasana) }}" alt="Image" class="img-fluid">
						@else
						<img src="http://assets.kompasiana.com/items/album/2021/04/18/whatsapp-image-2021-04-18-at-20-54-13-607c3afb8ede4862a7205292.jpeg" alt="Image" class="img-fluid">
						@endif
					</button>
				</form>
				</div>


				<div class="item">
					<form action="/checkkuota/jalur" method="post">
						@csrf
						<input type="hidden" name="jalur" value="Apuy">
					<button type="submit" class="media-thumb border-0" >
						<div class="media-text">
							<h3>Jalur Apuy</h3>
							<span class="location">Majalengka</span>
						</div>
						@if (isset($data->slide_apuy))
						<img src="{{ asset('storage/'. $data->slide_apuy) }}" alt="Image" class="img-fluid">
						@else
						<img src="https://cdn.idntimes.com/content-images/post/20210722/66894905-415343555748382-9087086629507969679-n-aacf0245646b4da0dc870da72b3c0582.jpg" alt="Image" class="img-fluid">
						@endif
					</button>
				</form>
				</div>
			</div>

		</div>
	</div>

	<div class="py-5 cta-section">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-12">
					<h2 class="mb-2 text-white">Ayo lakukan pendakian sekarang ke Gunung Ciremai !</h2>
					<p class="mb-4 lead text-white text-white-opacity">Untuk mendapatkan experience yang menyenangkan, harap membawa full peralatan untuk mendaki sesuai dengan prosedur.</p>
					<p class="mb-0"><a href="#" class="btn btn-outline-white text-white btn-md font-weight-bold">Booking Disini</a></p>
				</div>
			</div>
		</div>
	</div>

@endsection