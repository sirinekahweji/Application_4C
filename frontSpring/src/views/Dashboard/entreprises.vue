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
                            Profils</a>
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
                <div v-if="loading" class="overlay"></div>
                <div class="d-flex justify-content-center spinner" v-if="loading">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class=" modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Entreprise</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="nomDep" class="form-label">Nom Entreprise</label>
                                                <input type="text" class="form-control" id="nomDep" v-model="nom"
                                                    maxlength="25" required>
                                                <div v-if="errors2.nom" class="alert alert-danger">{{
                                                    errors2.nom }}</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="abv" class="form-label">Secteur d'activité</label>
                                                <input type="text" class="form-control" id="abv"
                                                    v-model="secteurActivite" maxlength="25" required>
                                                <div v-if="errors2.secteurActivite" class="alert alert-danger">{{
                                                    errors2.secteurActivite }}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="mb-3">
                                                <label for="adresse" class="form-label">Adresse</label>
                                                <input type="adress" class="form-control" id="adresse" v-model="adresse"
                                                    maxlength="25" required>
                                                <div v-if="errors2.adresse" class="alert alert-danger">{{
                                                    errors2.adresse }}</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" v-model="phone"
                                                    maxlength="8" required>
                                                <div v-if="errors2.phone" class="alert alert-danger">{{
                                                    errors2.phone }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-primary btn-sm"
                                    @click="AddEntreprise()">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card-header">
                        / Gestion des Entreprises
                    </div>
                    <div class="data">
                        <div class="dep">
                            <div class="titre">
                                <img src="@/assets/menu.png" alt="menu"> Entreprises :
                            </div>
                            <div>
                                <button class="download-button" @click="historique()"><i
                                        class="bi bi-clock-history"></i>
                                </button>
                                <button class="download-button" @click="telechargerPDF()"><i class="bi bi-download"></i>
                                </button>
                                <button class="print-button" @click="imprimerPDF"><i class="bi bi-printer"></i>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="bi bi-plus-circle"></i></button>
                            </div>
                        </div>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div v-for="(item, index) in displayedItems" :key="index" class="accordion-item">
                                <h2 class="accordion-header">
                                    <button @click="toggleAccordion(index)" class="accordion-button" type="button"
                                        :aria-expanded="isOpen[index]"
                                        :aria-controls="'panelsStayOpen-collapse' + index">
                                        <span class="accordion-icon">
                                            <img
                                                :src="isOpen[index] ? require('@/assets/down.png') : require('@/assets/right.png')">
                                        </span>
                                        {{ item.nom }}
                                    </button>
                                    <div class="btn-droit">
                                        <button type="button" data-bs-toggle="modal"
                                            :data-bs-target="'#consulterModal' + item.id">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" @click="loadContactData(item)" data-bs-toggle="modal"
                                            :data-bs-target="'#modifierModal' + item.id" >
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="modal"
                                            :data-bs-target="'#ContactModal' + item.id">
                                            <i class="bi bi-telephone-plus"></i>
                                        </button>
                                        <button type="button" @click="confirmDeleteEnt(item.id)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </h2>
                                <div class="modal fade" :id="'modifierModal' + item.id" tabindex="-1"
                                    aria-labelledby="modifierModalLabel" aria-hidden="true">
                                    <div class=" modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Contact
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div>
                                                            <div class="mb-3">
                                                                <label for="nomC" class="form-label">Nom :</label>
                                                                <input type="text" class="form-control" id="nomC"
                                                                    v-model="entreprise.nom" maxlength="16" required>
                                                                <div v-if="errors3.nom" class="alert alert-danger">{{
                                                                    errors3.nom }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="prenom" class="form-label">Secteur d'activité :</label>
                                                                <input type="text" class="form-control" id="prenom"
                                                                    v-model="entreprise.secteurActivite" maxlength="10" required>
                                                                <div v-if="errors3.prenom" class="alert alert-danger">{{
                                                                    errors3.secteurActivite }}</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mb-3">
                                                                <label for="mail" class="form-label">Adresse :</label>
                                                                <input type="email" class="form-control" id="mail"
                                                                    v-model="entreprise.adresse" maxlength="30" required>
                                                                <div v-if="errors3.adresse" class="alert alert-danger">{{
                                                                    errors3.adresse }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone1" class="form-label">Phone :</label>
                                                                <input type="text" class="form-control" id="phone"
                                                                    v-model="entreprise.phone" maxlength="8" required>
                                                                <div v-if="errors3.phone" class="alert alert-danger">{{
                                                                    errors3.phone }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    @click="UpdateEntreprise(item.id)">Valider</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" :id="'ContactModal' + item.id" tabindex="-1"
                                    aria-labelledby="ContactModalLabel" aria-hidden="true">
                                    <div class=" modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Contact
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div>
                                                            <div class="mb-3">
                                                                <label for="nomC" class="form-label">Nom :</label>
                                                                <input type="text" class="form-control" id="nomC"
                                                                    v-model="contact.nom" maxlength="10" required>
                                                                <div v-if="errors.nom" class="alert alert-danger">{{
                                                                    errors.nom }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="prenom" class="form-label">Prenom :</label>
                                                                <input type="text" class="form-control" id="prenom"
                                                                    v-model="contact.prenom" maxlength="10" required>
                                                                <div v-if="errors.prenom" class="alert alert-danger">{{
                                                                    errors.prenom }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="fonc" class="form-label">Fonctionnalité
                                                                    :</label>
                                                                <input type="adress" class="form-control" id="fonc"
                                                                    v-model="contact.fonctionnalite" maxlength="15"
                                                                    required>
                                                                <div v-if="errors.fonctionnalite"
                                                                    class="alert alert-danger">{{ errors.fonctionnalite
                                                                    }}</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="mb-3">
                                                                <label for="fonc" class="form-label">Vous êtes un
                                                                    responsable ? :</label>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input"
                                                                        id="responsableOui" value="true"
                                                                        v-model="contact.isResponsable" required>
                                                                    <label class="form-check-label"
                                                                        for="responsableOui">Oui</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input"
                                                                        id="responsableNon" value="false"
                                                                        v-model="contact.isResponsable" required>
                                                                    <label class="form-check-label"
                                                                        for="responsableNon">Non</label>
                                                                </div>
                                                                <div v-if="errors.isResponsable"
                                                                    class="alert alert-danger">{{
                                                                        errors.isResponsable }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="mail" class="form-label">Email :</label>
                                                                <input type="email" class="form-control" id="mail"
                                                                    v-model="contact.email" required>
                                                                <div v-if="errors.email" class="alert alert-danger">{{
                                                                    errors.email }}</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone1" class="form-label">Phone :</label>
                                                                <input type="text" class="form-control" id="phone"
                                                                    v-model="contact.phone" maxlength="8" required>
                                                                <div v-if="errors.phone" class="alert alert-danger">{{
                                                                    errors.phone }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    @click="AddContacts(item.id)">Valider</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" :id="'consulterModal' + item.id" tabindex="-1"
                                    aria-labelledby="consulterModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Informations de
                                                    l'Entreprise</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Colonne Gauche -->
                                                    <div class="col-md-4">
                                                        <div class="mb-2">
                                                            <strong>Nom de l'Entreprise :</strong>
                                                            <p>{{ item.nom }}</p>
                                                        </div>
                                                        <div class="mb-2">
                                                            <strong>Adresse :</strong>
                                                            <p>{{ item.adresse }}</p>
                                                        </div>
                                                    </div>
                                                    <!-- Colonne Droite -->
                                                    <div class="col-md-4">
                                                        <div class="mb-2">
                                                            <strong>Numéro de Téléphone :</strong>
                                                            <p>{{ item.phone }}</p>
                                                        </div>
                                                        <div class="mb-2">
                                                            <strong>Secteur d'Activité :</strong>
                                                            <p>{{ item.secteurActivite }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 scrollable-container">
                                                        <strong>Contacts de l'entreprise :</strong>
                                                        <div v-for="contact in getFilteredContacts(item.id)"
                                                            :key="contact.id" class="contact-details">
                                                            <p><strong>Nom :</strong> {{ contact.nom }}</p>
                                                            <p><strong>Prénom :</strong> {{ contact.prenom }}</p>
                                                            <p><strong>Email :</strong> {{ contact.email }}</p>
                                                            <p><strong>Téléphone :</strong> {{ contact.telephone }}</p>
                                                            <p><strong>Fonction :</strong> {{ contact.fonction }}</p>
                                                            <p><strong>Responsable :</strong> {{ contact.responsable ?
                                                                'Oui' : 'Non' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div :id="'panelsStayOpen-collapse' + index" class="accordion-collapse collapse"
                                    :class="{ 'show': isOpen[index] }">
                                    <div class="accordion-body">
                                        <div class="specialites">
                                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                                <div class="option"
                                                    v-for="(option, optionIndex) in filteredPersonnels(item.id)"
                                                    :key="optionIndex">
                                                    <div class="op">
                                                        <button @click="toggleAccordionClass(optionIndex)"
                                                            class="accordion-button" type="button"
                                                            :aria-expanded="isOpenClass[optionIndex]"
                                                            :aria-controls="'panelsStayOpen-collapse' + optionIndex">
                                                            - {{ option.fonctionnalite }}
                                                        </button>
                                                        <div class="btn-droit">
                                                            <button type="button">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                            <button @click="confirmDeletePersonnel(option.id)"
                                                                type="button"><i class="bi bi-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        </div>
    </div>
</template>
<script>
import navbar from '@/components/navbar.vue'
import router from '@/router';
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2'
import EntrepriseService from '@/services/entreprises.js'
import PersonnelsService from '@/services/personnels.js'
import ContactService from '@/services/contacts'
import jsPDF from 'jspdf'
import 'jspdf-autotable'

export default {
    data() {
        return {
            view: "entreprises",
            entreprises: [],
            isOpen: [],
            isOpenClass: [],
            personnels: [],
            itemsPerPage: 5,
            currentPage: 1,
            nom: "",
            secteurActivite: "",
            adresse: "",
            phone: "",
            errors2: {
                nom: "",
                secteurActivite: "",
                adresse: "",
                phone: "",
            },
            errors3: {
                nom: "",
                secteurActivite: "",
                adresse: "",
                phone: "",
            },
            showErrorMessage: false,
            showErrorMsg: false,
            showErrorMessageContact: false,
            showErrorMsgContact: false,
            selectedEntrepriseId: null,
            loading: false,
            contact: {
                nom: "",
                prenom: "",
                fonctionnalite: "",
                phone: "",
                isResponsable: "false",
                email: ""
            },
            errors: {
                nom: "",
                prenom: "",
                fonctionnalite: "",
                phone: "",
                isResponsable: "",
                email: ""
            },
            contacts: [],
            entreprise : {},
        };
    },
    resetData() {
        this.entreprises = this.getEntreprises();
    },
    computed: {
        totalPages() {
            return Math.ceil(this.entreprises.length / this.itemsPerPage);
        },
        displayedItems() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.entreprises.slice(startIndex, endIndex);
        },
        filteredContacts(id) {
            return this.contacts.filter(contact => contact.entreprise_id == id);
        }
    },
    methods: {
        loadContactData(item) {
            this.entreprise = { ...item };
        },
        UpdateEntreprise(id){
            if(this.validateAddEntreprise()){
                EntrepriseService.updateEntreprise(this.entreprise, id).then(() => {
                     this.entreprise = {};
                     Swal.fire({
                        title: "Modifiée !",
                        text: "Votre Entreprise a été modifiée !",
                        icon: "success",
                    })
                })
                window.location.reload();
            } else {
                Swal.fire({
                    title: "Erreur !",
                    text: "Des erreurs sont présentes dans le formulaire",
                    icon: "error",
                });
            }
        },
        getFilteredContacts(id) {
            //console.log(id);
            //console.log(this.contacts.filter(contact => contact.entreprise_id === id));
            return this.contacts.filter(contact => contact.entreprise_id === id);
        },
        getContacts() {
            ContactService.getAll().then((res) => {
                this.contacts = res.data.data;
            })
        },
        validateAddEntreprise() {
            this.errors3 = {};
            if (!this.entreprise.nom) {
                this.errors3.nom = 'Le nom est requis.';
            }
            if (!this.entreprise.secteurActivite) {
                this.errors3.secteurActivite = "Le secteur d'activité est requis.";
            }
            if (!this.entreprise.adresse) {
                this.errors3.adresse = "L'adresse est requise.";
            }
            if (!String(this.entreprise.phone).match(/^\d{8}$/)) {
                this.errors3.phone = 'Le numéro de téléphone doit être composé de 8 chiffres.';
            }
            return Object.values(this.errors3).every(error => error === "");
        },
        validateForm() {
            this.errors = {

            };
            if (!this.contact.nom) {
                this.errors.nom = 'Le nom est requis.';
            }
            if (!this.contact.prenom) {
                this.errors.prenom = 'Le prénom est requis.';
            }
            if (!this.contact.fonctionnalite) {
                this.errors.fonctionnalite = 'La fonctionnalité est requise.';
            }
            if (!this.contact.email.includes('@')) {
                this.errors.email = 'Email invalide.';
            }
            if (this.contact.isResponsable === '') {
                this.errors.isResponsable = 'Champ vide';
            }
            if (this.contacts.some(contact => contact.email === this.contact.email)) {
                this.errors.email = 'Email déjà utilisé.';
            }
            if (!this.contact.phone.match(/^\d{8}$/)) {
                this.errors.phone = 'Le numéro de téléphone doit être composé de 8 chiffres.';
            }
            return Object.values(this.errors).every(error => error === "");
        },
        validateAdd() {
            this.errors2 = {};
            if (!this.nom) {
                this.errors2.nom = 'Le nom est requis.';
            }
            if (this.entreprises.some(entreprise => entreprise.nom.toLowerCase() === this.nom.toLowerCase())) {
                this.errors2.nom = 'Le nom est utilisé.';
            }
            if (!this.secteurActivite) {
                this.errors2.secteurActivite = "Le secteur d'activité est requis.";
            }
            if (!this.adresse) {
                this.errors2.adresse = "L'adresse est requise.";
            }
            if (!this.phone.match(/^\d{8}$/)) {
                this.errors2.phone = 'Le numéro de téléphone doit être composé de 8 chiffres.';
            }
            return Object.values(this.errors2).every(error => error === "");
        },
        historique() {
            router.push('/Dashboard/entreprises/historique');
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
        filteredPersonnels(entrepriseId) {
            //console.log(entrepriseId);
            return this.personnels.filter(option => option.entreprise_id === entrepriseId);
        },
        AddEntreprise() {
            if (this.validateAdd()) {
                const entreprise = {
                    nom: this.nom,
                    secteurActivite: this.secteurActivite,
                    adresse: this.adresse,
                    phone: this.phone
                };
                EntrepriseService.addEntreprise(entreprise)
                    .then(() => {
                        this.entreprises.push(entreprise);
                        this.nom = "";
                        this.secteurActivite = "",
                            this.adresse = "",
                            this.phone = "",
                            Swal.fire({
                                title: "Crée !",
                                text: "Votre Entreprise a été crée !",
                                icon: "success",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.showErrorMessage = false;
                                    this.showErrorMsg = false;
                                }
                            });
                    })
                    .catch((error) => {
                        console.error("Error create entreprise:", error);
                    });
            }else {
                Swal.fire({
                    title: "Erreur !",
                    text: "Des erreurs sont présentes dans le formulaire",
                    icon: "error",
                });
            }
        },
        AddContacts(id) {
            if (this.validateForm()) {
                const contact = {
                    nom: this.contact.nom,
                    prenom: this.contact.prenom,
                    fonctionnalite: this.contact.fonctionnalite,
                    phone: this.contact.phone,
                    isResponsable: this.contact.isResponsable === 'true',
                    email: this.contact.email,
                    entreprise_id: id,
                };
                console.log(contact);
                ContactService.addContact(contact)
                    .then(() => {
                        console.log(id);
                        this.contact.nom = "";
                        this.contact.prenom = "",
                        this.contact.fonctionnalite = "",
                        this.contact.phone = "",
                        this.contact.isResponsable = "false",
                        this.contact.email = "",
                        this.contacts.push(contact);
                        Swal.fire({
                            title: "Crée !",
                            text: "Votre contact a été crée !",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.showErrorMessageContact = false;
                                this.showErrorMsgContact = false;
                            }
                        });
                    })
                    .catch((error) => {
                        console.error("Error create contact:", error);
                    });
            } else {
                Swal.fire({
                    title: "Erreur !",
                    text: "Des erreurs sont présentes dans le formulaire",
                    icon: "error",
                });
            }
        },
        async telechargerPDF() {
            this.loading = true;
            const doc = new jsPDF();
            doc.text('Liste des Entreprises', 10, 10);
            const profils = this.entreprises;
            const head = [['Nom', 'Secteur Activité', 'Adresse', 'Telephone']];
            doc.autoTable({
                head: head
            });
            for (const filtrage of profils) {
                doc.autoTable({
                    body: [[
                        filtrage.nom,
                        filtrage.secteurActivite,
                        filtrage.adresse,
                        filtrage.phone,
                    ]],
                    startY: doc.autoTable.previous.finalY, // Espacement entre les tables
                    margin: { top: 20 }, // Espacement entre le texte et le tableau
                    columnStyles: {
                        0: { cellWidth: 25 }, // Largeur de la première colonne
                        1: { cellWidth: 65 }, // Largeur de la deuxième colonne
                        2: { cellWidth: 45 }, // Largeur de la troisième colonne
                        3: { cellWidth: 47 }, // Largeur de la quatrième colonne
                    },
                    styles: {
                        cellPadding: 3, // Espacement entre le contenu et la bordure de la cellule
                        fontSize: 8,   // Taille de la police
                        valign: 'baseline', // Alignement vertical du contenu
                        halign: 'left' // Alignement horizontal du contenu
                    }
                });
            }
            doc.save('liste_entreprises.pdf');
            this.loading = false;
        },
        async imprimerPDF() {
            this.loading = true;
            const doc = new jsPDF();
            doc.text('Liste des Entreprises', 10, 10);
            const profils = this.entreprises;
            const head = [['Nom', 'Secteur Activite', 'Adresse', 'Telephone']];
            doc.autoTable({
                head: head
            });
            for (const filtrage of profils) {
                doc.autoTable({
                    body: [[
                        filtrage.nom,
                        filtrage.secteurActivite,
                        filtrage.adresse,
                        filtrage.phone,
                    ]],
                    startY: doc.autoTable.previous.finalY, // Espacement entre les tables
                    margin: { top: 20 }, // Espacement entre le texte et le tableau
                    columnStyles: {
                        0: { cellWidth: 25 }, // Largeur de la première colonne
                        1: { cellWidth: 65 }, // Largeur de la deuxième colonne
                        2: { cellWidth: 45 }, // Largeur de la troisième colonne
                        3: { cellWidth: 47 }, // Largeur de la quatrième colonne
                    },
                    styles: {
                        cellPadding: 3, // Espacement entre le contenu et la bordure de la cellule
                        fontSize: 8,   // Taille de la police
                        valign: 'baseline', // Alignement vertical du contenu
                        halign: 'left' // Alignement horizontal du contenu
                    }
                });
            }
            const pdfData = doc.output();
            const blob = new Blob([pdfData], { type: 'application/pdf' });
            const url = URL.createObjectURL(blob);
            const iframe = document.createElement('iframe');
            iframe.style.cssText = 'position:absolute;left:-10000px;top:-10000px;';
            document.body.appendChild(iframe);
            iframe.src = url;
            await new Promise(resolve => setTimeout(resolve, 1000));
            setTimeout(() => {
                iframe.contentWindow.print();
            }, 1000);
            this.loading = false;
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


        confirmDeleteEnt(id) {
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, supprimer !"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteEntreprise(id);
                }
            });
        },
        confirmDeletePersonnel(personnel) {
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, supprimer !"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deletePersonnel(personnel);
                }
            });
        },
        toggleAccordion(index) {
            this.isOpen[index] = !this.isOpen[index];
        },
        toggleAccordionClass(index) {
            this.isOpenClass[index] = !this.isOpenClass[index];
        },
        getEntreprises() {
            EntrepriseService.getEntreprises().then((res) => {
                this.entreprises = res.data.data;
            })
        },
        getPersonnels() {
            PersonnelsService.getAll().then((res) => {
                this.personnels = res.data.data;
            })
        },
        addEntreprise() {
            if (!this.nom || !this.abreviation) {
                Swal.fire({
                    title: "Erreur !",
                    text: "Veuillez remplir tous les champs obligatoires.",
                    icon: "error",
                });
                return;
            }
            if (this.entreprises.some(entreprise => entreprise.nom.toLowerCase() === this.nom.toLowerCase())) {
                this.showErrorMessage = true;
                this.showErrorMsg = false;
                return;
            } else if (this.entreprise.some(entreprise => entreprise.abreviation.toLowerCase() === this.abreviation.toLowerCase())) {
                this.showErrorMessage = false;
                this.showErrorMsg = true;
                return;
            } else {
                const entreprise = {
                    nom: this.nom,
                    abreviation: this.abreviation
                };
                EntrepriseService.addEntreprise(entreprise)
                    .then(() => {
                        this.entreprises.push(entreprise);
                        this.nom = "";
                        this.abreviation = "",
                            Swal.fire({
                                title: "Crée !",
                                text: "Votre entreprise a été crée !",
                                icon: "success",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.showErrorMessage = false;
                                    this.showErrorMsg = false;
                                }
                            });
                    })
                    .catch((error) => {
                        console.error("Error create entreprise:", error);
                    });
            }
        },
        deleteEntreprise(id) {
            EntrepriseService.delete(id).then(() => {
                this.getEntreprises();
            });
        },
        deletePersonnel(id) {
            const personnel = this.personnels.find(personnel => personnel.id === id);
            PersonnelsService.delete(personnel.id).then(() => {
                this.getPersonnels();
            })
        },
    },
    created() {
        this.isOpen = new Array(this.entreprises.length).fill(false);
        this.getPersonnels();
        this.getEntreprises();
        this.getContacts();
    },
    components: {
        navbar,
    }
}
</script>
<style scoped>
@import "~bootstrap-icons/font/bootstrap-icons.css";

.alert-danger {
    font-size: 12px !important;
    padding: 5px !important;
}

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

.print-button,
.download-button {
    margin-right: 10px;
}

.container {
    padding: 2%;
    margin: 5%;
    width: 90%;
    margin-top: 2%;
}

.data {
    border-radius: 10px;
    box-shadow: #818181 -2px 2px 4px;
    border: 1px solid #818181;
    background-color: var(--card-color);
    padding-left: 8%;
    padding-right: 8%;
}

.accordion-icon {
    margin-right: 2%;
}

.options {
    display: flex;
    flex-direction: column;
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}

.option .btn-droit button {
    background-color: transparent;
    border: none;
    color: #818181;
    padding: 0;
    margin: 0;
}

.option .btn-droit button i {
    display: inline-block;
    height: 20px;
    line-height: 20px;
    text-align: center;
    vertical-align: middle;
    font-size: 0.9em;
}

.option .btn-droit {
    width: 10%;
}

.option {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 5px 10px;
    padding-bottom: 0 !important;
    padding-left: 0 !important;
    margin-left: 20%;
    border: none;
    background-color: transparent;
    cursor: pointer;
    font-family: Agency FB;
    font-size: 110%;
    font-weight: bold;
    color: #818181;
    width: 80%;
}

.accordion-header {
    border-bottom: #c5c4c4 1px solid;
    padding-bottom: 0;
    padding-left: 0;
    margin-left: 10%;
    display: flex;
    flex-direction: row;
}

.accordion-item {
    border: none;
    background-color: var(--card-color);
}

.accordion-icon img {
    width: 70%;
}

.accordion-button {
    background-color: transparent;
    padding-bottom: 1% !important;
    padding-left: 0;
    font-family: Agency FB;
    font-size: 60%;
    font-weight: bold;
    color: #818181;
    width: 90%;
}

.option i {
    margin-left: 5px;
}

.accordion {
    width: 93%;
    margin-bottom: 10%;
}

.accordion-button::after {
    display: none;
}

.accordion-button:focus {
    z-index: 0;
    border-color: transparent;
    outline: none;
    box-shadow: none;
}

.dep {
    margin-top: 5% !important;
    margin-left: 5% !important;
    color: #178FEB !important;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    border-bottom: #c5c4c4 2px solid;
    margin-bottom: 2%;
}

.titre {
    color: #178FEB !important;
}

.dep button {
    border: none;
    background-color: transparent;
}

.dep img {
    width: 15%;
    margin-bottom: 3%;
}

.dep div {
    font-family: Agency FB;
    font-size: 120%;
}

.btn-droit {
    display: flex;
    flex-direction: row;
    gap: 6px;
    width: 10%;
}

.btn-droit button {
    background-color: transparent;
    border: none;
    color: #818181;
    padding: 0;
    margin: 0;
}

.btn-droit button i {
    display: inline-block;
    height: 60px;
    line-height: 85px;
    text-align: center;
    vertical-align: middle;
    font-size: 0.5em;
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
}

.modal-body .form-label {
    font-family: Agency FB !important;
    font-size: 100% !important;
    color: #696767 !important;
}

.modal-body .form-control {
    font-family: Agency FB !important;
    font-size: 100% !important;
    background-color: #f3f3f3 !important;
    width: 100%;
    border: #818181 solid;
    border-width: thin;
}

.specialites {
    display: flex;
    flex-wrap: wrap;
}

.specialites .option {
    flex: 1 1 50%;
    display: flex;
    flex-direction: column;
}

.specialites .option i {
    display: inline-block;
    height: 30px;
    line-height: 30px;
    text-align: center;
    vertical-align: middle;
    font-size: 0.5rem;
}

.op {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 0 !important;
    padding-left: 0 !important;
    border: none;
    background-color: transparent;
    cursor: pointer;
    font-family: Agency FB;
    font-size: 160%;
    font-weight: bold;
    width: 100%;
}

.op .btn-droit {
    display: flex;
    flex-direction: row;
    gap: 5px;
    width: 10%;
    margin-left: -10%;
}

.op .btn-droit button {
    background-color: transparent;
    border: none;
    color: #818181;
    padding: 0;
    margin: 0;
}

.op .btn-droit button i {
    display: inline-block;
    height: 60px;
    line-height: 85px;
    text-align: center;
    vertical-align: middle;
    font-size: 0.5em;
}

.classes .option {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 0 !important;
    padding-left: 0 !important;
    border: none;
    background-color: transparent;
    cursor: pointer;
    border-bottom: #c5c4c4 1px solid;
    font-family: Agency FB;
    font-size: 90%;
    font-weight: bold;
    color: #818181;
    width: 216%;
    margin-left: -45% !important;
    margin-bottom: 5px;
}

.classes .option i {
    font-size: 0.5em;
}

.accordion-body {
    margin-bottom: -10% !important;
    margin-top: -5% !important;
}

@media (max-width: 670px) {
    .option {
        justify-content: space-evenly;
        padding: 2px 2px;
        margin-bottom: 1%;
        padding-bottom: 0;
        padding-left: 0;
        margin-left: 5%;
        align-items: flex-start;
        justify-self: flex-start;
    }

    .options {
        width: 100% !important;
    }
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.spinner {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
}

#ModalSuppression .form-label,
#ModalSupp .form-label {
    font-size: 20px !important;
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

.col-md-6 {
    display: flex;
    flex-direction: row;
    gap: 10%;
    width: 100%;
}

.col-md-6 div {
    width: 100%;
}

.scrollable-container {
    max-height: 200px;
    max-width: 300px;
    overflow-y: auto;
    overflow-x: hidden;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
}

.contact-details {
    margin-bottom: 13px;
    padding: 5px;
    border-bottom: 2px solid #ddd;
    font-size: 13px;
}
</style>