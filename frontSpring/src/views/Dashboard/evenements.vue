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
                                <form @submit.prevent="addNewEvenement">
                                    <div class="row">
                                        <!-- Partie gauche du formulaire -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom de l'evenement</label>
                                                <input type="text" v-model="evenement.titre" class="form-control"
                                                    id="nom" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date" class="form-label">Date</label>
                                                <input type="date" v-model="evenement.date" class="form-control"
                                                    id="date" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dateLimiteInscription" class="form-label">Date Limite
                                                    Inscription</label>
                                                <input type="date" v-model="evenement.dateLimiteInscription"
                                                    class="form-control" id="dateLimiteInscription" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="affiche" class="form-label">Affiche</label>
                                                <input type="file" class="form-control" id="affiche" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Description De
                                                    l'Evenement</label>
                                                <textarea v-model="evenement.description" class="form-control"
                                                    id="message" rows="3"></textarea>
                                            </div>
                                            <!-- Ajoutez d'autres champs de formulaire au besoin -->
                                        </div>

                                        <!-- Partie droite du formulaire -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lieu" class="form-label">Lieu </label>
                                                <input type="text" v-model="evenement.lieu" class="form-control"
                                                    id="lieu" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="capacite" class="form-label">Capacite </label>
                                                <input type="text" v-model="evenement.capacite" class="form-control"
                                                    id="capacite" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="categorie" class="form-label">Categorie </label>
                                                <input type="text" v-model="evenement.categorie" class="form-control"
                                                    id="categorie" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="organisateur" class="form-label">Organisateur </label>
                                                <input type="text" v-model="evenement.organisateur" class="form-control"
                                                    id="organisateur" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Manager 4C ?</label>
                                                <div class="form-check">
                                                    <input type="radio" id="categorieInput0" value="1"
                                                        v-model="evenement.forManagers" class="form-check-input">
                                                    <label class="form-check-label" for="manager">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="categorieInput1" value="0"
                                                        v-model="evenement.forManagers" class="form-check-input">
                                                    <label class="form-check-label" for="tous">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Ajoutez d'autres champs de formulaire au besoin -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary btn-sm"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            data-bs-dismiss="modal">Valider</button>
                                    </div>
                                </form>
                                <!-- Textarea qui prend tout le width -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card-header">
                        / Evenements
                    </div>
                    <div class="filter-bar">
                        <div class="search-container">
                            <span class="search-icon"><i class="bi bi-search"></i></span>
                            <input type="text" class="search-input" placeholder="Chercher Evenement..."
                                v-model="searchQuery">
                        </div>
                        <div class="bt">
                            <select class="select" v-model="selectedCategory">
                                <option value="">--choisir la catégorie--</option>
                                <option v-for="(card, index) in cards" :key="index" :value="card.categorie">{{
                            card.categorie }}</option>
                            </select>
                            <button class="filter-button" @click="filtrerDonnees()"><i class="bi bi-funnel"></i>
                                Filtrer</button>
                        </div>
                        <div class="buttons-right">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bi bi-plus-circle"></i> Organiser Evenement</button>
                        </div>
                    </div>
                    <div class="card-container">
                        <event v-for="(card, index) in displayedItems" :id="card.id" :key="index" :name="card.titre"
                            :affiche="card.affiche" />
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
import event from '@/components/Dashboard/dashboard/eventAdmin.vue'
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2'
import EventService from "@/services/evenements.js";

export default {
    data() {
        return {
            view: "evenements",
            cards: [],
            showModal: true,
            searchQuery: '',
            selectedCategory: '',
            itemsPerPage: 8,
            currentPage: 1,
            evenement: {
                titre: null,
                description: null,
                lieu: null,
                categorie: null,
                forManagers: null,
                date: null,
                dateLimiteInscription: null,
                capacite: null,
                affiche: null,
                organisateur: null,
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
        this.cards = this.getEvents();
    },
    methods: {
        addNewEvenement() {
            // eslint-disable-next-line no-unused-vars
            const imageFiles = document.getElementById("affiche").files;
            if (imageFiles.length > 0) {
                const reader = new FileReader();
                const file = imageFiles[0];
                reader.readAsDataURL(file);

                reader.onload = (e) => {
                    const imageSrc = e.target.result;
                    this.evenement.affiche = imageSrc;
                    //console.log(this.certif);

                    EventService.addEvenement(this.evenement).then(() => {
                        this.evenement = {
                            titre: null,
                            description: null,
                            lieu: null,
                            categorie: null,
                            forManagers: null,
                            date: null,
                            dateLimiteInscription: null,
                            capacite: null,
                            affiche: null,
                            organisateur: null,
                        }
                        //console.log(res.data);
                        this.getEvents();
                    }).catch((error) => {
                        console.error(error);
                    });
                };
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
                this.cards = this.getEvents();
            } else {
                this.cards = this.cards.filter(teacher => teacher.categorie === this.selectedCategory);
            }
        },
        recherche() {
            if (this.searchQuery === '') {
                this.getEvents();
            } else {
                this.cards = this.cards.filter(card => {
                    return card.titre.toLowerCase().includes(this.searchQuery.toLowerCase());
                });
            }
        },
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        getEvents() {
            EventService.getEvent().then((res) => {
                this.cards = res.data.data;
            })
        },
    },
    created() {
        this.$watch('searchQuery', () => {
            this.recherche();
        });
        this.getEvents();
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
    align-items: center;
    margin-top: 10px;
}

.btn {
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

@media screen and (max-width: 768px) {

    /* Smartphones (portrait and landscape) */
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

}

.buttons-right button i {
    color: #FFFFFF !important;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
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