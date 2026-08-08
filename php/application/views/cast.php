
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
            parentNode: document.querySelector("#video-meet"),
            noSsl: 'true',
          userInfo: {
              displayName: '3065VideoTest2',
              avatar:''
            },
            interfaceConfigOverwrite: {
        SHOW_JITSI_WATERMARK: false,
        SHOW_WATERMARK_FOR_GUESTS: false,
        SHOW_PROMOTIONAL_CLOSE_PAGE: false,
        DEFAULT_LOGO_URL: window.location.origin + "/assets/images/logo1.png",
        DEFAULT_WELCOME_PAGE_LOGO_URL: window.location.origin + "/assets/images/logo1.png",
    },
            configOverwrite:{
                configOverwrite: {
    disableInviteFunctions: true
},
            	disabledNotifications: ['transcribing.failed'],
            	transcription:{
            		disableClosedCaptions:false,
            	}
            },
          };
          const api = new JitsiMeetExternalAPI(domain, options);
          	api.addEventListener('videoConferenceJoined', () => {
			   try {
                    api.executeCommand('startRecording', {
                        mode: 'stream',
                        rtmpStreamKey: 'rtmp://nginx-rtmp/stream/<?= $roomName; ?>'
                    });

                    console.log('Streaming started');
                } catch (e) {
                    console.error('Failed to start streaming', e);
                }
			});
            api.addListener('readyToClose', () => {
                location.reload();
            });
        </script>