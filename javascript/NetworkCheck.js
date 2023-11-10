// selecting all required elements

let notification = document.querySelector(".notification-Field")
let toast = notification.querySelector(".toast");
let wifiIcon = notification.querySelector(".icon");
let title = notification.querySelector("span");
let subTitle = notification.querySelector("p");
let closeIcone = notification.querySelector(".close-icon");

window.onload = () => {
  function ajax() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "https://jsonplaceholder.typicode.com/posts", true);
    xhr.onload = () => {
      //once ajax loaded
      if (xhr.status == 200 && xhr.status < 300) {
        online();
      } else {
        offline();
      }
    };
    xhr.onerror = () => {
      // if the passed url is incorrect or returning 404
      offline(); //calling offline function
    };
    xhr.send();
  }

  function online() {
    //user getting data then he is online
    toast.classList.remove("offline");
    title.innerText = "You are online now";
    subTitle.innerText = "Hurray! Internet is connected.";
    wifiIcon.innerHTML = '<i class="uil uil-wifi"></i>';

    closeIcone.onclick = () => {
      notification.classList.add("hide");
    };

    setTimeout(() => {
      notification.classList.add("hide");
    }, 5000);
  }


  function offline() {
    // creating offline function
    notification.classList.remove("hide");
    toast.classList.add("offline");
    title.innerText = "You're offline now";
    subTitle.innerText = "Opps! Internet is disconnected.";
    wifiIcon.innerHTML = '<i class="uil uil-wifi-slash"></i>';
  }

  
  setInterval(() => {
    ajax();
  }, 100);
};
