<template>
    <div>
        <navbar></navbar>
        <div class="wrapper">
            <div class="menu">
                <ul class="first">
                    <li>
                        <a class="acc" @click="changerView('dashboard')">
                            <img src="@/assets/house.png" alt="Acceuil">
                            Acceuil
                        </a>
                    </li>
                    <li>
                        <p class="gere">
                            <img src="@/assets/gerer.png" alt="Gerer">
                            Gérer les
                        </p>
                    </li>
                </ul>
                <ul class="fils">
                    <li>
                        <a @click="changerView('acces')"><img src="@/assets/key.png" alt="Accès"> Accès</a>
                    </li>
                    <li>
                        <a @click="changerView('profiles')"><img src="@/assets/etudiant.png" alt="Profiles">
                            Profiles</a>
                    </li>
                    <li>
                        <a @click="changerView('roles')"><img src="@/assets/role.png" alt="Rôles"> Rôles</a>
                    </li>
                    <li>
                        <a @click="changerView('badges')"><img src="@/assets/badge.png" alt="Badges"> Badges</a>
                    </li>
                    <li>
                        <a @click="changerView('attestations')"><img src="@/assets/attestation.png" alt="Attestations">
                            Attestations</a>
                    </li>
                    <li>
                        <a @click="changerView('evenements')"><img src="@/assets/event.png" alt="Evénements">
                            Evénements</a>
                    </li>
                    <li>
                        <a @click="changerView('certificats')"><img src="@/assets/certif.png" alt="Certificats">
                            Certificats</a>
                    </li>
                    <li>
                        <a @click="changerView('formations')"><img src="@/assets/formation.png" alt="Formations">
                            Formations</a>
                    </li>
                    <li>
                        <a @click="changerView('departements')"><img src="@/assets/department.png" alt="Départements">
                            Départements</a>
                    </li>
                    <li>
                        <a @click="changerView('entreprises')"><img src="@/assets/department.png" alt="Entreprises">
                            Entreprises</a>
                    </li>
                </ul>
            </div>
            <div class="content">
                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class=" modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Organiser Evenement</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="addBadge">
                                    <div class="row">
                                        <!-- Partie gauche du formulaire -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom de Badge</label>
                                                <input v-model="badge.nom" type="text" class="form-control"
                                                    id="nom" required>
                                            </div>
                                        </div>

                                        <!-- Partie droite du formulaire -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lieu" class="form-label">Type </label>
                                                <input type="text" v-model="badge.type" class="form-control"
                                                    id="lieu" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-container-choix">
                                        <div class="image-wrapper-choix">
                                            <div class="image-content">
                                                <label for="image1"><img class="img-choix" :src="imagePath1"
                                                        alt="Image 1"></label>
                                                <i class="bi bi-zoom-in" @click="openFullScreenImage(imagePath1)"></i>
                                            </div>
                                            <input id="image1" type="radio" v-model="badge.choix"
                                                name="image-choice" value="1">
                                        </div>
                                        <div class="image-wrapper-choix">
                                            <div class="image-content">
                                                <label for="image2"><img class="img-choix" :src="imagePath2"
                                                        alt="Image 1"></label>
                                                <i class="bi bi-zoom-in" @click="openFullScreenImage(imagePath2)"></i>
                                            </div>
                                            <input id="image2" type="radio" v-model="badge.choix"
                                                name="image-choice" value="2">
                                        </div>
                                        <div class="image-wrapper-choix">
                                            <div class="image-content">
                                                <label for="image3"><img class="img-choix" :src="imagePath3"
                                                        alt="Image 1"></label>
                                                <i class="bi bi-zoom-in" @click="openFullScreenImage(imagePath3)"></i>
                                            </div>
                                            <input id="image3" type="radio" v-model="badge.choix"
                                                name="image-choice" value="3">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary btn-sm"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            data-bs-dismiss="modal">Valider</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card-header">
                        / Badges
                    </div>
                    <div class="filter-bar">
                        <div class="search-container">
                            <span class="search-icon"><i class="bi bi-search"></i></span>
                            <input type="text" class="search-input" placeholder="Chercher Badge..."
                                v-model="searchQuery">
                        </div>
                        <!--<div class="bt">
            <select class="select" v-model="selectedCategory">
              <option value="">--choisir la catégorie--</option>
              <option v-for="(card, index) in cards" :key="index" :value="card.type">{{ card.type }}</option>
            </select>
            <button class="filter-button" @click="filtrerDonnees()"><i class="bi bi-funnel"></i> Filtrer</button>
          </div>-->
                        <div class="buttons-right">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bi bi-plus-circle"></i> Ajouter Badge</button>
                            <button type="button" class="btn btn-primary"  @click="handleLinkedInShare">
                                <i class="bi bi-plus-circle"></i> Partager Badge</button>
                        </div>
                    </div>
                    <div class="card-container">
                        <event v-for="(card, index) in displayedItems" :id="card.id" :key="index" :name="card.nom"
                            :affiche="card.image" />
                    </div>
                    <div class="pagination">
                        <button @click="previousPage" :disabled="currentPage === 1"
                            class="page-button">Précédent</button>
                        <span class="page-info">Page {{ currentPage }} / {{ totalPages }}</span>
                        <button @click="nextPage" :disabled="currentPage === totalPages"
                            class="page-button">Suivant</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import navbar from '@/components/navbar.vue'
import router from '@/router';
import event from '@/components/Dashboard/dashboard/badge.vue'
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2'
import BadgeService from "@/services/badges.js";
import axios from 'axios';

export default {
    data() {
        return {
            view: "badges",
            cards: [],
            showModal: true,
            searchQuery: '',
            selectedCategory: '',
            itemsPerPage: 9,
            currentPage: 1,
            accessToken: false,
            imagePath1: require('@/assets/Badge/1.png'),
            imagePath2: require('@/assets/Badge/2.png'),
            imagePath3: require('@/assets/Badge/3.png'),
            badge: {
                nom: null,
                type: null,
                image: null,
                choix: null,
            }
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.cards.length / this.itemsPerPage);
        },
        displayedItems() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.cards.slice(startIndex, endIndex);
        }
    },
    resetData() {
        this.cards = this.getBadges();
    },
    methods: {
        addBadge() {
            if (this.badge.choix == 1) {
                this.badge.image="assets/Badge/1.png";
            }
            else if (this.badge.choix == 2) {
                this.badge.image="assets/Badge/2.png";
            }
            else if (this.badge.choix == 3) {
                this.badge.image="assets/Badge/3.png";
            }
            BadgeService.addBadge(this.badge).then(()=>{
                this.getBadges();
                this.badge= {
                nom: null,
                type: null,
                image: null,
                choix: null,
            }
            })
            //console.log(this.attestation);
        },
        openFullScreenImage(imagePath) {
            window.open(imagePath, '_blank');
        },
        redirectToLinkedInAuth() {
            const clientId = '78go61uev563uc';
            const redirectUri = encodeURIComponent('http://localhost:8080/Dashboard/badges');
            const scope = 'r_liteprofile r_emailaddress w_member_social';
            const state = 'YOUR_UNIQUE_STATE_VALUE';  // Un état aléatoire pour prévenir les attaques CSRF

            const authUrl = `https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=${clientId}&redirect_uri=${redirectUri}&scope=${scope}&state=${state}`;

            window.location.href = authUrl;
        },
        async exchangeCodeForAccessToken(code) {
            const clientId = '78go61uev563uc';
            const clientSecret = 'WPL_AP0.JQmZ8NS8lfc4klxI.MTAxODIyNTM4Nw==';
            const redirectUri = 'http://localhost:8080/Dashboard/badges';

            try {
                const response = await axios.post('https://www.linkedin.com/oauth/v2/accessToken', null, {
                    params: {
                        grant_type: 'authorization_code',
                        code: code,
                        redirect_uri: redirectUri,
                        client_id: clientId,
                        client_secret: clientSecret
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                });

                return response.data.access_token;
            } catch (error) {
                console.error('Error exchanging code for access token:', error);
                return null;
            }
        },
        handleLinkedInShare() {
            // Vous pourriez avoir besoin d'extraire le code de l'URL ici si pas déjà fait
            const urlParams = new URLSearchParams(window.location.search);
            const code = urlParams.get('code');

            if (code) {
                this.exchangeCodeForAccessToken(code).then(accessToken => {
                    if (accessToken) {
                        this.postOnLinkedIn(accessToken);
                    } else {
                        console.error("Failed to retrieve access token.");
                    }
                });
            } else {
                this.redirectToLinkedInAuth();
            }
        },

        async postOnLinkedIn(accessToken) {
            const postText = "Voici mon nouveau certificat professionnel!";
            const url = 'https://api.linkedin.com/v2/ugcPosts';

            const payload = {
                "author": `urn:li:person:375713247`,
                "lifecycleState": "PUBLISHED",
                "specificContent": {
                    "com.linkedin.ugc.ShareContent": {
                        "shareCommentary": {
                            "text": postText
                        },
                        "shareMediaCategory": "NONE"
                    }
                },
                "visibility": {
                    "com.linkedin.ugc.MemberNetworkVisibility": "PUBLIC"
                }
            };

            try {
                const response = await this.$axios.post(url, payload, {
                    headers: {
                        Authorization: `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    }
                });
                console.log('Post created:', response.data);
            } catch (error) {
                console.error('Error posting to LinkedIn:', error);
            }
        },
        changerView(msg) {
            if (msg === 'acces') {
                router.push("/Dashboard/Acces");
            } else if (msg === 'dashboard') {
                router.push("/Dashboard");
            } else if (msg === 'profiles') {
                router.push("/Dashboard/profiles");
            } else if (msg === 'roles') {
                router.push("/Dashboard/roles");
            } else if (msg === 'badges') {
                router.push("/Dashboard/badges");
            } else if (msg === 'attestations') {
                router.push("/Dashboard/attestations");
            } else if (msg === 'evenements') {
                router.push("/Dashboard/evenements");
            } else if (msg === 'certificats') {
                router.push("/Dashboard/certificats");
            } else if (msg === 'formations') {
                router.push("/Dashboard/formations");
            } else if (msg === 'departements') {
                router.push("/Dashboard/departements");
            } else if (msg === 'entreprises') {
                router.push("/Dashboard/entreprises");
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        validerCreation() {
            Swal.fire({
                title: "Validé !",
                text: "Votre événement a été crée !",
                icon: "success",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ici, vous pouvez ajouter la logique pour supprimer le rôle
                    // Après la suppression réussie, vous pouvez afficher un message de succès
                }
            });
        },
        filtrerDonnees() {
            if (!this.selectedCategory) {
                this.cards = this.getBadges();
            } else {
                this.cards = this.cards.filter(teacher => teacher.type === this.selectedCategory);
            }
        },
        recherche() {
            if (this.searchQuery === '') {
                this.getBadges();
            } else {
                this.cards = this.cards.filter(card => {
                    return card.nom.toLowerCase().includes(this.searchQuery.toLowerCase());
                });
            }
        },
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        getBadges() {
            BadgeService.getAll().then((res) => {
                this.cards = res.data.data;
            })
        },
    },
    created() {
        this.$watch('searchQuery', () => {
            this.recherche();
        });
        this.getBadges();
    },
    components: {
        navbar,
        event,
    }
}
</script>
<style scoped>
@import "~bootstrap-icons/font/bootstrap-icons.css";

.first {
    margin-bottom: 0;
}

.wrapper {
    display: flex;
    height: 100ch;
}

.menu {
    width: 20%;
    height: 100ch;
    float: left;
    top: 0;
    margin-top: 4%;
    border: 1px solid #178FEB;
    background-color: #178FEB;
    box-shadow: 3px 4px 6px rgba(0, 0, 0, .1);
    position: fixed;
}

.content {
    width: 100%;
    min-height: 100ch;
    height: max-content;
    background-color: var(--bg-img);
    background-image: var(--bg-img);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    margin-left: 20%;
    padding-top: 80px;
}

ul {
    padding-top: 40px;
    padding-left: 30px;
}

ul li {
    list-style: none;
    color: white;
}

li a,
li p {
    display: block;
    text-decoration: none;
    color: white;
    font-size: 18px;
    font-family: Agency FB;
}

li a:hover,
.fils a:hover {
    text-decoration: underline;
    cursor: pointer;
}

a img {
    width: 35px;
    margin-right: 3px;
    padding-bottom: 10px;
}

.fils {
    padding-left: 60px;
    margin-top: 0;
    padding-top: 0 !important;
    margin-top: 0 !important;
}


.image-container-choix {
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-top: 20px;
}

.image-wrapper-choix {
    text-align: center;
}

.img-choix {
    width: 100px;
    height: 75px;
    display: block;
    margin: 0 auto;
}

.image-content {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.img-choix {
    max-width: 100%;
    /* Ajustez la largeur de l'image si nécessaire */
    height: auto;
    /* Permet à l'image de conserver son ratio d'aspect */
}

.image-wrapper-choix .bi {
    position: absolute;
    top: 5px;
    /* Ajustez la position verticale de l'icône */
    right: 5px;
    /* Ajustez la position horizontale de l'icône */
    cursor: pointer;
    /* Change le curseur en pointer pour indiquer qu'il est cliquable */
}

.fils p {
    font-size: 80%;
}

.acc {
    font-size: 25px;
}

.gere {
    font-family: Agency FB;
    font-size: 20px;
    padding-top: 0px;
}

.fils img {
    width: 23px;
    margin-right: 3px;
    margin-top: 10px;
}

.gere img {
    width: 30px;
    margin-right: 3px;
    padding-bottom: 10px;
}

li {
    margin-top: 0;
    padding-top: 0;
}

@media screen and (max-width: 800px) {
    .content {
        width: 100% !important;
        height: 100lh;
    }

    .menu {
        display: none;
        padding-left: 0;
        margin-left: 0;
    }

    .acc,
    .gere {
        padding-left: 0;
        margin-left: 0;
    }

    .fils {
        padding-left: 25%;
        margin-left: 8%;
    }

    ul {
        padding-left: 5% !important;
    }
}

@media screen and (max-width: 920px) {
    .content {
        height: 100lh;
    }

    .menu {
        padding-left: 0;
    }

    li a,
    li p {
        font-size: 80%;
    }

    .acc,
    .gere {
        font-size: 95%;
    }

    a img {
        width: 25px;
        margin-right: 3px;
        padding-bottom: 10px;
    }

    .fils img {
        width: 20px;
    }
}

.card-header {
  background: #FFFFFF;
  color: #818181;
  font-family: Agency FB;
  font-size: 120%;
  font-weight: bold;
  padding: 1%;
  padding-left: 3%;
  box-shadow: #818181 -2px 2px 4px;
  border-radius: 10px;
  border: 1px solid #818181;
  margin-bottom: 2%;
  background-color: var(--card-color);
}

.container {
  padding: 2%;
  margin: 5%;
  width: 90%;
  margin-top: 2%;
}

.filter-bar {
  display: flex;
  align-items: center !important;
  margin-top: 10px;
}

.btn {
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

@media screen and (max-width: 768px) {

  .container {
    width: 90% !important;
    margin-top: 10px;
  }
}

.search-input {
  padding: 3px;
  border-radius: 5px;
  background: #FFFFFF;
  border-color: #CACACA;
  color: #5D5D5D;
  font-family: Agency FB;
  font-weight: bold;
  cursor: auto;
  font-size: 90%;
}

.search-container {
  position: relative;
  margin-top: 10px;
  width: 300px;
  margin-right: 2%;
}

.search-container input[type="text"] {
  width: 100%;
  padding: 10px 35px 10px 40px;
  border: 1px solid #CACACA;
  border-radius: 10px;
  box-sizing: border-box;
  font-size: 16px;
  background-color: var(--card-color);
}

.search-container .search-icon {
  position: absolute;
  top: 50%;
  left: 10px;
  transform: translateY(-50%);
  color: #5D5D5D;
}

.bt {
  display: flex;
  margin-right: 10px;
  margin-top: 1%;
}

.select {
  text-align: center;
  color: #5D5D5D;
  cursor: pointer;
  border-radius: 10px;
  padding: 12px;
  background: var(--card-color);
  border-color: #CACACA;
  font-family: Berlin Sans FB;
  margin-right: 1%;
}

.filter-button {
  margin-right: 10px;
  border-radius: 10px;
  background-color: var(--card-color);
  border: hsl(0, 0%, 79%) solid 1px;
  padding: 4px 13px;
  cursor: pointer;
  display: flex;
  align-items: center;
  font-family: Agency FB;
  font-weight: bold;
  color: #5D5D5D;
  font-size: 90%;
}

.filter-button .bi {
  width: 20px;
}

.buttons-right {
  margin-left: auto;
}

.buttons-right button {
  font-size: 80%;
  padding: 12px;
  margin-top: 3%;
  border-radius: 10px;
  width: 100%;
}

.buttons-right button i {
  color: #FFFFFF !important;
}

.card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
  margin: 20px;
  margin-top: 60px;
}

.card {
  width: calc(25% - 20px);
  margin-bottom: 20px;
  box-sizing: border-box;
}

.modal-dialog {
  width: 60% !important;
  height: 30% !important;
  margin-top: 50px;
  margin-bottom: 50px;
}

.mb-3 {
  padding-bottom: 0px;
}

.modal-content .modal-title {
  font-family: Agency FB !important;
  font-style: normal !important;
  font-weight: bold !important;
  font-size: 120% !important;
  text-align: center !important;
  margin-left: 37% !important;
}

.modal-body .form-label,
.form-check-label,
option {
  font-family: Agency FB !important;
  font-size: 100% !important;
  color: #818181 !important;
}

.modal-body .form-control,
.form-select {
  font-family: Agency FB !important;
  font-size: 100% !important;
  background-color: #f3f3f3 !important;
  border: none;
  width: 100%;
}

.form-check-input {
  background-color: #c9c9c9 !important;
}

.pagination {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin-top: 15px;
  margin-bottom: 2%;
}

.page-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 6px 14px;
  cursor: pointer;
  border-radius: 4px;
  margin: 0 5px;
}

.page-button:hover {
  background-color: #0056b3;
}

.page-info {
  margin: 0 10px;
  font-size: 14px;
  color: #555;
}

@media (max-width: 768px) {
  .card {
    width: calc(50% - 20px);
  }
}

@media (max-width: 480px) {
  .card {
    width: 90%;
  }
}
</style>