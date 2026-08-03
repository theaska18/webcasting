<?php
$date = new DateTime('now', new DateTimeZone('UTC'));
$contentType="html";
  $content=' <div style="padding:20px;">
        <h2>Selamat Datang di CMS Admin Panel</h2>
        <p>Ini adalah halaman utama aplikasi Anda.</p>
        <p>Waktu: '.$date->format('Y-m-d H:i:s').'</p>
      </div> ';

?>