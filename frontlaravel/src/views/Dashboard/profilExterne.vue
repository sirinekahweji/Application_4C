<template>
    <div>
        <navbar></navbar>
        <div v-if="!user" class="loading-container">
            <div class="spinner"></div>
            <p>Loading...</p>
        </div>
        <div v-else>
            <div v-if="view == 'profile'" class="container-fluid">
                <div class="cover-container">
                    <img @click="openFullScreenImage(getPhotoCouverture())" v-if="user" :src="getPhotoCouverture()"
                        alt="couverture" class="cover-image">
                    <div>
                        <img @click="openFullScreenImage(getImageSource())" :src="getImageSource()"
                            alt="Photo de profil" class="profile-image">
                    </div>
                </div>
                <div class="nom">
                    <h5>{{ this.user.nom }} {{ this.user.prenom }}</h5>


                    <div class="rating" v-if="idManager === user.role_id">
                        <input type="radio" name="rating" id="r1">
                        <label for="r1" :class="{ 'filled': user.nbEtoiles >= 5 }" @click="updateRating(5)"></label>

                        <input type="radio" name="rating" id="r2">
                        <label for="r2" :class="{ 'filled': user.nbEtoiles >= 4 }" @click="updateRating(4)"></label>

                        <input type="radio" name="rating" id="r3">
                        <label for="r3" :class="{ 'filled': user.nbEtoiles >= 3 }" @click="updateRating(3)"></label>

                        <input type="radio" name="rating" id="r4">
                        <label for="r4" :class="{ 'filled': user.nbEtoiles >= 2 }" @click="updateRating(2)"></label>

                        <input type="radio" name="rating" id="r5">
                        <label for="r5" :class="{ 'filled': user.nbEtoiles >= 1 }" @click="updateRating(1)"></label>
                    </div>
                    <p id="role">{{ this.role }}</p>
                </div>
            </div>
            <div class="container-fluid pro">
                <section id="information">
                    <div>
                        <div class="personnel">
                            <h6>Mes Informations personnelles :</h6>
                        </div>
                        <ul class="info">
                            <div>
                                <li><strong>Prénom :</strong> {{ this.user.prenom }}</li>
                                <li><strong>Date de naissance :</strong> {{ this.user.dateNaissance }}</li>
                                <li v-if="this.user.user_type === 'Enseignant' && this.enseignant.etablissement && this.enseignant.etablissement.length !== 0"><strong>Etablissement :</strong> {{
                                    this.enseignant.etablissement }}</li>
                                <li v-if="this.user.user_type === 'Etudiant' && this.etudiant.specialit && this.etudiant.specialit.length !== 0"><strong>Specialite :</strong>{{
                                    this.specialite.nom }}</li>
                                <li v-if="this.user.user_type === 'PersonnelEntreprise' && this.personnel.fonctionnalite && this.personnel.fonctionnalite.length !== 0"> <strong>Fonctionnalite
                                        :</strong>
                                    {{ this.personnel.fonctionnalite }}</li>
                                <li><strong>Gouvernorat :</strong> {{ this.user.Gouvernorat }}</li>
                                <li><strong>Téléphone mobile :</strong> {{ this.user.phoneNumber }}</li>
                            </div>
                            <div>
                                <li><strong>Nom :</strong>{{ this.user.nom }} </li>

                                <li v-if="(this.user.user_type === 'Etudiant' || this.user.user_type === 'Enseignant') && this.departement.nom && this.departement.nom.length !== 0">
                                    <strong>Departement :</strong> {{ this.departement.nom }}
                                </li>
                                <li v-if="this.user.user_type === 'Etudiant' && this.etudiant.classe && this.etudiant.classe.length !== 0"><strong>Classe :</strong> {{
                                    this.etudiant.classe }}</li>
                                <li v-if="this.user.user_type === 'PersonnelEntreprise' && this.entreprise.nom && this.entreprise.nom.length !== 0"><strong>Entreprise :</strong>
                                    {{
                                        this.entreprise.nom }}</li>
                                <li><strong>Adresse :</strong> {{ this.user.adresse }}</li>
                                <li v-if="this.user.lienLinkdIn && this.user.lienLinkdIn.length !== 0"><strong>LinkedIn :</strong> {{ this.user.lienLinkdIn }}</li>
                            </div>
                        </ul>
                        <div class="personnel">
                            <h6>Mes Informations du compte :</h6>
                        </div>
                        <ul class="info compte">
                            <div class="mail">
                                <li><strong>Email :</strong></li>
                                <li>{{ this.user.email }}</li>
                                <li><strong>Mot de passe :</strong>**********</li>
                            </div>
                            <div class="qr">
                                <svg ref="qrCode"></svg>
                                <button @click="downloadQRCode">Télécharger code QR</button>
                            </div>
                        </ul>
                    </div>
                </section>

                <section id="cv">
                    <div class="pdf">
                        <button id="load" @click="changerView('cv')">
                            <img src="@/assets/load.png" alt="load">
                        </button>
                        <button id="upload">
                            <label for="file-upload">
                                <img src="@/assets/upload.png" alt="upload">
                            </label>
                            <input id="file-upload" type="file" style="display: none;" @change="handleFileUpload">
                        </button>
                    </div>

                    <div class="card">
                        <div class="Expériences">
                            <p class="champ"> Expériences</p>
                            <ul class="content">
                                <li v-for="(expérience, index) in Expériences" :key="index">{{ expérience.poste }} <div>
                                        <button @click="recupererDonnes(index, 'expérience')"><i
                                                class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                                :data-bs-target="modalTarget"
                                                @click="openModal(true, '#ModalExperience', 'Modifier Une Expérience')"></i></button>

                                        <button><i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                                data-bs-target="#ModalConsultExperience"
                                                @click="afficherdetails(index, 'expérience')"></i></button>
                                        <button><i class="bi bi-trash-fill icon"
                                                @click="confirmDelete(index, 'expérience')"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="FormationAcadémique">
                            <p class="champ">Formation Académique</p>
                            <ul class="content">
                                <li v-for="(FormationAcd, index) in FormationAcadémique" :key="index">
                                    {{ FormationAcd.diplome }}
                                    <div>
                                        <button @click="recupererDonnes(index, 'FormationAcadémique')"><i
                                                class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                                :data-bs-target="modalTarget"
                                                @click="openModal(true, '#ModalFormationAcd', 'Modifier Une Formation Académique')"></i></button>
                                        <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                            data-bs-target="#ModalconsultFormationAcd"
                                            @click="afficherdetails(index, 'FormationAcadémique')"></i>
                                        <button><i class="bi bi-trash-fill icon"
                                                @click="confirmDelete(index, 'FormationAcadémique')"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="Formations">
                            <p class="champ">Formations</p>
                            <ul class="content">
                                <li v-for="(Formation, index) in Formations" :key="index">{{ Formation.titre }} <div>
                                        <button @click="recupererDonnes(index, 'Formation')"><i
                                                class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                                :data-bs-target="modalTarget"
                                                @click="openModal(true, '#ModalFormation', 'Ajouter Une Formation')"></i></button>
                                        <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                            data-bs-target="#ModalconsultFormation"
                                            @click="afficherdetails(index, 'Formation')"></i><button><i
                                                class="bi bi-trash-fill icon"
                                                @click="confirmDelete(index, 'Formation')"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="Certifications">
                            <p class="champ">Certifications</p>
                            <ul class="content">
                                <li v-for="(Certification, index) in Certifications" :key="index">{{ Certification.titre
                                    }}
                                    <div><button @click="recupererDonnes(index, 'Certification')"><i
                                                class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                                :data-bs-target="modalTarget"
                                                @click="openModal(true, '#ModalCertificat', 'Modifier Une Certification')"></i></button>
                                        <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                            data-bs-target="#ModalconsultCertificat"
                                            @click="afficherdetails(index, 'Certification')"></i><button><i
                                                class="bi bi-trash-fill icon"
                                                @click="confirmDelete(index, 'Certification')"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="Langues">
                            <p class="champ">Langues</p>
                            <ul class="content">
                                <li v-for="(Langue, index) in Langues" :key="index">{{ Langue.nom }} <div>
                                        <button @click="recupererDonnes(index, 'Langues')"><i
                                                class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                                :data-bs-target="modalTarget"
                                                @click="openModal(true, '#ModalLangue', 'Modifier Une Langue')"></i></button>
                                        <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                            data-bs-target="#ModalconsultLangue"
                                            @click="afficherdetails(index, 'Langues')"></i><button><i
                                                class="bi bi-trash-fill icon"
                                                @click="confirmDelete(index, 'Langues')"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="Compétences">
                            <p class="champ">Compétences</p>
                            <ul class="content">
                                <li v-for="(Compétence, index) in Compétences" :key="index">{{ Compétence.nom }} <div>
                                        <button @click="recupererDonnes(index, 'Compétence')"><i
                                                class="bi bi-pencil-square icon" data-bs-toggle="modal"
                                                :data-bs-target="modalTarget"
                                                @click="openModal(true, '#ModalCompetance', 'Modifier Une Competance')"></i></button>
                                        <i class="bi bi-eye-fill icon" data-bs-toggle="modal"
                                            data-bs-target="#ModalconsultCompetance"
                                            @click="afficherdetails(index, 'Compétence')"></i><button><i
                                                class="bi bi-trash-fill icon"
                                                @click="confirmDelete(index, 'Compétence')"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </section>
            </div>
            <div class="container-fluid pass">
                <passport></passport>
            </div>
        </div>
    </div>
</template>
<script>
import Axios from "axios";
import navbar from '@/components/navbar.vue'
import ExperienceService from '../../services/experiences.js'
import FormationAcdService from '../../services/formationsAcademiques.js'
import FormationService from '../../services/formation.js'
import CertificatService from '../../services/certificats.js'
import LangueService from '../../services/langues.js'
import CompetenceService from '../../services/competences.js'
import UserService from '../../services/users.js'
import CVsService from '../../services/cvs.js'
import PersonnelService from '../../services/personnels.js'
import EntrepriseService from '../../services/entreprises.js'
import EnseignantService from '@/services/enseignants.js'
import EtudiantService from '@/services/etudiants.js'
import DepartmentService from '@/services/departements.js'
import ClasseService from '@/services/classes.js'
import SpecialiteService from '@/services/specialites.js'
import RoleService from '@/services/roles.js'

//import QRCode from 'qrcode-svg';
import jsPDF from 'jspdf'
import 'jspdf-autotable'
import Swal from 'sweetalert2'
import passport from '../../components/Profil/passport.vue'



export default {
    created() {
        //this.getProfil();
        this.user_id = this.$route.params.id;
        console.log(this.user_id);
        this.getUser();
        this.getManager();
        this.readUserFromLocalStorage();
        this.getAdmin();
        this.getResponsable();

    },
    components: {
        navbar,
        passport,

    },
    data() {
        return {
            gouvernorats: [
                'Ariana', 'Béja', 'Ben Arous', 'Bizerte', 'Gabès',
                'Gafsa', 'Jendouba', 'Kairouan', 'Kasserine', 'Kébili',
                'Le Kef', 'Mahdia', 'La Manouba', 'Médenine', 'Monastir',
                'Nabeul', 'Sfax', 'Sidi Bouzid', 'Siliana', 'Sousse',
                'Tataouine', 'Tozeur', 'Tunis', 'Zaghouan'
            ],

            experienceAajouter: {
                "poste": "",
                "entreprise": "",
                "lieu": "",
                "dateDebut": "",
                "dateFin": "",
                "description": "",
                "cv_id": "",
            },
            certificateAajouter: {
                "titre": "",
                "description": "",
                "categorie": "",
                "date": "",
                "type_certificat": "Externe",
                "organisation": "",
                "certificat": "",
                "cv_id": "",
            },
            langue:
            {
                "nom": "",
                "niveau": "",
                "cv_id": "",
            },
            competence:
            {
                "nom": "",
                "niveau": "",
                "cv_id": "",
            },
            formationAcd: {

                "etablissement": "",
                "diplome": "",
                "domaineEtude": "",
                "dateDebut": "",
                "dateFin": "",
                "description": "",
                "cv_id": "",
            },
            formationExterne: {
                "titre": "",
                "description": "",
                "categorie": "",
                "date": "",
                "type_formation": "formationExterne",
                "organisation": "",
                "cv_id": "",
            },
            Enseignant: {
                "nom": "",
                "prenom": "",
                "phoneNumber": "",
                "cin": "",
                "photoProfile": "",
                "photoCouverture": "",
                "genre": "",
                "dateNaissance": "",
                "lienLinkdIn": "",
                "adresse": "",
                "Gouvernorat": " ",
                "etablissement": "",
                "departement_id": "",

            },
            Personnl: {
                "nom": "",
                "prenom": "",
                "phoneNumber": "",
                "cin": "",
                "photoProfile": "",
                "photoCouverture": "",
                "genre": "",
                "dateNaissance": "",
                "lienLinkdIn": "",
                "adresse": "",
                "Gouvernorat": " ",
                "fonctionnalite": "",
                "entreprise_id": "",

            },
            Etudiant: {
                "nom": "",
                "prenom": "",
                "phoneNumber": "",
                "cin": "",
                "photoProfile": "",
                "photoCouverture": "",
                "genre": "",
                "dateNaissance": "",
                "lienLinkdIn": "",
                "adresse": "",
                "Gouvernorat": " ",
                "etablissement": "",
                "classe_id": "",

            },
            data: {
                "password": '',

            },
            fonctionnalite: '',
            /*entreprise_id:null,*/
            user_id: null,
            Entreprise: null,
            lienlinkedin: '',
            department: '',
            email: '',
            newPassword: '',
            oldPassword: '',
            confirmNewPassword: '',
            titre: '',
            categorie: '',
            date: '',
            organisation: '',
            nomEntreprise: '',
            Poste: '',
            dateNaissance: '',
            genre: '',
            cin: '',
            telephoneMobile: '',
            gouvernorat: '',
            adresse: '',
            lieu: '',
            category: null,
            roleManager: null,
            showModal: false,
            role: '',
            datedebut: '',
            dateFin: '',
            description: '',
            cv_id: "",
            id: '',
            certificatimg: null,
            etablissement: null,
            departementnom: null,
            gouvernoratnom: null,
            departementid: null,
            specialitenom: '',
            fonctionnalit: '',
            diplome: '',
            nom: '',
            prenom: '',
            niveau: '',
            domaineEtude: '',
            modalTarget: '',
            isEditing: false,
            modalTitle: '',
            modal: ' ',
            user_type: '',
            classee: null,
            specialit: null,
            user: null,
            actionButtonLabel: 'Ajouter',
            users: [],
            departements: [],
            classes: [],
            specialites: [],
            entreprises: [],
            profil: {},
            cv: {},
            etudiant: {},
            enseignant: {},
            personnel: {},
            classeupdate: {},
            entreprise: {},
            departement: {},
            classe: {},
            specialite: {},
            Expériences: [

            ],
            isCinValid: false,
            isPhoneValid: true,
            //valider:false,

            FormationAcadémique: [

            ],
            Formations: [
            ],
            Certifications: [
            ],
            Langues: [

            ],
            Compétences: [

            ],

            couvertureImage: require('@/assets/couverture.png'),
            profileImage: require('@/assets/both.jpg'),
            view: "profile",
            ModalCertification: false,
            ModalLangue: false,
            ModalCompetance: false,
            ModalFormation: false,
            ModalFormationAcd: false,
            ModalExperience: false,
            idManager: null,
            experienceDetaills: {},
            formationAcdDetaills: {},
            formationDetaills: {},
            certificatDetaills: {},
            langueDetaills: {},
            competenceDetaills: {},
            Credentials: {
                "email": "",
                "password": "",
            },
            name: '',
            nameState: null,
            connecte: null,
            admin: null,
            responsable: null,
            submittedNames: []

        }
    },

    methods: {
        updateRating(rating) {
            if(this.idManager === this.user.role_id && (this.connecte.role_id === this.admin || this.connecte.role_id === this.responsable)){
                this.user.nbEtoiles = rating;
                this.confirmChanges();
            }
        },
        readUserFromLocalStorage() {
            const userJson = localStorage.getItem('user');
            if (userJson) {
                this.connecte = JSON.parse(userJson);
            }
        },
        getManager() {
            RoleService.findIdManager().then(res => {
                this.idManager = res.data;
            })
        },
        getAdmin() {
            RoleService.findIdAdmin().then(res => {
                this.admin = res.data;
            })
        },
        getResponsable() {
            RoleService.findIdResponsable().then(res => {
                this.responsable = res.data;
            })
        },
        increment() {
            this.user.nbEtoiles++;
        },
        decrement() {
            if (this.user.nbEtoiles > 0) {
                this.user.nbEtoiles--;
            }
        },
        confirmChanges() {
            console.log('Les changements sont confirmés, étoiles:', this.user.nbEtoiles);
            this.evaluation();
            this.showModal = false;
        },
        evaluation() {
            UserService.evaluer(this.user.id, { etoiles: this.user.nbEtoiles }).then(() => {
                this.getUser();
                this.getPhotoCouverture();
            })
        },
        getRoleById() {
            RoleService.findById(this.user.role_id).then(res => {
                console.log(res.data);
                this.role = res.data.data.nomRole;
            })
        },
        getUser() {
            UserService.getUser(this.user_id).then(res => {
                setTimeout(() => {
                    this.user =
                        res.data.data;
                    this.codeQr();
                    this.getRoleById();
                }, 1000);
            })
        },
        updateEnseignant() {
            EnseignantService.update(this.enseignant.id, this.Enseignant).then(() => {
                this.user = this.readUserFromLocalStorage();
                this.nom = "";
                this.prenom = "";
                this.phoneNumber = "";
                this.cin = "";
                this.photoProfile = "";
                this.photoCouverture = "";
                this.genre = "";
                this.dateNaissance = "";
                this.lienLinkdIn = "";
                this.adresse = "";
                this.gouvernoratnom = null;
                this.etablissement = "";
                this.departementnom = null;
            })
        },
        updateEtudient() {
            EtudiantService.update(this.etudiant.id, this.Etudiant).then(() => {
                this.user = this.readUserFromLocalStorage();
                this.nom = "";
                this.prenom = "";
                this.phoneNumber = "";
                this.cin = "";
                this.photoProfile = "";
                this.photoCouverture = "";
                this.genre = "";
                this.dateNaissance = "";
                this.lienLinkdIn = "";
                this.adresse = "";
                this.gouvernoratnom = null;
                this.etablissement = "";
                this.specialit = null;
                this.classee = null;
                this.departementnom = null;

            })
        },
        updatePersonnel() {

            PersonnelService.update(this.personnel.id, this.Personnl).then(() => {
                this.user = this.readUserFromLocalStorage();

                this.nom = "";
                this.prenom = "";
                this.phoneNumber = "";
                this.cin = "";
                this.photoProfile = "";
                this.photoCouverture = "";
                this.genre = "";
                this.dateNaissance = "";
                this.lienLinkdIn = "";
                this.adresse = "";
                this.gouvernoratnom = null;
                this.etablissement = "";
                this.fonctionnalit = "";
            })
        },

        getDepartements() {
            DepartmentService.getAll().then((res) => {
                this.departements = res.data.data;
                //console.log("departemts")
                //console.log(this.departements)

            })
        },
        getClasses() {
            ClasseService.getAll().then((res) => {
                this.classes = res.data.data;
                //console.log("classes")
                //console.log(this.classes)

            })
        },
        getSpecialites() {
            SpecialiteService.getAll().then((res) => {
                this.specialites = res.data.data;
                //console.log("specialites")
                //console.log(this.specialites)
            })
        },
        getEntreprises() {
            EntrepriseService.getEntreprises().then((res) => {
                this.entreprises = res.data.data;
                //console.log("entreprises")
                //console.log(this.entreprises)
            })
        },
        recupererInfoCompte() {
            this.email = this.user.email;

        },
        updateCredentials() {
            if (!this.oldPassword || !this.newPassword || !this.confirmNewPassword || !this.email) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs avant de continuer.'
                });
                return;
            }
            this.data.password = this.oldPassword;

            UserService.checkPassword(this.data, this.user.id).then(() => {

                this.Credentials.email = this.email;
                this.Credentials.password = this.newPassword;

                UserService.updateCredentials(this.user.id, this.Credentials).then(() => {

                    this.user = this.readUserFromLocalStorage();
                    this.Email = "";
                    this.newPassword = "";
                    this.oldPassword = "";
                    this.confirmNewPassword = "";
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Les informations ont été mises à jour avec succès.!',
                        timer: 2000, // Durée pendant laquelle l'alerte reste affichée (en millisecondes)
                        timerProgressBar: true, // Affiche une barre de progression
                        showConfirmButton: false // Cache le bouton "OK"
                    });
                }).catch(error => {
                    console.error("Erreur lors de la mise à jour :", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur s\'est produite lors de la mise à jour!'
                    });
                });

            }).catch(error => {
                console.error("Erreur lors de la requête:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors de la vérification du mot de passe.'
                });
            });


        },
        getEntreprise(id) {
            EntrepriseService.getEntreprise(id).then((res) => {
                this.entreprise = res.data.data;
                //console.log(this.entreprise)
            })

        },
        getSpecialite(id) {
            SpecialiteService.getSpecialite(id).then((res) => {
                this.specialite = res.data.data;
                this.getDepartement(this.specialite.departement_id);
                //console.log(this.specialite)
            })

        },
        getDepartement(id) {
            DepartmentService.getDepartement(id).then((res) => {
                this.departement = res.data.data;
                this.selectedDepartment = this.departement.nom;
            })

        },
        getClasse(id) {
            ClasseService.getClasse(id).then((res) => {
                this.classe = res.data.data;
                this.getSpecialite(this.classe.specialite_id);

                //console.log(this.classe)

            })

        },

        getPersonnel(idUser) {
            PersonnelService.getPersonnel(idUser).then((res) => {
                this.personnel = res.data.data;
                //console.log(this.personnel)
                this.getEntreprise(this.personnel.entreprise_id);

            })

        },

        getEnseignant(idUser) {
            EnseignantService.getEnseignant(idUser).then((res) => {
                this.enseignant = res.data.data;
                //console.log(this.enseignant)
                this.getDepartement(this.enseignant.departement_id);

            })

        },
        getEtudient(idUser) {
            EtudiantService.getEtudiant(idUser).then((res) => {
                this.etudiant = res.data.data;
                this.getClasse(this.etudiant.classe_id);


            })

        },
        getcv(iduser) {

            CVsService.getCV(iduser).then((res) => {
                this.cv = res.data.data;
                this.afficherExperiences(this.cv.id);
                this.afficherFormationsAcd(this.cv.id);
                this.afficherFormationsExternes(this.cv.id);
                this.afficherCertificatsExternes(this.cv.id);
                this.afficherLangues(this.cv.id);
                this.afficherCompetences(this.cv.id);

            })

        },
        Annuler() {
            this.etablissement = "";
            this.diplome = "";
            this.domaineEtude = "";
            this.datedebut = "";
            this.dateFin = "";
            this.description = "";
            this.Poste = "";
            this.nomEntreprise = "";
            this.lieu = "";
            this.categorie = "";
            this.date = "";
            this.organisation = "";
            this.titre = "";
            this.certificatimg = null;
            this.nom = "";
            this.niveau = "";
            this.Email = "";
            this.fonctionnalite = "";
            this.newPassword = "";
            this.oldPassword = "";
            this.confirmNewPassword = "";

        },
        recupererDonnes(index, type) {
            if (type == "expérience") {
                this.id = this.Expériences[index].id;
                this.Poste = this.Expériences[index].poste;
                this.nomEntreprise = this.Expériences[index].entreprise;
                this.lieu = this.Expériences[index].lieu;
                this.datedebut = this.Expériences[index].dateDebut;
                this.dateFin = this.Expériences[index].dateFin;
                this.description = this.Expériences[index].description;

            }
            if (type == "FormationAcadémique") {

                this.id = this.FormationAcadémique[index].id;
                this.etablissement = this.FormationAcadémique[index].etablissement;
                this.diplome = this.FormationAcadémique[index].diplome;
                this.domaineEtude = this.FormationAcadémique[index].domaineEtude;
                this.datedebut = this.FormationAcadémique[index].dateDebut;
                this.dateFin = this.FormationAcadémique[index].dateFin;
                this.description = this.FormationAcadémique[index].description;
            }
            if (type == "Formation") {
                this.id = this.Formations[index].id;
                this.titre = this.Formations[index].titre;
                this.description = this.Formations[index].description;
                this.categorie = this.Formations[index].categorie;
                this.date = this.Formations[index].date;
                this.organisation = this.Formations[index].organisation;
            }
            if (type == "Certification") {
                this.id = this.Certifications[index].id;
                this.titre = this.Certifications[index].titre;
                this.description = this.Certifications[index].description;
                this.categorie = this.Certifications[index].categorie;
                this.date = this.Certifications[index].date;
                this.organisation = this.Certifications[index].organisation;
                this.certificatimg = this.Certifications[index].certificat;
            }
            if (type == "Langues") {
                this.id = this.Langues[index].id;
                this.nom = this.Langues[index].nom;
                this.niveau = this.Langues[index].niveau;
            }
            if (type == "Compétence") {
                this.id = this.Compétences[index].id;
                this.nom = this.Compétences[index].nom;
                this.niveau = this.Compétences[index].niveau;
            }


        },

        afficherdetails(index, type) {
            if (type == 'expérience') {
                this.experienceDetaills = this.Expériences[index];

            }
            else if (type == 'FormationAcadémique') {
                this.formationAcdDetaills = this.FormationAcadémique[index];

            }
            else if (type == 'Formation') {
                this.formationDetaills = this.Formations[index];
            }
            else if (type == "Certification") {
                this.certificatDetaills = this.Certifications[index];
            }
            else if (type == "Langues") {
                this.langueDetaills = this.Langues[index];
            }
            else if (type == "Compétence") {
                this.competenceDetaills = this.Compétences[index];
            }


        },
        afficherExperiences(id) {
            ExperienceService.getAllExperiences(id).then((res) => {
                this.Expériences = res.data.data;
            })

        },
        codeQr() {
            const svgString = this.user.code_qr;
            this.$nextTick(() => {
                const qrElement = this.$refs.qrCode;
                if (qrElement) {
                    qrElement.innerHTML = svgString;
                } else {
                    console.error('QR code element not found');
                }
            });
        },
        getUsers() {
            UserService.getAll().then(response => {
                this.users = response.data.data;
            })
        },
        confirmDelete(index, type) {
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
                    // Ici, vous pouvez ajouter la logique pour supprimer le rôle
                    // Après la suppression réussie, vous pouvez afficher un message de succès
                    if (type == "expérience") {
                        ExperienceService.deleteExperience(this.Expériences[index].id).then(() => {
                            this.afficherExperiences(this.cv.id);

                        })
                    }
                    if (type == "FormationAcadémique") {
                        FormationAcdService.deleteFormationAcd(this.FormationAcadémique[index].id).then(() => {
                            this.afficherFormationsAcd(this.cv.id)


                        })
                    }
                    if (type == "Formation") {
                        FormationService.deleteFormation(this.Formations[index].id).then(() => {
                            this.afficherFormationsExternes(this.cv.id)
                        })
                    }
                    if (type == "Certification") {
                        CertificatService.deleteCertificat(this.Certifications[index].id).then(() => {
                            this.afficherCertificatsExternes(this.cv.id)
                        })

                    }
                    if (type == "Langues") {
                        LangueService.deleteLangue(this.Langues[index].id).then(() => {
                            this.afficherLangues(this.cv.id)
                        })

                    }
                    if (type == "Compétence") {
                        CompetenceService.deleteCompetence(this.Compétences[index].id).then(() => {
                            this.afficherCompetences(this.cv.id)
                        })

                    }

                }
            })
        },
        changerView(data) {
            console.log(this.personnel.fonctionnalite)
            this.view = data;
        },

        openModalForEdit() {
            // Modifier le modal pour l'édition
            this.actionButtonLabel = 'Modifier';
        },
        openModalForAdd() {
            // Modifier le modal pour l'ajout
            this.actionButtonLabel = 'Ajouter';
        },
        openModal(isEditing, modal, title) {
            this.isEditing = isEditing;
            this.modalTarget = modal;
            this.modalTitle = title;



            if (this.isEditing) {
                this.openModalForEdit();
            }
            else {
                this.openModalForAdd();
            }
        },
        openFullScreenImage(imagePath) {
            window.open(imagePath, '_blank');
        },
        getImageSource() {
            if (this.user.photoProfile) {

                if (this.user.photoProfile.startsWith('http')) {

                    return this.user.photoProfile;
                } else {
                    return require(`@/assets/PhotosProfils/${this.user.photoProfile}`);
                }
            } else {
                return require(`@/assets/noimage.png`);
            }
        },
        getPhotoCouverture() {
            if (this.user.photoCouverture && this.user) {

                if (this.user.photoCouverture.startsWith('http')) {

                    return this.user.photoCouverture;
                } else {
                    return require(`@/assets/PhotosCouvertures/${this.user.photoCouverture}`);
                }
            } else {
                return require(`@/assets/noimage.png`);
            }
        },
        downloadQRCode() {
            const svgString = this.user.code_qr;
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const image = new Image();
            image.onload = () => {
                canvas.width = image.width;
                canvas.height = image.height;
                context.drawImage(image, 0, 0);
                const imageURL = canvas.toDataURL('image/png');
                const downloadLink = document.createElement('a');
                downloadLink.href = imageURL;
                downloadLink.download = 'qrcode.png';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            };
            image.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgString)));
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            //this.user.photoProfile=URL.createObjectURL(file);
            const formData = new FormData();
            formData.append('photo_profile', file);
            Axios.post(`users/upload-profil-image/${this.user.id}`, formData).then(() => {
                console.log("PhotoProfileUpdated")
            });
        },
        changerPhotoCouverture(event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('photo_couverture', file);
            Axios.post(`users/upload-couverture-image/${this.user.id}`, formData).then(() => {
                console.log("PhotoCouvertureUpdated")
            });

        },
        generateCV() {
            const personalInfo = {
                firstName: "Bouthaina",
                lastName: "Belghith",
                city: "Bizerte",
            };
            const cvContent = `
                <h6>Curriculum Vitae</h6>
                <p>Informations personnelles</p>
                <p>Prénom: ${personalInfo.firstName}</p>
                <p>Nom: ${personalInfo.lastName}</p>
                <p>Ville: ${personalInfo.city}</p>
                <!-- Ajoutez d'autres sections du CV ici -->

                <!-- Exemple: -->
                <p>Expérience professionnelle</p>
                <p>Expérience professionnelle à remplir ici...</p>
            `;
            this.convertToPDF(cvContent);
        },
        convertToPDF(htmlContent) {
            const pdf = new jsPDF();
            pdf.html(htmlContent, {
                callback: () => {
                    pdf.save("mon_cv.pdf");
                },
            });
        },
    }
}
</script>

<style scoped>
#role{
    margin-top: 10px;
    font-size: large;
}

#role::first-letter {
  text-transform: uppercase;
}

.bi-exclamation-circle {
    color: red;
}

.is-invalid {
    border: 1px solid rgba(255, 0, 0, 0.99);
    background-color: #fae8ea;
    color: rgb(125, 124, 124);
}

.error-message {
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #ff0000;
}

/*css etoiles*/

.rating {
    display: flex;
    margin-top: -30px;
    flex-direction: row-reverse;
    justify-content: center;
}

.rating input {
    display: none;
}

.rating label {
    position: relative;
    width: 1em;
    font-size: 30px;
    font-weight: 300;
    top: 12px;
    cursor: pointer;
}

.rating label:after {
    content: '☆';
    color: #8e8d8d;
    transition: all 0.4s ease-out;
    -webkit-font-smoothing: antialiased;
}

.rating label:hover:after {
    color: #989797;
    text-shadow: 0 0 15px #666;
}

.rating label.filled:after {
    content: '★';
    color: #F9BF3B;
    text-shadow: 0 0 20px #F9BF3B;
}


/*end style etoiles*/
.icon {
    margin-right: 20px;
}

.imgCertif {
    width: 400px;
    height: 300px;
    margin-left: 100px;
}

/*  Start Style Modal */
.modal-body label {
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

#description {
    height: 150px;
}

.modal-body input[type="text"],
.modal-body select,
.modal-body input[type="date"],
.modal-body input[type="tel"],
.modal-body input[type="password"],
.modal-body input[type="number"],
.modal-body input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.modal-body {
    padding: 20px 100px;
}

.form-column1 {
    float: left;
    width: 50%;
    margin-left: -70px;
}

.form-column2 {
    float: left;
    width: 50%;
    margin-left: 70px;
}

/* End  Style Modal */




.container-fluid {
    position: relative;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    background-color: var(--section-color);
}

.cover-container {
    position: relative;
    height: 100%;

}

.cover-image {
    width: 100%;
    height: 300px;
    border-radius: 10px;
}

.profile-image {
    position: absolute;
    top: 80%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    width: 15%;
    height: 67%;
    border: #ffffff solid 3px;
    padding-bottom: 0;
    margin-bottom: 0;
}

#cam {
    position: absolute;
    color: white;
    width: 2%;
    left: 49%;
    top: 108%;
    cursor: pointer;
    background-color: #ffffff;
    border-radius: 50%;
    padding: 2px;
}

#camImage {
    position: absolute;
    color: white;
    width: 2%;
    left: 97%;
    top: 80%;
    cursor: pointer;
    background-color: #dedddd;
    border-radius: 50%;
    padding: 2px;
}

.nom {
    margin-top: 4%;
    text-align: center;
}

.nom h5 {
    font-size: 140%;
    font-weight: bold;
    font-family: Calibri;
}

.nom a {
    color: #178FEB;
    text-decoration: none;
    font-family: Calibri;
    font-weight: bold;
    font-size: 110%;
}

.nom p {
    font-size: 90%;
    font-family: Calibri;
}

.pro section {
    background-color: #ffffff;
    border-radius: 10px;
    flex: 1;
}

.pro {
    margin-top: 1%;
    display: flex;
    justify-content: space-around;
    flex-direction: row-reverse;
    gap: 1%;
    width: 100%;
    text-align: center;
    background-color: transparent;
    margin-bottom: 1%;
}

#cv {
    max-width: 60% !important;
    display: flex;
    flex-direction: column;
    background-color: var(--section-color);
}

#information {
    padding: 1%;
    max-width: 40% !important;
    height: auto !important;
    padding-top: 2% !important;
    background-color: var(--section-color);
}

.pdf {
    border: none;
    cursor: pointer;
}

.pdf button {
    border: none;
    outline: none;
    color: black;
    transition: all .3s ease-in-out;
    background-color: transparent;
    float: inline-end;
    margin-right: 3%;
    margin-top: 2%;
}

.pdf button img {
    width: 45% !important;
    padding-top: 30%;
    padding-bottom: 30%;
}

#upload {
    background-image: url("@/assets/orange.png");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

#load {
    background-image: url("@/assets/bleu.png");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

.card {
    padding: 20px;
    width: auto;
    border: none;
    background-color: var(--section-color);
}

.card li {
    list-style: none;
    text-align: left;
    cursor: pointer;
    color: var(--text-section);
}

.champ {
    font-weight: bold;
    position: relative;
    text-align: left;
    font-size: 120%;
    padding-left: 4%;
}

.champ::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 30%;
    transform: translateX(-29%);
    width: 90%;
    border-bottom: #111111 solid 3px;
    border-color: var(--text-section);
}

.add {
    width: 4% !important;
    float: right;
    margin-right: 10px;
    padding-bottom: 10px;
}

.content {
    margin-top: 2% !important;
}

.content img {
    width: 25% !important;
    height: auto !important;
}

.content button {
    background-color: transparent;
    border: none;
}

.content div {
    width: 20%;
    display: inline-block;
    display: flex;
    flex-direction: row;
    align-items: center;
}

.content li {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    border-bottom: #dfdfdf solid 1px;
}

.personnel {
    display: flex;
    flex-direction: row;
    width: 98% !important;
}

.personnel h6 {
    color: #178FEB;
    font-weight: bold;
    font-size: 100%;
}

.personnel img {
    width: 60% !important;
    height: auto !important;
    margin-left: 3%;
    background-color: #dfdfdf;
    border-radius: 50%;
    padding: 5px;
    margin-top: -10px;
}

.personnel button {
    background-color: transparent;
    border: none;
    widows: 100% !important;
}

.info li {
    list-style: none;
    float: left;
    text-align: left;
    padding-right: 4%;
    font-size: .9em;
    margin-bottom: 30px;
    white-space: pre-wrap;

}

.info li strong {
    font-weight: bold;
    margin-right: 5px;
}

.info {
    display: flex;
    flex-direction: row;
    margin-top: 4%;
    gap: 1%;
    background-color: var(--section-color);
}

.compte {
    display: flex;
    flex-direction: column;
}

.mail {
    display: flex;
    flex-direction: column;
    white-space: normal;
}

.qr {
    display: flex;
    flex-direction: column;
    width: 40%;
    margin-top: 2%;
    align-items: center;
    margin-left: 30%;
}

.qr svg {
    margin-left: 90%;
}

.qr button {
    text-decoration: none;
    background-color: transparent;
    border: none;
    margin-top: 5%;
    color: #178FEB;
    font-weight: bold;
}

.passport {
    display: flex;
    flex-direction: row;
    justify-content: center;
    margin-top: 3%;
    margin-bottom: 3%;

}

.passport img {
    width: 7% !important;
}

.passport h2 {
    color: #178FEB;
    padding-top: 2%;
    padding-right: 1%;
    font-family: Impact;
}

.cadres {
    display: flex;
    flex-direction: row;
    gap: 1%;
    justify-content: center;
}

.cadres h2 {
    font-size: 150%;
    color: #178FEB;
    font-family: Impact;
    text-align: center;
    padding: 5%;
}

.cadres div {
    background-color: #E2F1F8;
    height: 400px !important;
    width: 23% !important;
    margin-bottom: 5% !important;
    border-radius: 10%;
}

.pass {
    border-radius: 2%;
    margin-right: 1%;
    margin-left: 1%;
    width: auto;
    background-color: var(--section-color);
}

.cover-container button {
    border: none;
}

#form div {
    display: flex;
    flex-direction: row;
}

@media screen and (max-width: 1100px) {
    .add {
        width: 5% !important;
        margin-right: 0px;
    }

    #camImage {

        left: 97%;
        top: 85%;
    }

    #cam {

        width: 3%;
        left: 49%;
        top: 104%;

    }

    .profile-image {
        top: 80%;
        left: 50%;
        width: 17%;
        height: 60%;

    }

    .content img {
        width: 30% !important;
        height: auto !important;
        margin-right: -5px;
        float: right;
    }

    .champ {
        font-size: 100% !important;
    }

    .content {
        font-size: 80%;
    }

    .personnel img {
        width: 60% !important;
    }

    .personnel h6 {
        font-size: 85% !important;
    }

    .cadres {
        gap: 2%;
    }
}

@media screen and (max-width: 800px) {
    .profile-image {
        top: 80% !important;
        width: 23% !important;
        height: 55% !important;
    }

    #camImage {
        width: 2%;
        left: 97%;
        top: 85%;
    }

    .personnel img {
        width: 47% !important;
    }

    .personnel h6 {
        font-size: 72% !important;
    }

    .cadres {
        flex-direction: column;
        width: 80%;
        margin-left: 15%;
    }

    .cadres div {
        width: 100% !important;
        margin-left: -6% !important;
    }
}

@media screen and (max-width: 700px) {
    .pro {
        flex-direction: column;
    }

    .pro section {
        flex: none;
    }

    #cv {
        min-width: 100% !important;
        margin: 0;
    }

    #information {
        min-width: 100% !important;
        margin-bottom: 1%;
    }

    .add {
        width: 4% !important;
        margin-right: 0px;
    }

    .content img {
        width: 30% !important;
        height: auto !important;
        margin-right: -5px;
        float: right;
    }

    .champ {
        font-size: 90% !important;
    }

    .content {
        font-size: 80%;
    }

    .personnel img {
        width: 50% !important;
    }

    .personnel {
        margin-left: 3% !important;
    }

}

@media screen and (max-width: 480px) {
    .cover-container {
        padding-top: 60px;
    }

    .profile-image {
        left: 17% !important;
        top: 90% !important;
        width: 30% !important;
        height: 35% !important;
    }

    #camImage {
        width: 5%;
        left: 96%;
        top: 81%;
    }

    .cover-image {
        height: 276px;
        width: 1920px;
    }

    .nom {
        margin-top: -10%;
        text-align: left;
        padding-left: 35% !important;
    }

    .nom h5 {
        font-size: 110%;
    }

    .nom p {
        font-size: 75%;
    }

    .rating {
        margin-top: -20px;
        margin-bottom: 5px;
        justify-content: left;
    }

    .rating label {
        width: 1em;
        font-size: 20px;
        font-weight: 100;
        top: 10px;
    }

    #cam {
        width: 5%;
        left: 5%;
        top: 101%;
        cursor: pointer;
        border-radius: 50%;
        padding: 2px;
    }



    .card {
        padding-left: 0;
    }

    .add {
        width: 6% !important;
        margin-right: 0px;
    }

    .content img {
        width: 50% !important;
        height: auto !important;
        margin-right: -5px;
        float: right;
    }

    .champ {
        font-size: 100% !important;
    }

    .content {
        font-size: 90%;
    }

    .personnel img {
        width: 50% !important;
        margin-top: 1px !important;
    }

    .personnel h6 {
        margin-top: 9px;
        font-size: 85% !important;
    }

    /*style modal consult langue*/
    .info2 {
        justify-content: center;
        /* Centrer le contenu horizontalement */
        list-style-type: none;
        /* Supprimer les puces de liste */
        padding: 0;
        /* Supprimer les marges internes */
        display: inline;
        /* Afficher les éléments <li> sur la même ligne */
        margin-right: 10px;
        list-style: none;

    }



    .info2 li {
        list-style: none;
        text-align: center;
        width: auto;
        /* Laisser la largeur s'adapter au contenu */
        /*white-space: nowrap;  Empêcher le saut de ligne dans les éléments li */
    }


}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1050;
}

.modal-dialog {
    border-radius: 8px;
    overflow: hidden;
}

.modal-content {
    width: 100%;
    max-width: 500px;
    /* Limite la largeur du modal */
    background-color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    animation: modalFadeIn 0.3s;
}

.modal-header {
    background-color: #f8f9fa;
    padding: 16px 20px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    margin: 0;
    font-size: 1.25rem;
}

.modal-body {
    padding: 20px;
    line-height: 1.5;
    font-size: 1.5rem;
}

.modal-footer {
    padding: 12px 20px;
    text-align: right;
    border-top: 1px solid #dee2e6;
}

.modal-content button {
    margin-left: 10px;
    padding: 8px 16px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.modal-body button {
    padding: 3px 10px !important;
    background-color: #a3a1a1 !important;
}

button.close {
    background-color: transparent;
    border: none;
    font-size: 1.5rem;
    color: #000;
}

a {
    cursor: pointer;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.loading-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100px;
    /* Adjust height as needed */
}

.spinner {
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-left-color: #3cba54;
    /* Change spinner color */
    border-radius: 50%;
    width: 30px;
    /* Adjust size of the spinner */
    height: 30px;
    /* Adjust size of the spinner */
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>