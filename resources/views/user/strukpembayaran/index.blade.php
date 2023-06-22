	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
    	<meta name="google" value="notranslate">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Struk Prmbayaran</title>
<head>
	<style>
		table {
		width: 100%;
		}
	</style>
</head>
<body>
	<div class="container">
		<h4>Tanggal Cetak: {{Carbon\Carbon::now()->toDateTimeString()}}</h4>
		<div class="content-center">
	<table border="1px">
		<tr>
			<td width="80px"><img src="https://i.ibb.co/m9f5fmz/tngc.png" alt="logo-tngc" width="80px" /></td>
			<td>
				<table cellpadding="4">
					<tr>
						<td width="200px"><div class="lead">Kode Order:</td>
						<td><div class="value">{{$data->kode_order}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Nama :</div></td>
						<td><div class="value">{{$data->user->name}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Jumlah Pendaki:</div></td>
						<td><div class="value">{{$data->jumlah_pendaki}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Tanggal Naik:</div></td>
						<td><div class="value">{{$data->tanggal_naik}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Jalur :</div></td>
						<td><div class="value">{{$data->kuota->jalur}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Total Harga:</div></td>
						<td><div class="value-big">Rp. {{ number_format($data->harga, 0, ".", ".") }},-</div></td>
					</tr>
					<tr>
						<td><div class="lead">Pengesahan:</div></td>
						<td><img class="center" width="100px" src="https://i.ibb.co/Z8cpYgw/ttd.png" alt="image-ttd"><br>
                            <div class="value">Admin TNGC</div></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<p>*Struk pembayaran ini diperlihatkan ke petugas pos pendakian sesuai dengan jalur untuk konfirmasi </p>
</div>
</div>
</body>
</html>