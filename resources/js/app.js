import './bootstrap';
import Echo from "laravel-echo";
import Pusher from "pusher-js";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.channel("chat-channel")
    .listen(".message.received", (data) => {
        let chatBox = document.getElementById('chatBox');
        chatBox.innerHTML += `<p class="text-left text-gray-700"><strong>IA:</strong> ${data.message}</p>`;
        chatBox.scrollTop = chatBox.scrollHeight;
    });