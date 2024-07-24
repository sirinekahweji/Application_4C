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
                <div class="container">
                    <div v-if="loading" class="overlay"></div>
                    <div class="d-flex justify-content-center spinner" v-if="loading">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="card-header">
                        / Accès
                    </div>
                    <div class="data">
                        <div class="filter-bar">
                            <div class="bt">
                                <input type="text" class="search-input" placeholder="Recherche..."
                                    v-model="searchQuery">
                                <select class="select" v-model="selectedRole">
                                    <option value="">Tous les rôles</option>
                                    <option v-for="demande in demandesAcces" :key="demande.id" :value="demande.type">{{
                                        demande.type }}</option>
                                </select>
                            </div>
                            <button class="filter-button" @click="filtrerDonnees()"><i class="bi bi-funnel"></i>
                                Filtrer</button>
                            <div class="buttons-right">
                                <button class="download-button" @click="telechargerPDF()"><i class="bi bi-download"></i>
                                    Télécharger</button>
                                <button class="print-button" @click="imprimerPDF"><i class="bi bi-printer"></i>
                                    Imprimer</button>
                            </div>
                        </div>
                        <h4>Liste des accès des Enseignants</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">N°CIN</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prenom</th>
                                        <th scope="col">Gmail</th>
                                        <th scope="col">Telephone</th>
                                        <th scope="col">Demande</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(profil, index) in displayedItems" :key="index">
                                        <td>{{ profil.cin }}</td>
                                        <td>{{ profil.nom }}</td>
                                        <td>{{ profil.prenom }}</td>
                                        <td>{{ profil.email }}</td>
                                        <td>{{ profil.phoneNumber }}</td>
                                        <td>{{ findDemandeByIdUser(profil.id) ? findDemandeByIdUser(profil.id) : 'non trouvé' }}</td>
                                        <td>
                                            <router-link :to="{ name: 'Profile' }">
                                                <button class="action-button" type="button">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </router-link>
                                            <button class="action-button" type="button"
                                                @click="validerAcces(profil.id)">
                                                <i class="bi bi-check2"></i>
                                            </button>
                                            <button class="action-button" type="button"
                                                @click="confirmRefusAcces(profil.id)">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot v-if="totalPages > 1">
                                    <tr>
                                        <td colspan="7">
                                            <div class="pagination">
                                                <button @click="previousPage" :disabled="currentPage === 1"
                                                    class="page-button">Précédent</button>
                                                <span class="page-info">Page {{ currentPage }} / {{ totalPages }}</span>
                                                <button @click="nextPage" :disabled="currentPage === totalPages"
                                                    class="page-button">Suivant</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
import jsPDF from 'jspdf'
import 'jspdf-autotable'
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2'
import demandesAccesService from "@/services/demandesAcces.js";
import userService from "@/services/users"
import RoleService from '@/services/roles.js'

export default {
    data() {
        return {
            view: "acces",
            profils: [],
            demandesAcces: [],
            acceptées: [],
            roles: [],
            selectedRole: '',
            searchQuery: '',
            itemsPerPage: 10,
            currentPage: 1,
            loading: false
        };
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
        confirmRefusAcces(id) {
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, Réfuser !"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteDemande(id);
                }
            });
        },
        validerAcces(id) {
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, Accepter !"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteDemande(id);
                }
            });
        },
        recherche() {
            if (this.searchQuery === '') {
                this.getProfils();
            } else {
                this.profils = this.profils.filter(profil => {
                    return profil.nom.toLowerCase().includes(this.searchQuery.toLowerCase());
                });
            }
        },
        AccepteTeacher(filtrage) {
            const index = this.profils.indexOf(filtrage);
            if (index !== -1) {
                this.profils.acces = 1;
                this.profils.splice(index, 1);
                this.acceptées.push(filtrage);
            }
        },
        deleteTeacher(filtrage) {
            const index = this.profils.indexOf(filtrage);
            if (index !== -1) {
                this.profils.splice(index, 1);
            }
        },
        async filtrerDonnees() {
            if (!this.selectedRole) {
                this.profils = await this.getProfils();
            } else {
                const roleId = this.roles.find(role => role.nomRole === this.selectedRole)?.id;
                if (roleId) {
                    const profils = await this.getProfils();
                    if (profils && Array.isArray(profils)) {
                        this.profils = profils.filter(profil => profil.role_id === roleId);
                    } else {
                        console.error("Les données des profils sont incorrectes :", profils);
                    }
                } else {
                    console.warn("Rôle non trouvé pour le nom sélectionné :", this.selectedRole);
                }
            }
        },
        async telechargerPDF() {
            this.loading = true;
            const doc = new jsPDF();
            doc.text('Liste des enseignants', 10, 10);
            const profils = this.profils;
            const head = [['NCIN', 'Nom', 'Prenom', 'Gmail', 'Telephone', 'Type']];
            doc.autoTable({
                head: head
            });
            for (const filtrage of profils) {
                const role = await this.findRoleById(filtrage.role_id);
                const nomRole = role ? role.nomRole : 'N/A';
                doc.autoTable({
                    body: [[
                        filtrage.cin,
                        filtrage.nom,
                        filtrage.prenom,
                        filtrage.email,
                        filtrage.phoneNumber,
                        nomRole
                    ]],
                    startY: doc.autoTable.previous.finalY, // Espacement entre les tables
                    margin: { top: 20 }, // Espacement entre le texte et le tableau
                    columnStyles: {
                        0: { cellWidth: 25 }, // Largeur de la première colonne
                        1: { cellWidth: 25 }, // Largeur de la deuxième colonne
                        2: { cellWidth: 25 }, // Largeur de la troisième colonne
                        3: { cellWidth: 38 }, // Largeur de la quatrième colonne
                        4: { cellWidth: 43 }, // Largeur de la cinquième colonne
                        5: { cellWidth: 26 }  // Largeur de la sixième colonne
                    },
                    styles: {
                        cellPadding: 3, // Espacement entre le contenu et la bordure de la cellule
                        fontSize: 8,   // Taille de la police
                        valign: 'baseline', // Alignement vertical du contenu
                        halign: 'left' // Alignement horizontal du contenu
                    }
                });
            }
            doc.save('liste_enseignants.pdf');
            this.loading = false;
        },
        async imprimerPDF() {
            this.loading = true;
            const doc = new jsPDF();
            doc.text('Liste des enseignants', 10, 10);
            const profils = this.profils;
            const head = [['NCIN', 'Nom', 'Prenom', 'Gmail', 'Telephone', 'Type']];
            doc.autoTable({
                head: head
            });
            for (const filtrage of profils) {
                const role = await this.findRoleById(filtrage.role_id);
                const nomRole = role ? role.nomRole : 'N/A';
                doc.autoTable({
                    body: [[
                        filtrage.cin,
                        filtrage.nom,
                        filtrage.prenom,
                        filtrage.email,
                        filtrage.phoneNumber,
                        nomRole
                    ]],
                    startY: doc.autoTable.previous.finalY, // Espacement entre les tables
                    margin: { top: 20 }, // Espacement entre le texte et le tableau
                    columnStyles: {
                        0: { cellWidth: 25 }, // Largeur de la première colonne
                        1: { cellWidth: 25 }, // Largeur de la deuxième colonne
                        2: { cellWidth: 25 }, // Largeur de la troisième colonne
                        3: { cellWidth: 38 }, // Largeur de la quatrième colonne
                        4: { cellWidth: 43 }, // Largeur de la cinquième colonne
                        5: { cellWidth: 26 }  // Largeur de la sixième colonne
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
        async findRoleById(id) {
            try {
                const response = await RoleService.findById(id);
                return response.data.data;
            } catch (error) {
                console.error("Error fetching role by ID:", error);
                return null;
            }
        },
        async findDemandeByIdUser(id) {
            try {
                const response = await demandesAccesService.findByIdUser(id); 
                console.log(response.data.type);
                return response.data.type;
            } catch (error) {
                console.error("Erreur lors de la récupération de la demande :", error);
                return null; 
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
        getProfils() {
            userService.getAll().then((res) => {
                this.profils = res.data.data;
                return this.getAcces();
            })
        },
        getAcces() {
            demandesAccesService.index().then((res) => {
                const sortedDemandes = res.data.data.sort((a, b) => a.user_id - b.user_id);
                this.demandesAcces = sortedDemandes;
                const accessIds = res.data.data.map(demande => demande.user_id);
                this.profils = this.profils.filter(profil => accessIds.includes(profil.id));
                return this.profils;
            })
        },
        getRoles() {
            RoleService.getAll().then((res) => {
                this.roles = res.data.data;
            })
        },
        deleteDemande(id) {
            const demande = this.demandesAcces.find(demande => demande.user_id === id);
            demandesAccesService.delete(demande.id).then(() => {
                this.getProfils();
            })
        },
    },
    created() {
        this.$watch('searchQuery', () => {
            this.recherche();
        });
        this.getProfils();
        this.getRoles();
        this.getAcces();
    },
    computed: {
        totalPages() {
            const total = Math.ceil(this.profils.length / this.itemsPerPage);
            console.log('Total Pages:', total);
            return total;
        },
        displayedItems() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            const items = this.profils.slice(startIndex, endIndex);
            console.log('Displaying items from', startIndex, 'to', endIndex);
            return items;
        },
    },
    components: {
        navbar,
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
    padding-left: 4%;
    padding-right: 4%;
}

.filter-bar {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.bt {
    display: flex;
    margin-right: 10px;
}

.select {
    text-align: center;
    color: #5D5D5D;
    cursor: pointer;
    border-radius: 0 5px 5px 0;
    padding: 3px;
    background: #F3F4F6;
    border-color: #CACACA;
    font-family: Berlin Sans FB;
}

.search-input {
    padding: 3px;
    border-radius: 5px 0px 0px 5px;
    background: #F3F4F6;
    border-color: #CACACA;
    color: #5D5D5D;
    font-family: Agency FB;
    font-weight: bold;
    cursor: auto;
    font-size: 90%;

}

.filter-button {
    margin-right: 10px;
    border-radius: 5px;
    background-color: #F3F4F6;
    border: #CACACA solid 1px;
    padding: 4px 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    font-family: Agency FB;
    font-weight: bold;
    color: #5D5D5D;
}

.buttons-right {
    margin-left: auto;
}

.download-button,
.print-button {
    margin-left: 10px;
    margin-right: 10px;
    border-radius: 5px;
    background-color: #F3F4F6;
    border: #CACACA solid 1px;
    padding: 4px 10px;
    cursor: pointer;
    font-family: Agency FB;
    font-weight: bold;
    color: #5D5D5D;

}

.table {
    width: 100%;
}

h4 {
    font-family: Agency FB;
    padding-left: 1%;
    margin-top: 2%;
}

thead th {
    color: #6A6A6A;
    font-family: Agency FB;
    font-weight: bold;
    font-size: 120%;
}

td {
    font-size: 80%;
    color: var(--text-color);
}

button {
    border: none;
    background-color: #FFFFFF;
    padding: 2%;
}

i {
    color: var(--icon-color);
}

@media screen and (max-width: 1000px) {
    .table {
        width: auto;
    }

    .filter-bar button {
        width: 100% !important;
        margin: 3px;
        text-align: center !important;
    }

    .filter-bar {
        display: block;
    }

    .filter-button {
        text-align: center !important;
        padding-left: 40%;
    }

    .bt {
        text-align: center;
    }

    .bt .search-input {
        width: 70% !important;
    }

    .bt select {
        width: 70% !important;
    }
}

.modal-dialog {
    width: 80% !important;
    height: auto !important;
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

.action-button {
    background-color: var(--card-color);
}

.action-button i {
    color: var(--text-color);
}

tfoot button {
    background-color: var(--button-bg);
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.spinner {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.pagination {
    display: flex;
    justify-content:flex-start;
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