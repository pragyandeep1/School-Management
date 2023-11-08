// resources/js/jitsi.js
document.addEventListener('DOMContentLoaded', function () {
    const domain = 'meet.jit.si';
    const options = {
        roomName: 'JitsiMeetAPIExample',
        width: 700,
        height: 700,
        parentNode: document.querySelector('#meet'),
		lang: 'en',
        interfaceConfigOverwrite: {
            TOOLBAR_BUTTONS: ['microphone', 'camera', 'chat', 'raisehand', 'hangup'],
        },
    };
    const api = new JitsiMeetExternalAPI(domain, options);
});
