<template>
  <nav>
    <div class="nav-bar">
      <i class='bx bx-menu sidebarOpen' ref="sidebarOpen"></i>
      <div style="display: flex">
        <span class="logo1"><img src="@/assets/logo1.png" style="width: 60px;height: 60px;margin-top: 0px;"></span>
        <span class="logo2"><img src="@/assets/logo2.png" style="margin-top: 10px;"></span>
      </div>
      <div class="menu">
        <div class="logo-toggle">
          <span class="logo"><img src="@/assets/logo1.png" style="width: 70px;height: 70px;margin-top: 10px;"></span>
          <span class="logo3"><img src="@/assets/logo2.png" style="margin-top: 10px;width: 90%;height: 90%;"></span>
          <i class='bx bx-x siderbarClose'></i>
        </div>

        <ul class="nav-links">
          <li><router-link to="/Accueil"><i class="bi bi-house-door"></i>
              Accueil</router-link></li>
          <li><router-link to="/Formations"><i class='bi bi-code-square'></i>
              Formations</router-link></li>
          <li><router-link to="/Certificats"><i class='bi bi-award'></i>
              Certificats</router-link></li>
          <li><router-link to="/Evenements"><i class="bi bi-calendar-event"></i>
              Evenements</router-link></li>
          <li v-if="this.user.user_type != 'participant'"><router-link to="/discussion"><i
                class="bi bi-chat-dots"></i>
              Chat</router-link></li>
          <li>
            <div class="dropdown">
              <a href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell-fill"></i>
                <span class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ this.Notifications.length }}+
                </span>
              </a>
              <ul class="dropdown-menu">
                <li v-for="notification in Notifications" :key="notification.id"><a class="dropdown-item" href="#">{{ notification.description }}</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Voir tous</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </div>
      <div class="darkLight-searchBox affiche">
        <a href="#" class="notification-link">
          <div class="dropdown">
              <a href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell-fill"></i>
                <span class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ this.Notifications.length }}+
                </span>
              </a>
              <ul class="dropdown-menu">
                <li v-for="notification in Notifications" :key="notification.id"><a class="dropdown-item" href="#">{{ notification.description }}</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Voir tous</a></li>
              </ul>
            </div>
        </a>
        <div class="dark-light" ref="modeToggle">
          <i class='bx bx-moon moon'></i>
          <i class='bx bx-sun sun'></i>
        </div>
        <img v-if="this.user.photoProfile !== null" class="photo-profile" :src="require(`@/assets/PhotosProfils/${user.photoProfile}`)" alt=""
        aria-expanded="false" data-bs-toggle="dropdown" style="width: 45px; height: 45px;border-radius: 50%;border: 2px solid #0056d6;">
        <img v-else class="photo-profile" src="@/assets/PhotosProfils/Cyrine_kahweji_11454862.png" alt=""
        aria-expanded="false" data-bs-toggle="dropdown" style="width: 45px; height: 45px;border-radius: 50%;border: 2px solid #0056d6;">
        <ul class="dropdown-menu">
          <li><router-link class="dropdown-item" to="/Profile"><span>Voir profile</span></router-link></li>
          <li v-if="role.nomRole === 'administrateur' || role.nomRole === 'responsablemanager'">
            <hr class="dropdown-divider">
          </li>
          <li ><router-link v-if="role.nomRole === 'administrateur' || role.nomRole === 'responsablemanager'"
              class="dropdown-item" to="/Dashboard">Dashboard</router-link></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li @click="Logout()" class="dropdown-item"><a class="nav-link" href="#">
              <i class="bi bi-door-open"><span>Log out</span></i>
            </a></li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import NotificationService from "@/services/Notification";
import UserService from '@/services/users.js'

export default {
  name: "navbar",
  data() {
    return {
      user: {},
      Notifications:[],
      role: {},
    }
  },
  created() {
    this.loadFromLocalStorage();
    this.getUserRole();
    this.getNotificationUser();
  },
  methods: {
    getUserRole() {
      UserService.getUserRole(this.user.role_id).then(res => {
        this.role = res.data;
      })
    },
    Logout() {
      localStorage.removeItem("user");
      this.$router.push("/");
    },
    loadFromLocalStorage() {
      const userData = localStorage.getItem("user");
      if (userData) {
        this.user = JSON.parse(userData);
      }
    },
    getNotificationUser(){
      NotificationService.getNotificationUser(this.user.id).then((res) =>{
        this.Notifications=res.data;
      })
    },
  },
  mounted() {
    const body = document.querySelector("body"),
      nav = document.querySelector("nav"),
      modeToggle = this.$refs.modeToggle,
      sidebarOpen = this.$refs.sidebarOpen;

    let getMode = localStorage.getItem("mode");
    if (getMode && getMode === "dark-mode") {
      body.classList.add("dark");
    }

    // js code to toggle dark and light mode
    modeToggle.addEventListener("click", () => {
      modeToggle.classList.toggle("active");
      body.classList.toggle("dark");

      // js code to keep user selected mode even page refresh or file reopen
      if (!body.classList.contains("dark")) {
        localStorage.setItem("mode", "light-mode");
      } else {
        localStorage.setItem("mode", "dark-mode");
      }
    });

    //   js code to toggle sidebar
    sidebarOpen.addEventListener("click", () => {
      nav.classList.add("active");
    });

    body.addEventListener("click", e => {
      let clickedElm = e.target;

      if (!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")) {
        nav.classList.remove("active");
      }
    });
  },
};

</script>

<style>
/* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  transition: all 0.4s ease;
  ;
}


/* ===== Colours ===== */
:root {
  --body-color: #ECECEC;
  --nav-color: #4070F4;
  --nav-bar-color: #fff;
  --side-nav: #010718;
  --text-color: #000000;
  --search-bar: #F2F2F2;
  --search-text: #010718;
  --fb-post-border: #088AE9;
  --fb-post-bg: #262728;
  --fb-post-color: #FFFFFF;
  --fb-post: #FFFFFF;
  --fb-post-btn-bg: #3A3B3C;
  --fb-post-btn-color: #FFFFFF;
  --fb-post-btn-bg-hover: #464849;
  --fb-reactions-bg: #3A3B3C;
  --card-color: #ffffff;
  --icon-color: #000;
  --button-bg: transparent;
  --menu-color: #178FEB;
  --bg-img: url("@/assets/bg.jpg");
  --bg-participation: url("@/assets/bgParticipation.png");
  --white: #fff;
  --black: #000;
  --bg: #f8f8f8;
  --grey: #999;
  --dark: #1a1a1a;
  --light: #e6e6e6;
  --blue: #00b0ff;
  --section-color: #ffffff;
  --text-section: #000000;
}

* {
  color: var(--text-color);
}

body {
  height: 100vh;
  background-color: var(--body-color) !important;
}

body.dark {
  --body-color: #18191A;
  --nav-color: #242526;
  --nav-bar-color: #000000;
  --side-nav: #242526;
  --text-color: #fff;
  --search-bar: #242526;
  --card-color: #1c1d1e;
  --icon-color: #000;
  --button-bg: transparent;
  --menu-color: #1c1d1e;
  --bg-img: #303131;
  --text-color: #fff;
  --search-bar: #242526;
  --section-color: #363636;
  --text-section: #ffffff;
  --bg-participation: #303131;
}

nav {
  position: fixed;
  top: 0;
  left: 0;
  height: 80px;
  width: 100%;
  background-color: var(--nav-bar-color);
  z-index: 100;
}

body.dark nav {
  border: 1px solid #393838;
}

.dropdown-menu{
  background-color: var(--nav-bar-color);
  color: var(--text-color);
}

.fab{
  margin-bottom: 10px;
}

.fas{
  margin-bottom: 10px;
}

body.dark .dropdown-menu span:hover{
  background-color: var(--text-color);
  color: var(--nav-bar-color);
}

body.dark .dropdown-menu i:hover{
  background-color: var(--text-color);
  color: var(--nav-bar-color);
}

nav .nav-bar {
  position: relative;
  height: 100%;
  width: 100%;
  background-color: var(--nav-bar-color);
  padding: 0 30px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 2px solid rgb(235 235 235);
}

nav .nav-bar .sidebarOpen {
  color: var(--text-color);
  font-size: 25px;
  padding: 5px;
  cursor: pointer;
  display: none;
}

nav .nav-bar .logo a {
  font-size: 25px;
  font-weight: 500;
  color: var(--text-color);
  text-decoration: none;
}

.menu .logo-toggle {
  display: none;
}

.nav-bar .nav-links {
  display: flex;
  align-items: center;
  padding-top: 15px;
  padding-left: 0px;
}

.nav-bar .nav-links li {
  margin: 0 10px;
  list-style: none;
  display: inline-block;
}

.nav-links li a {
  position: relative;
  font-size: 12px;
  font-weight: 450;
  color: var(--text-color);
  text-decoration: none;
  padding: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.nav-links li img {
  width: 22px;
  height: 22px;
  margin-top: 3px;
  margin-bottom: 5px;
}

.nav-links li i {
  font-size: 20px;
}

.nav-links li:hover a::before {
  opacity: 1;
}

.nav-bar .darkLight-searchBox {
  display: flex;
  align-items: center;
}

.darkLight-searchBox .dark-light,
.darkLight-searchBox .searchToggle {
  height: 40px;
  width: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 5px;
}

.dark-light i,
.searchToggle i {
  position: absolute;
  color: var(--text-color);
  font-size: 22px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.dark-light i.sun {
  opacity: 0;
  pointer-events: none;
}

.dark-light.active i.sun {
  opacity: 1;
  pointer-events: auto;
}

.dark-light.active i.moon {
  opacity: 0;
  pointer-events: none;
}

.searchToggle i.cancel {
  opacity: 0;
  pointer-events: none;
}

.searchToggle.active i.cancel {
  opacity: 1;
  pointer-events: auto;
}

.searchToggle.active i.search {
  opacity: 0;
  pointer-events: none;
}

.searchBox {
  position: relative;
}

.searchBox .search-field {
  position: absolute;
  bottom: -85px;
  right: 5px;
  height: 50px;
  width: 300px;
  display: flex;
  align-items: center;
  background-color: var(--nav-color);
  padding: 3px;
  border-radius: 6px;
  box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s ease;
}

.searchToggle.active~.search-field {
  bottom: -74px;
  opacity: 1;
  pointer-events: auto;
}

.search-field::before {
  content: '';
  position: absolute;
  right: 14px;
  top: -4px;
  height: 12px;
  width: 12px;
  background-color: var(--nav-color);
  transform: rotate(-45deg);
  z-index: -1;
}

.search-field input {
  height: 100%;
  width: 100%;
  padding: 0 45px 0 15px;
  outline: none;
  border: none;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 400;
  color: var(--search-text);
  background-color: var(--search-bar);
}

body.dark .search-field input {
  color: var(--text-color);
}

.search-field i {
  position: absolute;
  color: var(--nav-color);
  right: 15px;
  font-size: 22px;
  cursor: pointer;
}

body.dark .search-field i {
  color: var(--text-color);
}

.affiche .notification-link,
.affiche .searchBox {
  display: none;
}

.information {
  display: none;
}

@media (max-width: 1024px) {

  .nav-bar .logo2,
  .nav-bar .logo4 {
    display: none;
  }
}

@media (max-width: 790px) {
  nav .nav-bar .sidebarOpen {
    display: block;
  }

  .menu {
    position: fixed;
    height: 100%;
    width: 320px;
    left: -100%;
    top: 0;
    padding: 20px;
    background-color: var(--side-nav);
    z-index: 100;
    transition: all 0.4s ease;
  }

  nav.active .menu {
    left: -0%;
  } 

  nav.active .menu i {
    color: white;
  }

  nav.active .nav-bar .navLogo a {
    opacity: 0;
    transition: all 0.3s ease;
  }

  .menu .logo-toggle {
    display: block;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .logo-toggle .siderbarClose {
    color: var(--text-color);
    font-size: 24px;
    cursor: pointer;
  }

  .nav-bar .nav-links {
    display: block;
    padding-top: 30px;
  }

  .nav-links li a {
    display: block;
    margin-top: 20px;
  }

  .affiche .notification-link,
  .affiche .searchBox {
    display: block;
  }

  .nav-links li .notification-link,
  .nav-links li .searchBox {
    display: none;
  }

  .nav-bar .logo2,
  .nav-bar .logo1,
  .nav-bar .logo4 {
    display: none;
  }

  .nav-links li a {
    color: white;
  }

  .information {
    display: block;
  }
}
</style>