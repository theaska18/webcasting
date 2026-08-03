<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Live Streaming</title>

    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/logo1.png">

    <!-- Video.js CSS -->
    <link href="https://vjs.zencdn.net/8.23.4/video-js.css" rel="stylesheet">

    <style>
        html,
body{
    margin:0;
    padding:0;
    width:100%;
    height:100vh;
    /* overflow:hidden; */
    background:#111;
}

body{
    display:flex;
    justify-content:center;
    align-items:center;
}

.video-js{
    width:100vw;
    height:calc( 100% - 300px ) !important;
}

.video-js video{
    object-fit:contain;
}
    </style>
</head>

<body>

<video
    id="player"
    class="video-js vjs-default-skin vjs-big-play-centered"
    controls
    autoplay
    muted
    playsinline
></video>

<script src="https://vjs.zencdn.net/8.23.4/video.min.js"></script>

<script>

const player = videojs('player', {

    autoplay:true,
    muted:true,
    controls:true,
    preload:'auto',

    fluid:true,

    liveui:true,

    html5:{
    vhs:{
        overrideNative:true,
        enableLowInitialPlaylist:true,
        smoothQualityChange:true,
        allowSeeksWithinUnsafeLiveWindow:true
    }
}

});

player.src({
    src:'https://live.ckamal.com/live/<?= $roomName; ?>.m3u8',
    type:'application/x-mpegURL'
});

player.ready(function(){

    player.play().catch(e=>{
        console.log(e);
    });
});

function loadStream() {

    console.log("Reload stream...");

    player.pause();

    player.reset();

    player.src({
        src: 'https://live.ckamal.com/live/<?= $roomName; ?>.m3u8?t=' + Date.now(),
        type: 'application/x-mpegURL'
    });

    player.load();

    player.play().catch(console.log);
}

player.on('error',function(){

    console.log("Reconnect...");

    setTimeout(loadStream,3000);

});
setInterval(() => {

    if (player.readyState() < 2) {

        console.log("Stream not ready, reconnect...");

        loadStream();

    }

}, 3000);
</script>

</body>
</html>