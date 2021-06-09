<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>BorrowMe - Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
	<div>
   		<div style="font-size: 36px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: red;font-family: sans-serif;text-align: center; margin-top: 10px;" align="center" id="emb-email-header">
   			<?= $title; ?>
  		</div>

		<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px; margin-bottom: 25px">
			Hey <?= $full_name; ?>, 
		</p> 
		<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px; margin-bottom: 25px"> 
			Sehubungan dengan permohonan peminjaman <?= $jumlah; ?> <?= $name; ?> dari tanggal <?= $awal_pinjam; ?> hingga tanggal <?= $akhir_pinjam; ?> yang anda ajukan, kami memberitahukan permohonan peminjaman anda telah ditolak karena beberapa alasan teknis.
		</p>
		<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px; margin-bottom: 25px"> 
			Silahkan coba lagi peminjaman barang di lain waktu.
		</p>
		<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px; margin-bottom: 25px"> 
			Atas perhatiannya kami ucapkan terima kasih.
		</p>

	</div>
</body>
</html>