let notification = document.getElementById("notification-Field");
let toast = document.getElementById("toast");
let wifiIcon = document.getElementById("icon");
let title = document.getElementById("span");
let subTitle = document.getElementById("p");
let closeIcone = document.getElementById("close-icon");

// Function to check network status
async function checkNetworkStatus() {
  try {
    let response = await fetch("https://jsonplaceholder.typicode.com/posts");
    if (!response.ok) {
      // Status is not OK, user is offline
      offline();
    }
  } catch (error) {
    // Error occurred, user is offline
    offline();
  }
}

function offline() {
  // Online status changed from online to offline
  notification.classList.remove("hide");
  toast.style.display = "flex"
  toast.classList.add("offline");
  title.innerText = "You're offline now";
  subTitle.innerText = "Opps! Internet is disconnected.";
  wifiIcon.innerHTML = '<i class="uil uil-wifi-slash"></i>';

  closeIcone.onclick = () => {
    notification.classList.add("hide");
  };

  setTimeout(() => {
    notification.classList.add("hide");
  }, 5000);
}

// Check network status on page load
checkNetworkStatus();

// Set up an event listener for page visibility change
document.addEventListener("visibilitychange", () => {
  if (document.visibilityState === "visible") {
    // Page is visible, no need to check network status again
  }
});
