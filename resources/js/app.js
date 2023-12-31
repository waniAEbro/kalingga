import * as Ably from 'ably';
import { Notyf } from 'notyf'

const toastr = new Notyf({
    duration: 3000,
    dismissible: true,
    ripple: true,
    position: {
        x: 'right',
        y: 'top',
    },
});

var realtime = new Ably.Realtime('f-eOvQ.531lyg:rYnJ7AxwNX3q7RlLJTLwpFdav5ybFJMhuYV6bVf90I8');
var channel_in = realtime.channels.get('channel-in');
channel_in.subscribe(function (message) {
    toastr.success(message.data.product + " berhasil masuk gudang")
});
var channel_out = realtime.channels.get('channel-out');
channel_out.subscribe(function (message) {
    toastr.error(message.data.product + " keluar gudang")
});