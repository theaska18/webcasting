
<script>
let ws = null;
let reconnectTimer = null;

const servers = [
    "wss://103.119.63.137:13000/webcast/<?= $roomName; ?>/",
    "wss://192.168.1.2:13000/webcast/<?= $roomName; ?>/"
];

let serverIndex = 0;

function connect() {

    const url = servers[serverIndex];

    console.log("Connecting to:", url);

    ws = new WebSocket(url);

    ws.onopen = () => {

        console.log("Connected:", url);

        if (reconnectTimer) {
            clearTimeout(reconnectTimer);
            reconnectTimer = null;
        }

        serverIndex = 0; // reset ke server utama

        ws.send(JSON.stringify({

            action: "auth",
            token: '<?= $jwt; ?>',

        }));
    };

    ws.onmessage = (event) => {
        console.log("Receive:", event.data);
    };

    ws.onerror = (error) => {
        console.error("WebSocket Error:", error);

        // biarkan onclose yang menangani reconnect
        ws.close();
    };

    ws.onclose = (event) => {

        console.log(`Disconnected (${event.code})`);

        if (reconnectTimer) {
            return;
        }

        // Coba server berikutnya
        serverIndex++;

        if (serverIndex >= servers.length) {
            serverIndex = 0;
        }

        reconnectTimer = setTimeout(() => {

            reconnectTimer = null;
            connect();

        }, 1000);

    };
}

connect();
</script>
        <style>
          html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
          }
          #video-meet {
            height: 100%;
            width: 100%;
          }
        </style>
        <script src='https://jitsi.ckamal.com/external_api.js'></script>
        <div id="video-meet" ref="apiRef" />
        <script>
          const domain = 'jitsi.ckamal.com';
          const options = {
            roomName: '<?= $roomName; ?>',
            jwt:'<?= $jwt; ?>',
            parentNode: document.querySelector("#video-meet"),
            // noSsl: 'true',
            configOverwrite: {
              // pollCreationRequiresPermission: true,
                toolbarButtons: [
                     'camera',
      //  'chat',
       'closedcaptions',
       'desktop',
       'download',
      //  'embedmeeting',
       'etherpad',
      //  'feedback',
       'filmstrip',
      //  'fullscreen',
      //  'hangup',
       'help',
       'highlight',
      //  'invite',
       'linktosalesforce',
      //  'livestreaming',
       'microphone',
      //  'noisesuppression',
       'participants-pane',
      //  'profile',
       'raisehand',
      //  'recording',
      //  'security',
      //  'select-background',
       'settings',
      //  'shareaudio',
      //  'sharedvideo',
      //  'shortcuts',
      //  'stats',
       'tileview',
       'toggle-camera',
       'videoquality',
       'whiteboard',
                ] // kosong = tidak ada tombol
            }
//           userInfo: {
//               displayName: '3065VideoTest2',
//               avatar:''
//             },
//             interfaceConfigOverwrite: {
//         SHOW_JITSI_WATERMARK: false,
//         SHOW_WATERMARK_FOR_GUESTS: false,
//         SHOW_PROMOTIONAL_CLOSE_PAGE: false,
//         DEFAULT_LOGO_URL: window.location.origin + "/assets/images/logo1.png",
//         DEFAULT_WELCOME_PAGE_LOGO_URL: window.location.origin + "/assets/images/logo1.png",
//     },
//             configOverwrite:{
//                 configOverwrite: {
//     disableInviteFunctions: true
// },
//             	disabledNotifications: ['transcribing.failed'],
//             	transcription:{
//             		disableClosedCaptions:false,
//             	}
//             },
          };
          const api = new JitsiMeetExternalAPI(domain, options);
      //     	api.addEventListener('videoConferenceJoined', () => {
			//    try {
      //               api.executeCommand('startRecording', {
      //                   mode: 'stream',
      //                   rtmpStreamKey: 'rtmp://nginx-rtmp/stream/<?= $roomName; ?>'
      //               });

      //               console.log('Streaming started');
      //           } catch (e) {
      //               console.error('Failed to start streaming', e);
      //           }
			// });
            api.addListener('readyToClose', () => {
                location.reload();
            });
        </script>