<template>
    <div class="information-personnel col-md-3">
        <div class="background col-md-12"></div>
        <img v-if="this.user.photoProfile !== null" class="photo-profile"
            :src="require(`@/assets/PhotosProfils/${user.photoProfile}`)" alt="">
        <img v-else class="photo-profile" src="@/assets/PhotosProfils/Cyrine_kahweji_11454862.png" alt="">
        <h1>{{ this.user.prenom + ' ' + this.user.nom }}</h1>
        <div class="ligne">
            <router-link to="/Profile"> voir profile</router-link>
        </div>
        <hr>
        <p v-if="role.nomRole === 'administrateur' || role.nomRole === 'responsablemanager'"><img
                src="@/assets/icons8-lease-48.png"><router-link to="/Dashboard/Acces"> l'accès au comptes des
                managers</router-link></p>
        <p v-if="role.nomRole === 'personnelEntreprise'"><img src="@/assets/icons8-etoile-64.png"><router-link
                to="ListeEtudiants"> Consulter les comptes des managers</router-link></p>
        <div class="Qrcode">
            <h3>{{ this.role.nomRole }}</h3>
            <svg ref="QrCode"></svg>
        </div>
    </div>
</template>
<script>
import UserService from '@/services/users.js'

export default {
    data() {
        return {
            role: {},
            user: {},
        }
    },
    created() {
        this.loadFromLocalStorage();
        this.getUserRole();
    },
    methods: {
        getUserRole() {
            UserService.getUserRole(this.user.role_id).then(res => {
                this.role = res.data;
                //console.log(this.role);
            })
        },
        codeQr() {
            const svgString = this.user.code_qr;
            this.$nextTick(() => {
                const qrElement = this.$refs.QrCode;
                qrElement.innerHTML = svgString;
            });
        },
        Logout() {
            localStorage.removeItem("user");
            this.$router.push("/");
        },
        loadFromLocalStorage() {
            const userData = localStorage.getItem("user");
            if (userData) {
                this.user = JSON.parse(userData);
                this.codeQr();
            }
        },
    }
}
</script>
<style scoped>
.ligne {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
}

.background {
    height: 650px;
    position: absolute;
    background-image: url('@/assets/3d-abstract-techno-background.png');
    background-position: center;
    background-size: cover;
    opacity: 0.3;
    z-index: -1;
}

.centered-content {
    text-align: center;
}

.information-personnel {
    display: inline-block;
    justify-content: center;
    text-align: center;
    position: fixed;
    margin-right: 0px;
    width: 18%;

}

.information-personnel h1 {
    color: var(--text-color);
    font-size: 23px;
    padding-top: 5px;
}

.information-personnel .photo-profile {
    height: 120px;
    width: 120px;
    border: 2px solid rgb(85, 231, 0);
    border-radius: 50%;
    box-shadow: 5px 5px 5px rgb(181, 181, 181);
    margin-top: 40px;
}

.information-personnel hr {
    background-color: rgb(0, 0, 0);
    height: 2px;
    border: none;
    margin-left: 20px;
    margin-right: 20px;
    margin-bottom: 25px;
}

.information-personnel a {
    text-decoration: none;
    color: var(--text-color);

}

.information-personnel p {
    font-size: 12px;
    font-weight: bold;

    padding-top: 5px;
    color: var(--text-color);
    padding-left: 5px;
    display: flex;
    align-items: center
}

.information-personnel p img {
    width: 25px;
    height: 25px;
}

.Qrcode {
    margin-top: 25px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    /* Center content vertically */
}

.Qrcode h3 {
    text-decoration-line: underline;
    color: var(--text-color);
    font-size: 16px;
    margin-bottom: 15px;
}

.Qrcode svg {
    width: 140px;
    height: 140px;
}

.Qrcode h4 {
    padding-top: 10px;
    color: var(--text-color);
    font-size: 14px;
}



@media (max-width: 1024px) {
    .information-personnel .photo-profile {
        width: 100px;
        height: 100px;
    }

    .information-personnel a {
        font-size: 15px;
    }

    .information-personnel h4 {
        font-size: 16px;
    }
}

@media (max-width: 790px) {
    .information-personnel {
        display: none;
    }
}
</style>