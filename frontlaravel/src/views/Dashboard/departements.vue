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
                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class=" modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Département</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nomDep" class="form-label">Nom Département</label>
                                            <input type="text" class="form-control" id="nomDep" v-model="nom"
                                                :class="{ 'is-invalid': showErrorMessage }" required>
                                            <div class="invalid-feedback" v-if="showErrorMessage">
                                                Le departement existe déjà !
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="abv" class="form-label">Abréviation</label>
                                            <input type="text" class="form-control" id="abv" v-model="abreviation"
                                                :class="{ 'is-invalid': showErrorMsg }" maxlength="3" required>
                                            <div class="invalid-feedback" v-if="showErrorMsg">
                                                L'abréviation existe déjà !
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-primary btn-sm"
                                    @click="addDepartment()">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card-header">
                        / Gestion des Départements
                    </div>
                    <div class="data">
                        <div class="dep">
                            <div class="titre">
                                <img src="@/assets/menu.png" alt="menu"> Départements :
                            </div>
                            <div>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div v-for="(item, index) in displayedItems" :key="index" class="accordion-item" >
                                <h2 class="accordion-header">
                                    <button @click="toggleAccordion(index)" class="accordion-button" type="button"
                                        :aria-expanded="isOpen[index]"
                                        :aria-controls="'#panelsStayOpen-collapse' + index">
                                        <span class="accordion-icon">
                                            <img
                                                :src="isOpen[index] ? require('@/assets/down.png') : require('@/assets/right.png')">
                                        </span>
                                        {{ item.nom }}
                                    </button>
                                    <div class="btn-droit">
                                        <button type="button" data-bs-toggle="modal" :data-bs-target="'#ModalAjout'+item.id"
                                            @click="selectedDepartmentId = item.id">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                        <button type="button" @click="confirmDeleteDep(item.id)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </h2>
                                <div :id="'panelsStayOpen-collapse' + index" class="accordion-collapse collapse"
                                    :class="{ 'show': isOpen[index] }">
                                    <h6 class="accordion-header">
                                        <div class="specialites">
                                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                                <div class="option"
                                                    v-for="(option, optionIndex) in filteredSpecialites(item.id)"
                                                    :key="optionIndex">
                                                    <div class="op">
                                                        <button @click="toggleAccordionClass(optionIndex)"
                                                            class="accordion-button" type="button"
                                                            :aria-expanded="isOpenClass[optionIndex]"
                                                            :aria-controls="'panelsStayOpen-collapse' + optionIndex">
                                                            <span class="accordion-icon">
                                                                <img
                                                                    :src="isOpenClass[optionIndex] ? require('@/assets/down.png') : require('@/assets/right.png')">
                                                            </span>
                                                            {{ option.abreviation }}
                                                        </button>
                                                        <div class="btn-droit">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#AjoutClasse"
                                                                @click="selectedSpecialiteId = option.id">
                                                                <i class="bi bi-plus-circle"></i>
                                                            </button>
                                                            <button @click="confirmDeleteSpec(option.id)" type="button">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div :id="'panelsStayOpen-collapse' + optionIndex"
                                                        class="accordion-collapse collapse"
                                                        :class="{ 'show': isOpenClass[optionIndex] }">
                                                        <div class="accordion-body">
                                                            <div class="classes">
                                                                <div class="option"
                                                                    v-for="(classe, classeIndex) in filteredClasses(option.id)"
                                                                    :key="classeIndex">{{ classe.abreviation }}
                                                                    <div class="btn-droit">
                                                                        <button @click="confirmDeleteClasse(classe.id)"
                                                                            type="button"><i
                                                                                class="bi bi-x-lg"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </h6>
                                </div>
                                <div class="modal fade " :id="'ModalAjout'+item.id" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class=" modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Spécialité
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label for="nomSpec" class="form-label">Nom
                                                                Spécialité</label>
                                                            <input type="text" class="form-control" id="nomSpec"
                                                                v-model="nomSpec"
                                                                :class="{ 'is-invalid': showErrorMessage }" required>
                                                            <div class="invalid-feedback" v-if="showErrorMessage">
                                                                La spécialité existe déjà !
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="abcSpec" class="form-label">Abréviation</label>
                                                            <input type="text" class="form-control" id="abcSpec"
                                                                v-model="abreviationSpec"
                                                                :class="{ 'is-invalid': showErrorMsg }" maxlength="3"
                                                                required>
                                                            <div class="invalid-feedback" v-if="showErrorMsg">
                                                                L'abréviation existe déjà !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    @click="addSpecialite(selectedDepartmentId)">Valider</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade " id="AjoutClasse" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class=" modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Classe</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label for="nomClasse" class="form-label">Nom Classe</label>
                                                            <input type="text" class="form-control" id="nomClasse"
                                                                v-model="nomClasse"
                                                                :class="{ 'is-invalid': showErrorMessage }" required>
                                                            <div class="invalid-feedback" v-if="showErrorMessage">
                                                                La classe existe déjà !
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="abcClasse"
                                                                class="form-label">Abréviation</label>
                                                            <input type="text" class="form-control" id="abcClasse"
                                                                v-model="abreviationClasse"
                                                                :class="{ 'is-invalid': showErrorMsg }" maxlength="3"
                                                                required>
                                                            <div class="invalid-feedback" v-if="showErrorMsg">
                                                                L'abréviation existe déjà !
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    @click="addClasse(selectedSpecialiteId)">Valider</button>
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
import DepartmentService from '@/services/departements.js'
import SpecialiteService from '@/services/specialites.js'
import ClasseService from '@/services/classes.js'

export default {
    data() {
        return {
            view: "departements",
            departments: [],
            specialites: [],
            classes: [],
            isOpen: [],
            isOpenClass: [],
            itemsPerPage: 5,
            currentPage: 1,
            nom: "",
            abreviation: "",
            nomSpec: "",
            abreviationSpec: "",
            nomClasse: "",
            abreviationClasse: "",
            showErrorMessage: false,
            showErrorMsg: false,
            selectedDepartmentId: null,
            selectedSpecialiteId: null,
        };
    },
    resetData() {
        this.departments = this.getDepartments();
    },
    computed: {
        totalPages() {
            return Math.ceil(this.departments.length / this.itemsPerPage);
        },
        displayedItems() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.departments.slice(startIndex, endIndex);
        }
    },
    methods: {
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
        filteredSpecialites(departmentId) {
            return this.specialites.filter(option => option.departement_id === departmentId);
        },
        filteredClasses(specialiteId) {
            //console.log(specialiteId);
            return this.classes.filter(option => option.specialite_id === specialiteId);
        },
        confirmDeleteSpec(specialite) {
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
                    this.deleteSpecialit(specialite);
                }
            });
        },
        confirmDeleteClasse(classe){
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
                    this.deleteClasse(classe);
                }
            });
        },
        confirmDeleteDep(department) {
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
                    this.deleteDepartement(department);
                }
            });
        },
        toggleAccordion(index) {
            this.isOpen[index] = !this.isOpen[index];
        },
        toggleAccordionClass(index) {
            this.isOpenClass[index] = !this.isOpenClass[index];
        },
        getDepartments() {
            DepartmentService.getAll().then((res) => {
                this.departments = res.data.data;
            })
        },
        getSpecialites() {
            SpecialiteService.getAll().then((res) => {
                this.specialites = res.data.data;
            })
        },
        getClasses() {
            ClasseService.getAll().then((res) => {
                this.classes = res.data.data;
            })
        },
        addDepartment() {
            if (!this.nom || !this.abreviation) {
                Swal.fire({
                    title: "Erreur !",
                    text: "Veuillez remplir tous les champs obligatoires.",
                    icon: "error",
                });
                return;
            }
            if (this.departments.some(departement => departement.nom.toLowerCase() === this.nom.toLowerCase())) {
                this.showErrorMessage = true;
                this.showErrorMsg = false;
                return;
            } else if (this.departments.some(departement => departement.abreviation.toLowerCase() === this.abreviation.toLowerCase())) {
                this.showErrorMessage = false;
                this.showErrorMsg = true;
                return;
            } else {
                const department = {
                    nom: this.nom,
                    abreviation: this.abreviation
                };
                DepartmentService.addDepartment(department)
                    .then(() => {
                        this.departments.push(department);
                        this.nom = "";
                        this.abreviation = "",
                            Swal.fire({
                                title: "Crée !",
                                text: "Votre departement a été crée !",
                                icon: "success",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.showErrorMessage = false;
                                    this.showErrorMsg = false;
                                }
                            });
                    })
                    .catch((error) => {
                        console.error("Error create department:", error);
                    });
            }
        },
        addSpecialite(id) {
            if (!this.nomSpec || !this.abreviationSpec) {
                Swal.fire({
                    title: "Erreur !",
                    text: "Veuillez remplir tous les champs obligatoires.",
                    icon: "error",
                });
                return;
            }
            if (this.specialites.some(specialite => specialite.nom.toLowerCase() === this.nomSpec.toLowerCase())) {
                this.showErrorMessage = true;
                this.showErrorMsg = false;
                return;
            } else if (this.specialites.some(specialite => specialite.abreviation.toLowerCase() === this.abreviationSpec.toLowerCase())) {
                this.showErrorMessage = false;
                this.showErrorMsg = true;
                return;
            } else {
                const specialite = {
                    nom: this.nomSpec,
                    abreviation: this.abreviationSpec,
                    departement_id: id
                };
                SpecialiteService.addSpecailite(specialite)
                    .then(() => {
                        this.specialites.push(specialite);
                        this.nomSpec = "";
                        this.abreviationSpec = "",
                            Swal.fire({
                                title: "Crée !",
                                text: "Votre spécialité a été crée !",
                                icon: "success",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.showErrorMessage = false;
                                    this.showErrorMsg = false;
                                }
                            });
                    })
                    .catch((error) => {
                        console.error("Error create specialite:", error);
                    });
            }
        },
        addClasse(id) {
            if (!this.nomClasse || !this.abreviationClasse) {
                Swal.fire({
                    title: "Erreur !",
                    text: "Veuillez remplir tous les champs obligatoires.",
                    icon: "error",
                });
                return;
            }
            if (this.classes.some(classe => classe.nom.toLowerCase() === this.nomClasse.toLowerCase())) {
                this.showErrorMessage = true;
                this.showErrorMsg = false;
                return;
            } else if (this.classes.some(classe => classe.abreviation.toLowerCase() === this.abreviationClasse.toLowerCase())) {
                this.showErrorMessage = false;
                this.showErrorMsg = true;
                return;
            } else {
                const classe = {
                    nom: this.nomClasse,
                    abreviation: this.abreviationClasse,
                    specialite_id: id
                };
                ClasseService.addClasse(classe)
                    .then(() => {
                        this.classes.push(classe);
                        this.nomClasse = "";
                        this.abreviationClasse = "",
                            Swal.fire({
                                title: "Crée !",
                                text: "Votre classe a été crée !",
                                icon: "success",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.showErrorMessage = false;
                                    this.showErrorMsg = false;
                                }
                            });
                    })
                    .catch((error) => {
                        console.error("Error create classe:", error);
                    });
            }
        },
        deleteDepartement(departement) {
            DepartmentService.deleteDepartment(departement).then(() => {
                this.getDepartments();
            })
        },
        deleteClasse(classe) {
            ClasseService.deleteClasse(classe).then(() => {
                this.getClasses();
            })
        },
        deleteSpecialit(specialite) {
            console.log(specialite);
            SpecialiteService.deleteSpecialite(specialite).then(() => {
                this.getSpecialites();
            })
        },
    },
    created() {
        this.isOpen = new Array(this.departments.length).fill(false);
        this.isOpenClass = new Array(this.specialites.length).fill(false);
        this.getDepartments();
        this.getSpecialites();
        this.getClasses();
    },
    components: {
        navbar,
    }
}
</script>
<style scoped>
@import "~bootstrap-icons/font/bootstrap-icons.css";

.accordion-button::after {
    display: none;
}

.accordion-button:focus {
    z-index: 0;
    border-color: transparent;
    outline: none;
    box-shadow: none; 
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
    justify-content: space-evenly;
    align-items: center;
    padding-bottom: 0 !important;
    padding-left: 0 !important;
    border: none;
    background-color: transparent;
    cursor: pointer;
    font-family: Agency FB;
    font-size: 160%;
    font-weight: bold;
    width: 300%;
    margin-left: 300% !important;
}

.op .btn-droit {
    display: flex;
    flex-direction: row;
    gap: 5px;
    width: 1%;
    margin-left: 0%;
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
    width: 280%;
    margin-left: 150% !important;
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
</style>