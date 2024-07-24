<template>
    <div class="right col-md-9" v-if="!isHidden">
        <div class="top">
            <i class="bi bi-arrow-left-circle" @click="toggleVisibility"></i>
            <span>To: <span class="name">{{ people.prenom }} {{ people.nom }}</span></span>
        </div>
        <div class="chat active-chat">
            <div v-for="chat in chats" :key="chat.id">
                <div v-if="chat.emmetteur_id == 13 || chat.user_id == 1" class="bubble me">
                    {{ chat.message }}
                </div>
                <div v-else class="bubble you">
                    {{ chat.message }}
                </div>
            </div>
            <div class="conversation-start">
                <span>{{ people.timestamp }}</span>
            </div>
        </div>
        <div class="write">
            <form @submit.prevent="addMessage(people.id)">
                <input type="text" v-model="messageContent">
                <button type="submit" class="write-link send" style="border :none"></button>
            </form>
        </div>
    </div>
</template>

<script>
import discussionServices from "@/services/discussion.js";

export default {
    props: {
        people: Object,
        chats: Object,
        isHidden: Boolean,
    },
    data() {
        return {
            messageContent: '',
        }
    },
    methods: {
        toggleVisibility() {
            this.$emit('toggle-visibility');
        },
        refreche() {
            this.$emit('refreche');
        },
        addMessage(recepteur_id) {
            if (recepteur_id != 0) {
                let message = {
                    message: this.messageContent,
                    emmetteur_id: 13,
                    recepteur_id: recepteur_id,
                };

                discussionServices.addMessage(message).then(() => {
                    this.messageContent = '';
                    this.refreche();
                })
                    .catch((error) => {
                        console.error("Erreur lors de l'ajout du commentaire :", error);
                    });
            }
            else {
                let message = {
                    message: this.messageContent,
                    user_id : 1,
                };

                discussionServices.AddMessageGroup(message).then(() => {
                    this.messageContent = '';
                    this.refreche();
                })
                    .catch((error) => {
                        console.error("Erreur lors de l'ajout du commentaire :", error);
                    });
            }

        }
    },
};
</script>
<style scoped>
section {
    padding-top: 80px;
}

ul {
    list-style-type: none;
    padding-left: 5px;
}

body {
    background-color: var(--nav-bar-color);
}

.wrapper .left {
    border-right: 1px solid var(--text-color);
}

.wrapper .left .top {
    position: relative;
    width: 100%;
    height: 96px;
    padding: 30px;
    color: var(--text-color);
}

.wrapper .left .top:after {
    position: absolute;
    bottom: 0;
    display: block;
    height: 1px;
    content: "";
    background-color: var(--nav-bar-color);
}

.wrapper .left input {
    float: left;
    width: 200px;
    height: 42px;
    padding: 0 15px;
    border: 1px solid var(--light);
    background-color: #eceff1;
    border-radius: 21px;
}

.wrapper .left a.search {
    display: block;
    float: left;
    width: 42px;
    height: 42px;
    margin-left: 10px;
    border: 1px solid var(--light);
    background-color: var(--blue);
    background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/name-type.png");
    background-repeat: no-repeat;
    background-position: top 12px left 14px;
    border-radius: 50%;
}

.wrapper .left .people {
    margin-left: -1px;
    width: calc(100% + 2px);
}

.wrapper .left .people .person {
    position: relative;
    width: 100%;
    padding: 12px 10% 16px 5px;
    cursor: pointer;
}

.wrapper .left .people .person:after {
    position: absolute;
    bottom: 0;
    left: 50%;
    display: block;
    width: 80%;
    height: 1px;
    content: "";
    background-color: var(--light);
    transform: translate(-50%, 0);
}

.wrapper .left .people .person img {
    float: left;
    width: 40px;
    height: 40px;
    margin-right: 12px;
    border-radius: 50%;
    object-fit: cover;
}

.wrapper .left .people .person .name {
    font-size: 14px;
    line-height: 22px;
    color: var(--text-color);
}

.wrapper .left .people .person .time {
    font-size: 14px;
    position: absolute;
    top: 16px;
    right: 10%;
    padding: 0 0 5px 5px;
    color: var(--grey);
}

.wrapper .left .people .person .preview {
    font-size: 14px;
    display: inline-block;
    overflow: hidden !important;
    width: 70%;
    white-space: nowrap;
    text-overflow: ellipsis;
    color: var(--grey);
}

.wrapper .left .people .person.active,
.wrapper .left .people .person:hover {
    margin-top: -1px;
    margin-left: -1px;
    padding-top: 13px;
    border: 0;
    background-color: var(--blue);
    width: calc(100% + 2px);
    padding-left: calc(10% + 1px);
}

.wrapper .left .people .person.active span,
.wrapper .left .people .person:hover span {
    color: var(--white);
    background: transparent;
}

.wrapper .left .people .person.active:after,
.wrapper .left .people .person:hover:after {
    display: none;
}

.wrapper .right {
    position: relative;
    float: left;
    height: 100%;
    background-color: white;
}

.wrapper .right .top {
    width: 100%;
    height: 47px;
    padding: 15px 29px;
    position: fixed;
}

.wrapper .right .top span {
    font-size: 15px;
    color: var(--grey);
}

.wrapper .right .top span .name {
    color: var(--text-color);
}

.wrapper .right .chat {
    position: fixed;
    display: none;
    padding: 10px 35px 0px;
    border-width: 1px 0px 1px 0;
    border-style: solid;
    border-color: var(--light);
    flex-direction: column-reverse;
    width: 75%;
    height: 70%;
    bottom: 70px;
    overflow-y: auto;
}

.wrapper .right .chat.active-chat {
    display: block;
    display: flex;
}

.wrapper .right .chat.active-chat .bubble {
    transition-timing-function: cubic-bezier(0.4, -0.04, 1, 1);
}

.wrapper .write {
    position: fixed;
    bottom: 20px;
    /* Adjusted to be 20px above the bottom */
    height: 42px;
    padding-left: 8px;
    border: 1px solid var(--light);
    background-color: white;
    width: 73%;
    border-radius: 5px;
}


.wrapper .write input {
    font-size: 16px;
    float: left;
    width: 94%;
    height: 40px;
    padding: 0 10px;
    color: var(--dark);
    border: 0;
    outline: none;
    bottom: 0;
}

.wrapper .write .write-link.attach:before {
    display: inline-block;
    width: 20px;
    height: 39px;
    content: "";
    background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/attachment.png");
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
    background-color: white;
    position: relative;
    top: -1px;
    margin-right: 10px;
}

.wrapper .write .write-link.send:before {
    display: inline-block;
    width: 20px;
    height: 40px;
    margin-left: 0px;
    content: "";
    background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/send.png");
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
    background-color: white;
    position: relative;
}

body.dark .wrapper .write .write-link.send:before {
    display: inline-block;
    width: 20px;
    height: 32px;
    margin-left: 0px;
    margin-top: 3px;
    content: "";
    background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/send.png");
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
    background-color: white;
    position: relative;
}

.wrapper .bubble {
    font-size: 16px;
    position: relative;
    display: inline-block;
    clear: both;
    margin-bottom: 8px;
    padding: 13px 14px;
    vertical-align: top;
    border-radius: 5px;
}

.wrapper .bubble:before {
    position: absolute;
    top: 19px;
    display: block;
    width: 8px;
    height: 6px;
    content: "\00a0";
    transform: rotate(29deg) skew(-35deg);
}

.wrapper .bubble.you {
    float: left;
    color: var(--white);
    background-color: var(--blue);
    align-self: flex-start;
    animation-name: slideFromLeft;
    max-width: 50%;
    word-wrap: break-word;
}

.wrapper .bubble.you:before {
    left: -3px;
    background-color: var(--blue);
}

.wrapper .bubble.me {
    float: right;
    color: var(--dark);
    background-color: white;
    align-self: flex-end;
    animation-name: slideFromRight;
    max-width: 50%;
    word-wrap: break-word;
}

.wrapper .bubble.me:before {
    right: -3px;
    background-color: #eceff1;
}

@keyframes slideFromLeft {
    0% {
        margin-left: -200px;
        opacity: 0;
    }

    100% {
        margin-left: 0;
        opacity: 1;
    }
}

@-webkit-keyframes slideFromLeft {
    0% {
        margin-left: -200px;
        opacity: 0;
    }

    100% {
        margin-left: 0;
        opacity: 1;
    }
}

@keyframes slideFromRight {
    0% {
        margin-right: -200px;
        opacity: 0;
    }

    100% {
        margin-right: 0;
        opacity: 1;
    }
}

@-webkit-keyframes slideFromRight {
    0% {
        margin-right: -200px;
        opacity: 0;
    }

    100% {
        margin-right: 0;
        opacity: 1;
    }
}

.conversation-start {
    position: relative;
    width: 100%;
    margin-bottom: 27px;
    text-align: center;
}

.conversation-start span {
    font-size: 14px;
    display: inline-block;
    color: var(--grey);
}

.conversation-start span:before,
.conversation-start span:after {
    position: absolute;
    top: 10px;
    display: inline-block;
    width: 30%;
    height: 1px;
    content: "";
    background-color: var(--light);
    text-align: center;
}

.conversation-start span:before {
    left: 0;
}

.conversation-start span:after {
    right: 0;
}

.bi-arrow-left-circle {
    display: none;
}

@media (max-width: 1024px) {
    .wrapper .left .people .person img {
        height: 25px;
        width: 25px;
    }

    .wrapper .left .people .person .name {
        font-size: 13px;
    }

    .wrapper .left .people .person .time {
        font-size: 11px;
    }

    .wrapper .left .people .person .preview {
        font-size: 12px;
        padding-left: 15px;
    }

    .wrapper .left input {
        width: 170px;
    }

    .wrapper .left a.search {
        height: 40px;
        width: 40px;
        background-position: top 12px left 14px;
    }

    .col-md-3 {
        width: 30%;
    }

    .col-md-9 {
        width: 70%;
    }

    .wrapper .right .chat {
        width: 70%;
        height: 85%;
    }

    .wrapper .write {
        width: 65%;
        left: 33%;
    }

    .wrapper .write input {
        width: 89%;
    }
}

@media (max-width: 790px) {

    .col-md-3 {
        width: 100%;
    }

    .wrapper .left input {
        width: 80%;
    }

    .wrapper .left a.search {
        height: 40px;
        width: 40px;
        background-position: top 12px left 14px;
    }

    .wrapper .right .chat {
        width: 98%;
        height: 70%;
    }

    .wrapper .write {
        width: 92%;
        left: 20px;
    }

    .wrapper .write input {
        width: 84%;
    }

    .wrapper .left .people .person .name {
        font-size: 16px;
    }

    .wrapper .left .people .person .time {
        font-size: 13px;
    }

    .wrapper .left .people .person .preview {
        font-size: 14px;
    }

    .bi-arrow-left-circle {
        display: inline;
        padding-right: 10px;
        font-size: 1.5rem;
    }
}
</style>
