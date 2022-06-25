import _ from "lodash";
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

// window.Echo.channel("some-channel").listen(
//     ".Profile\\Events\\UserFollowed",
//     (e) => {
//         alert("foll");
//     }
// );
var authUserId = document.querySelector("#auth-user-id").value;
var notificationNav = document.querySelector("#nav_notification");
window.Echo.private(`user-channel.${authUserId}`)
    .listen(".Notification\\Events\\Seen", (e) => {
        if (notificationNav.textContent > 0) {
            notificationNav.textContent--;
        }
    })
    .listen(".Notification\\Events\\Unseen", (e) => {
        notificationNav.textContent++;
    })
    .listen(".Profile\\Events\\UserFollowed", (e) => {
        notificationNav.textContent++;
    })
    .listen(".Profile\\Events\\UserUnfollowed", (e) => {
        notificationNav.textContent++;
    })
    .listen(".Tweet\\Events\\UserLikedTweet", (e) => {
        notificationNav.textContent++;
    })
    .listen(".Tweet\\Events\\UserUnlikedTweet", (e) => {
        notificationNav.textContent++;
    })
    .listen(".Tweet\\Events\\UserCommentedTweet", (e) => {
        notificationNav.textContent++;
    })
    .listen(".Tweet\\Events\\UserTweeted", (e) => {
        notificationNav.textContent++;
    });
