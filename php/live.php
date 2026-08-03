<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Streaming</title>

    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <style>
        body{
            margin:0;
            background:#111;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        video{
            width:90%;
            max-width:1200px;
            background:#000;
        }
    </style>
</head>
<body>

<video id="video" controls autoplay muted playsinline></video>

<script>
const video = document.getElementById('video');

// Ganti dengan URL stream kamu
const videoSrc = 'https://live.ckamal.com/live/test.m3u8';

if (Hls.isSupported()) {

    const hls = new Hls({
    lowLatencyMode: true,
    liveSyncDurationCount: 1,
    liveMaxLatencyDurationCount: 2,
    maxBufferLength: 1,
    backBufferLength: 0,
    maxMaxBufferLength: 2
});

    hls.loadSource(videoSrc);
    hls.attachMedia(video);

    hls.on(Hls.Events.MANIFEST_PARSED, function () {
        video.play();
    });

    hls.on(Hls.Events.ERROR, function(event, data){
        console.log(data);
    });

}
else if (video.canPlayType('application/vnd.apple.mpegurl')) {
    video.src = videoSrc;
    video.play();
}
else{
    alert("Browser tidak mendukung HLS");
}
</script>

</body>
</html>