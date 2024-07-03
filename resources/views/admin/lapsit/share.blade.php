<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.fonnte.com/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
'target' => '081546833337,085812796488,085229482787',
'message' => 
'*Laporan Situasi*

Kejadian: ' . $kejadian->nama_kejadian . '
Lokasi: ' . $kejadian->lokasi . '
Tanggal: ' . $kejadian->tanggal_kejadian . '
Keterangan: ' . $kejadian->keterangan .'
Waktu Kirim: ' . $datenow, 
'countryCode' => '62', //optional
),
  CURLOPT_HTTPHEADER => array(
    'Authorization: 1X+jWxycMd--QG2MSkTv' //change TOKEN to your actual token
  ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
  $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
    echo $error_msg;
  } else {
    // Redirect to the /admin page
    header("Location: /admin/lapsit");
    exit();
  }

