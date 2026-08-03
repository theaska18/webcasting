<!DOCTYPE html>
    <html>
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='https://cast.ckamal.com/external_api.js'></script>
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
      </head>
      <body>
        <div id="video-meet" ref="apiRef" />
        <script>
          const domain = 'cast.ckamal.com';
          const options = {
            roomName: 'test',
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
            },
            configOverwrite:{
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
            rtmpStreamKey: 'rtmp://nginx-rtmp/stream/test'
        });

        console.log('Streaming started');
    } catch (e) {
        console.error('Failed to start streaming', e);
    }
			});
        </script>
      </body>
    </html>