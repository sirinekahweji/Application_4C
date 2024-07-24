<template>
  <div>
    <navBar></navBar>
    <div class="app">
      <div class="wrapper">
        <div class="conversation-area">
          <div v-for="(personne, index) in people" :key="personne.id" class="msg online"
            @click="setActivePerson(index)">
            <img class="msg-profile" :src="getImageSource(personne.photoProfile)" alt="" />
            <div class="msg-detail">
              <div class="msg-username">{{ personne.prenom + ' ' + personne.nom }}</div>
            </div>
          </div>
          <div class="overlay"></div>
        </div>
        <div class="chat-area" style="background-color: white;">
          <div class="chat-area-header" style="background-color: white;">
            <div class="chat-area-title">{{ people[activePerson].prenom + ' ' + people[activePerson].nom }}</div>
            <!-- <div class="chat-area-group">
              <img class="chat-area-profile" src="../assets/amine.jpg" alt="" />
              <img class="chat-area-profile" src="../assets/both.jpg" alt="">
              <img class="chat-area-profile" src="../assets/mourad.png" alt="" />
              <span>+4</span>
            </div> -->
          </div>
          <div class="chat-area-main">
            <div v-for="chat in chats" :key="chat.id">
              <div v-if="chat.emmetteur_id == idUser || chat.user_id == idUser">
                <div class="chat-msg owner">
                  <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="../assets/logo4c.png" alt="" />
                    <div class="chat-msg-date">{{ formatDate(chat.created_at) }}</div>
                  </div>
                  <div class="chat-msg-content">
                    <div class="chat-msg-text">{{ chat.message }}
                    </div>
                  </div>
                </div>
              </div>
              <div v-else>
                <div class="chat-msg">
                  <div class="chat-msg-profile">
                    <img class="chat-msg-img" src="../assets/amine.jpg" alt="" />
                    <div class="chat-msg-date">{{ formatDate(chat.created_at) }}</div>
                  </div>
                  <div class="chat-msg-content">
                    <div class="chat-msg-text">{{ chat.message }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="chat-area-footer">
            <form @submit.prevent="addMessage(people[activePerson].id)">
              <input v-model="messageContent" type="text" placeholder="Type something here..." />
              <button type="submit" class="feather feather-smile" style="border: none; background: none; padding: 0; margin: 0;"><svg
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="22" y1="2" x2="11" y2="13"></line>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg></button>
            </form>
          </div>
        </div>
        <div class="detail-area">
          <div class="detail-area-header">
            <div class="msg-profile group">
              <img :src="getImageSource(people[activePerson].photoProfile)" alt="">
            </div>
            <div class="detail-title">{{ people[activePerson].prenom + ' ' + people[activePerson].nom }}</div>
            <!-- <div class="detail-subtitle">Created by Naima, 1 May 2024</div> -->

          </div>


        </div>
      </div>
    </div>

  </div>

</template>

<script>
import navBar from "@/components/navbar.vue";
import discussionServices from "@/services/discussion.js";
import moment from 'moment';

export default {
  name: "app",
  components: {
    navBar
  },
  data() {
    return {
      people: [
        {
          "id": 0,
          "nom": "Managers",
          "prenom": "Group",
          "phoneNumber": null,
          "cin": null,
          "code_qr": "null",
          "photoProfile": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiJ_6TV2M4ohF3OELEW6myz3I9iTFob0d2rvoe6tf8Ig&s",
          "photoCouverture": "null",
          "genre": 1,
          "lienLinkdIn": null,
          "adresse": null,
          "Gouvernorat": null,
          "acces": 1,
          "user_type": null,
          "corbeille": null,
          "role_id": null,
          "email": null,
          "created_at": null,
        },
      ],
      chats: [],
      activePerson: 0,
      isHidden: true,
      idUser: 0,
      user: {},
      messageContent: '',
    };
  },
  mounted() {
    this.initializeChat();
  },
  created() {
    this.loadFromLocalStorage();
    this.getManagers();
    this.getMessages();
    this.GetMessagesGroup();
  },
  methods: {
    /*getImageSourceUser(id){
      discussionServices.getUser(id).then(res=>(
        
      ));
    },*/
    addMessage(recepteur_id) {
      if (recepteur_id != 0) {
        let message = {
          message: this.messageContent,
          emmetteur_id: this.user.id,
          recepteur_id: recepteur_id,
        };

        discussionServices.addMessage(message).then(() => {
          this.messageContent = '';
          this.getMessages();
        })
          .catch((error) => {
            console.error("Erreur lors de l'ajout du commentaire :", error);
          });
      }
      else {
        let message = {
          message: this.messageContent,
          user_id: this.user.id,
        };

        discussionServices.AddMessageGroup(message).then(() => {
          this.messageContent = '';
          this.getMessages();
        })
          .catch((error) => {
            console.error("Erreur lors de l'ajout du commentaire :", error);
          });
      }

    },
    loadFromLocalStorage() {
      const userData = localStorage.getItem("user");
      if (userData) {
        this.user = JSON.parse(userData);
        this.idUser = this.user.id;
      }
    },
    formatDate(created_at) {
      return moment(created_at).fromNow();
    },
    getImageSource(image) {
      // Check if the image is an external URL
      if (image.startsWith('http://') || image.startsWith('https://')) {
        return image;
      } else {
        // Treat it as a local path
        //console.log(image);
        return require(`@/assets/PhotosProfils/${image}`)
      }
    },

    GetMessagesGroup() {

    },
    getManagers() {
      discussionServices.getManagers(this.idUser).then((res) => {
        this.people.push(...res.data);
      }).catch((error) => {
        console.error('Error fetching messages:', error);
      });
    },
    getMessages() {
      if (this.activePerson != 0) {
        discussionServices.getMessages(this.idUser, this.people[this.activePerson].id).then((res) => {
          this.chats = res.data;
        }).catch((error) => {
          console.error('Error fetching messages:', error);
        });
      }
      else {
        discussionServices.GetMessagesGroup().then((res) => {
          this.chats = res.data;
        }).catch((error) => {
          console.error('Error fetching messages:', error);
        });
      }
    },
    refreche() {
      this.getMessages();
    },
    toggleVisibility() {
      this.isHidden = !this.isHidden;
    },
    setActivePerson(personId) {
      this.activePerson = personId;
      this.getMessages();
    },
    initializeChat() {
      const chatMessagesRef = this.$refs.chatMessages;
      if (chatMessagesRef && chatMessagesRef.$el) {
        const peopleList = this.$refs.peopleList;
        const peopleItems = peopleList.querySelectorAll('.person');

        peopleItems.forEach(person => {
          person.addEventListener('mousedown', () => {
            if (!person.classList.contains('active')) {
              this.setActiveChat(person);
            }
          });
        });
      }
    },
    setActiveChat(personElement) {
      const chatElements = this.$refs.chatMessages.$el.querySelectorAll('.chat');
      const personId = personElement.dataset.chat;

      chatElements.forEach(chat => chat.classList.remove('active-chat'));

      const selectedChatElement = this.$refs.chatMessages.$el.querySelector(`[data-chat="${personId}"]`);
      selectedChatElement.classList.add('active-chat');

      const nameElement = this.$refs.chatMessages.$el.querySelector('.top .name');
      const personName = personElement.querySelector('.name').innerText;
      nameElement.innerHTML = personName;

      this.activePerson = this.people.find(person => person.id === personId);
    }
  },
};
</script>

<style scoped>
@charset "UTF-8";
@import url("https://fonts.googleapis.com/css?family=Manrope:300,400,500,600,700&display=swap&subset=latin-ext");

:root {
  --body-bg-color: #e5ecef;
  --theme-bg-color: #fff;
  --settings-icon-hover: #9fa7ac;
  --developer-color: #f9fafb;
  --input-bg: #f8f8fa;
  --input-chat-color: #a2a2a2;
  --border-color: #eef2f4;
  --body-font: "Manrope", sans-serif;
  --body-color: #273346;
  --settings-icon-color: #c1c7cd;
  --msg-message: #969eaa;
  --chat-text-bg: #f1f2f6;
  --theme-color: #0086ff;
  --msg-date: #c0c7d2;
  --button-bg-color: #f0f7ff;
  --button-color: var(--theme-color);
  --detail-font-color: #919ca2;
  --msg-hover-bg: rgba(238, 242, 244, 0.4);
  --active-conversation-bg: linear-gradient(to right,
      rgba(238, 242, 244, 0.4) 0%,
      rgba(238, 242, 244, 0) 100%);
  --overlay-bg: linear-gradient(to bottom,
      rgba(255, 255, 255, 0) 0%,
      rgba(255, 255, 255, 1) 65%,
      rgba(255, 255, 255, 1) 100%);
  --chat-header-bg: linear-gradient(to bottom,
      rgba(255, 255, 255, 1) 0%,
      rgba(255, 255, 255, 1) 78%,
      rgba(255, 255, 255, 0) 100%);
}

[data-theme=purple] {
  --theme-color: #9f7aea;
  --button-color: #9f7aea;
  --button-bg-color: rgba(159, 122, 234, 0.12);
}

[data-theme=green] {
  --theme-color: #38b2ac;
  --button-color: #38b2ac;
  --button-bg-color: rgba(56, 178, 171, 0.15);
}

[data-theme=orange] {
  --theme-color: #ed8936;
  --button-color: #ed8936;
  --button-bg-color: rgba(237, 137, 54, 0.12);
}

.dark-mode {
  --body-bg-color: #1d1d1d;
  --theme-bg-color: #27292d;
  --border-color: #323336;
  --body-color: #d1d1d2;
  --active-conversation-bg: linear-gradient(to right,
      rgba(47, 50, 56, 0.54),
      rgba(238, 242, 244, 0) 100%);
  --msg-hover-bg: rgba(47, 50, 56, 0.54);
  --chat-text-bg: #383b40;
  --chat-text-color: #b5b7ba;
  --msg-date: #626466;
  --msg-message: var(--msg-date);
  --overlay-bg: linear-gradient(to bottom,
      rgba(0, 0, 0, 0) 0%,
      #27292d 65%,
      #27292d 100%);
  --input-bg: #2f3236;
  --chat-header-bg: linear-gradient(to bottom,
      #27292d 0%,
      #27292d 78%,
      rgba(255, 255, 255, 0) 100%);
  --settings-icon-color: #7c7e80;
  --developer-color: var(--border-color);
  --button-bg-color: #393b40;
  --button-color: var(--body-color);
  --input-chat-color: #6f7073;
  --detail-font-color: var(--input-chat-color);
}

.blue {
  background-color: #0086ff;
}

.purple {
  background-color: #9f7aea;
}

.green {
  background-color: #38b2ac;
}

.orange {
  background-color: #ed8936;
}

* {
  outline: none;
  box-sizing: border-box;
}

* {
  color: black;
}

img {
  max-width: 100%;
}

body {
  background-color: var(--body-bg-color);
  font-family: var(--body-font);
  color: var(--body-color);
}

html {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
}

.app {
  display: flex;
  flex-direction: column;
  background-color: var(--theme-bg-color);
  max-width: 1600px;
  height: 100vh;
  margin: 0 auto;
  overflow: hidden;
  padding-top: 80px;
}

.header {
  height: 80px;
  width: 100%;
  border-bottom: 1px solid var(--border-color);
  display: flex;
  align-items: center;
  padding: 0 20px;
}

.wrapper {
  width: 100%;
  display: flex;
  flex-grow: 1;
  overflow: hidden;
}

.conversation-area,
.detail-area {
  width: 340px;
  flex-shrink: 0;
  background-color: white;
}

.detail-area {
  border-left: 1px solid black;
  margin-left: auto;
  padding: 30px 30px 0 30px;
  display: flex;
  flex-direction: column;
  overflow: auto;
}

.chat-area {
  flex-grow: 1;
}

.search-bar {
  height: 80px;
  z-index: 3;
  position: relative;
  margin-left: 280px;
}

.search-bar input {
  height: 100%;
  width: 100%;
  display: block;
  background-color: transparent;
  border: none;
  color: var(--body-color);
  padding: 0 54px;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56.966 56.966' fill='%23c1c7cd'%3e%3cpath d='M55.146 51.887L41.588 37.786A22.926 22.926 0 0046.984 23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92 2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 00.083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-size: 16px;
  background-position: 25px 48%;
  font-family: var(--body-font);
  font-weight: 600;
  font-size: 15px;
}

.search-bar input::placeholder {
  color: var(--input-chat-color);
}

.logo {
  color: var(--theme-color);
  width: 38px;
  flex-shrink: 0;
}

.logo svg {
  width: 100%;
}

.user-settings {
  display: flex;
  align-items: center;
  cursor: pointer;
  margin-left: auto;
  flex-shrink: 0;
}

.user-settings>*+* {
  margin-left: 14px;
}

.dark-light {
  width: 22px;
  height: 22px;
  color: var(--settings-icon-color);
  flex-shrink: 0;
}

.dark-light svg {
  width: 100%;
  fill: transparent;
  transition: 0.5s;
}

.user-profile {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.settings {
  color: var(--settings-icon-color);
  width: 22px;
  height: 22px;
  flex-shrink: 0;
}

.conversation-area {
  border-right: 1px solid black;
  overflow-y: auto;
  overflow-x: hidden;
  display: flex;
  flex-direction: column;
  position: relative;
}

.msg-profile {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 15px;
}

.msg-profile.group {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: var(--border-color);
}

.msg-profile.group svg {
  width: 60%;
}

.msg {
  display: flex;
  align-items: center;
  padding: 20px;
  cursor: pointer;
  transition: 0.2s;
  position: relative;
}

.msg:hover {
  background-color: var(--msg-hover-bg);
}

.msg.active {
  background: var(--active-conversation-bg);
  border-left: 4px solid var(--theme-color);
}

.msg.online:before {
  content: "";
  position: absolute;
  background-color: #23be7e;
  width: 9px;
  height: 9px;
  border-radius: 50%;
  border: 2px solid var(--theme-bg-color);
  left: 50px;
  bottom: 19px;
}

.msg-username {
  margin-bottom: 4px;
  font-weight: 600;
  font-size: 15px;
}

.msg-detail {
  overflow: hidden;
}

.msg-content {
  font-weight: 500;
  font-size: 13px;
  display: flex;
}

.msg-message {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  color: var(--msg-message);
}

.msg-date {
  font-size: 14px;
  color: var(--msg-date);
  margin-left: 3px;
}

.msg-date:before {
  content: "•";
  margin-right: 2px;
}

.add {
  position: sticky;
  bottom: 25px;
  background-color: #3ea5ff;
  width: 60px;
  height: 60px;
  border: 0;
  border-radius: 50%;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-plus'%3e%3cpath d='M12 5v14M5 12h14'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: 50%;
  background-size: 28px;
  box-shadow: 0 0 16px var(--theme-color);
  margin: auto auto -55px;
  flex-shrink: 0;
  z-index: 1;
  cursor: pointer;
}

.overlay {
  position: sticky;
  bottom: 0;
  left: 0;
  width: 340px;
  flex-shrink: 0;
  background: var(--overlay-bg);
  height: 80px;
}

.chat-area {
  display: flex;
  flex-direction: column;
  overflow: auto;
}

.chat-area-header {
  display: flex;
  position: sticky;
  top: 0;
  left: 0;
  z-index: 2;
  width: 100%;
  align-items: center;
  justify-content: space-between;
  padding: 20px;
  background: var(--chat-header-bg);
}

.chat-area-profile {
  height: 32px;
  width: 32px;
  border-radius: 50%;
  object-fit: cover;
}

.chat-area-title {
  font-size: 18px;
  font-weight: 600;
}

.chat-area-main {
  flex-grow: 1;
  display: flex;
  flex-direction: column-reverse;
}

.chat-area-main {
  overflow-y: auto;
  height: 100%;
  /* Adjust based on your layout */
}

.chat-msg-img {
  height: 40px;
  width: 40px;
  border-radius: 50%;
  object-fit: cover;
}

.chat-msg-profile {
  flex-shrink: 0;
  margin-top: auto;
  margin-bottom: -20px;
  position: relative;
}

.chat-msg-date {
  position: absolute;
  left: calc(100% + 12px);
  bottom: 0;
  font-size: 12px;
  font-weight: 600;
  color: var(--msg-date);
  white-space: nowrap;
}

.chat-msg {
  display: flex;
  padding: 0 20px 45px;
}

.chat-msg-content {
  margin-left: 12px;
  max-width: 70%;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.chat-msg-text {
  background-color: #efefef;
  padding: 15px;
  border-radius: 20px 20px 20px 0;
  line-height: 1.5;
  font-size: 14px;
  font-weight: 500;
}

.chat-msg-text+.chat-msg-text {
  margin-top: 10px;
}

.chat-msg-text {
  color: var(--chat-text-color);
}

.owner {
  flex-direction: row-reverse;
}

.owner .chat-msg-content {
  margin-left: 0;
  margin-right: 12px;
  align-items: flex-end;
}

.owner .chat-msg-text {
  background-color: #3ea5ff;
  color: #fff;
  border-radius: 20px 20px 0 20px;
}

.owner .chat-msg-date {
  left: auto;
  right: calc(100% + 12px);
}

.chat-msg-text img {
  max-width: 300px;
  width: 100%;
}

.chat-area-footer {
  display: flex;
  border-top: 1px solid #e8e8e8;
  width: 100%;
  padding: 10px 20px;
  align-items: center;
  background-color: white;
  position: sticky;
  bottom: 0;
  left: 0;
}

.chat-area-footer form {
  display: flex;
  width: 100%;
}

.chat-area-footer form svg {
  color: var(--settings-icon-color);
  width: 20px;
  flex-shrink: 0;
  cursor: pointer;
}

.chat-area-footer form svg:hover {
  color: var(--settings-icon-hover);
}

.chat-area-footer form svg+svg {
  margin-left: 12px;
}

.chat-area-footer form input {
  border: none;
  color: #424242;
  background-color: var(--input-bg);
  padding: 12px;
  border-radius: 6px;
  font-size: 15px;
  margin: 0 12px;
  width: 100%;
}

.chat-area-footer form input::placeholder {
  color: var(--input-chat-color);
}

.detail-area-header {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.detail-area-header .msg-profile {
  margin-right: 0;
  width: 60px;
  height: 60px;
  margin-bottom: 15px;
}

.detail-title {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 10px;
}

.detail-subtitle {
  font-size: 12px;
  font-weight: 600;
  color: var(--msg-date);
}

.detail-button {
  border: 0;
  background-color: var(--button-bg-color);
  padding: 10px 14px;
  border-radius: 5px;
  color: var(--button-color);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  flex-grow: 1;
  font-weight: 500;
}

.detail-button svg {
  width: 18px;
  margin-right: 10px;
}

.detail-button:last-child {
  margin-left: 8px;
}

.detail-buttons {
  margin-top: 20px;
  display: flex;
  width: 100%;
}

.detail-area input {
  background-color: transparent;
  border: none;
  width: 100%;
  color: rgb(99, 99, 99);
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56.966 56.966' fill='%23c1c7cd'%3e%3cpath d='M55.146 51.887L41.588 37.786A22.926 22.926 0 0046.984 23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92 2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 00.083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-size: 16px;
  background-position: 100%;
  font-family: var(--body-font);
  font-weight: 600;
  font-size: 14px;
  border-bottom: 1px solid var(--border-color);
  padding: 14px 0;
}

.detail-area input::placeholder {
  color: var(--detail-font-color);
}

.detail-changes {
  margin-top: 40px;
}

.detail-change {
  color: var(--detail-font-color);
  font-family: var(--body-font);
  font-weight: 600;
  font-size: 14px;
  border-bottom: 1px solid var(--border-color);
  padding: 14px 0;
  display: flex;
}

.detail-change svg {
  width: 30px;
  margin-left: auto;
}

.colors {
  display: flex;
  margin-left: auto;
}

.color {
  width: 16px;
  height: 16px;
  border-radius: 50%;
  cursor: pointer;
}

.color.selected {
  background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' stroke='%23fff' stroke-width='3' fill='none' stroke-linecap='round' stroke-linejoin='round' class='css-i6dzq1' viewBox='0 0 24 24'%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");
  background-size: 10px;
  background-position: center;
  background-repeat: no-repeat;
}

.color:not(:last-child) {
  margin-right: 4px;
}

.detail-photo-title {
  display: flex;
  align-items: center;
}

.detail-photo-title svg {
  width: 16px;
}

.detail-photos {
  margin-top: 30px;
  text-align: center;
}

.detail-photo-title {
  color: var(--detail-font-color);
  font-weight: 600;
  font-size: 14px;
  margin-bottom: 20px;
}

.detail-photo-title svg {
  margin-right: 8px;
}

.detail-photo-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-column-gap: 6px;
  grid-row-gap: 6px;
  grid-template-rows: repeat(3, 60px);
}

.detail-photo-grid img {
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 8px;
  object-position: center;
}

.view-more {
  color: var(--theme-color);
  font-weight: 600;
  font-size: 15px;
  margin: 25px 0;
}

.follow-me {
  text-decoration: none;
  font-size: 14px;
  width: calc(100% + 60px);
  margin-left: -30px;
  display: flex;
  align-items: center;
  margin-top: auto;
  overflow: hidden;
  color: #9c9cab;
  padding: 0 20px;
  height: 52px;
  flex-shrink: 0;
  position: relative;
  justify-content: center;
}

.follow-me svg {
  width: 16px;
  height: 16px;
  margin-right: 8px;
}

.follow-text {
  display: flex;
  align-items: center;
  transition: 0.3s;
}

.follow-me:hover .follow-text {
  transform: translateY(100%);
}

.follow-me:hover .developer {
  top: 0;
}

.developer {
  position: absolute;
  color: var(--detail-font-color);
  font-weight: 600;
  left: 0;
  top: -100%;
  display: flex;
  transition: 0.3s;
  padding: 0 20px;
  align-items: center;
  justify-content: center;
  background-color: var(--developer-color);
  width: 100%;
  height: 100%;
}

.developer img {
  border-radius: 50%;
  width: 26px;
  height: 26px;
  object-fit: cover;
  margin-right: 10px;
}

.dark-mode .search-bar input,
.dark-mode .detail-area input {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56.966 56.966' fill='%236f7073'%3e%3cpath d='M55.146 51.887L41.588 37.786A22.926 22.926 0 0046.984 23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92 2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 00.083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z'/%3e%3c/svg%3e");
}

.dark-mode .dark-light svg {
  fill: #ffce45;
  stroke: #ffce45;
}

.dark-mode .chat-area-group span {
  color: #d1d1d2;
}

.chat-area-group {
  flex-shrink: 0;
  display: flex;
}

.chat-area-group * {
  border: 2px solid var(--theme-bg-color);
}

.chat-area-group *+* {
  margin-left: -5px;
}

.chat-area-group span {
  width: 32px;
  height: 32px;
  background-color: var(--button-bg-color);
  color: var(--theme-color);
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px;
  font-weight: 500;
}

@media (max-width: 1120px) {
  .detail-area {
    display: none;
  }
}

@media (max-width: 780px) {
  .conversation-area {
    display: none;
  }

  .search-bar {
    margin-left: 0;
    flex-grow: 1;
  }

  .search-bar input {
    padding-right: 10px;
  }
}
</style>