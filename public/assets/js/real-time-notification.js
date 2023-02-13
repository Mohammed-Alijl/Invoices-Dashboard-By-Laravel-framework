var notificationsContainer = document.getElementById("notifications-container");
var unreadNotifications = document.getElementById("notification-count");
var bell = document.getElementById("bell");
// Establish a connection to Pusher

const pusher = new Pusher('ef9c95ec243dbea733cd', {
    cluster: 'ap2',
    encrypted: true
});
// Subscribe to a channel
var channel = pusher.subscribe('new-notification');
// Listen for events on the channel
channel.bind("App\\Events\\NewNotification", function(data) {
    var mainNotificationList = document.querySelector(".main-notification-list");
    var textCenter = mainNotificationList.querySelector(".text-center");
    if (textCenter) {
        textCenter.remove();
        const span = document.createElement("span");
        span.classList.add("pulse");

        const svg = bell.querySelector("svg");
        bell.insertBefore(span, svg);
    }

    var notification = document.createElement("a");
    notification.classList.add("d-flex", "p-3", "border-bottom");
    notification.href = data.url;

    var imageContainer = document.createElement("div");
    imageContainer.classList.add("drop-img", "cover-image");
    imageContainer.dataset.imageSrc = data.image;
    imageContainer.style.background = "url(" + data.image + ") center center";
    notification.appendChild(imageContainer);

    var contentContainer = document.createElement("div");
    contentContainer.classList.add("mr-3");
    notification.appendChild(contentContainer);

    var title = document.createElement("h5");
    title.classList.add("notification-label", "mb-1");
    title.innerText = data.title;
    contentContainer.appendChild(title);

    var time = document.createElement("div");
    time.classList.add("notification-subtext");
    time.innerText = data.time;
    contentContainer.appendChild(time);

    var arrowContainer = document.createElement("div");
    arrowContainer.classList.add("mr-auto");
    notification.appendChild(arrowContainer);

    var arrow = document.createElement("i");
    arrow.classList.add("las", "la-angle-left", "text-left", "text-muted");
    arrowContainer.appendChild(arrow);

    notificationsContainer.insertBefore(notification, notificationsContainer.firstChild);
    unreadNotifications.innerText = (parseInt(unreadNotifications.innerText.match(/\d+/)) + 1);
});
