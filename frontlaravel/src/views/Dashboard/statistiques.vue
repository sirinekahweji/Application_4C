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
                <div class="card-container">
                    <card v-for="(card, index) in cards" :key="index" :name="card.name" :nombre="card.nombre"
                        :icone="card.icone" :background="card.background" />
                </div>
                <div>
                    <div>
                        <chart></chart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import navbar from '@/components/navbar.vue'
import Card from '@/components/Dashboard/dashboard/card.vue';
import chart from '@/components/Dashboard/dashboard/chart.vue';
import BadgeService from '@/services/badges.js'
import CertificatService from '@/services/certificat4cs.js'
import Formation4cService from '@/services/formations4c.js'
import EntrepriseService from '@/services/entreprises.js'
import EtudiantService from '@/services/etudiants.js'
import EnseignantService from '@/services/enseignants.js'
import UserService from '@/services/users.js'
import EventService from '@/services/evenements.js'
import router from '@/router';

export default {
    data() {
        return {
            view: "dashboard",
            cards: [
                { name: 'Formations', nombre: 0, icone: require("@/assets/formation.png"), background: "#C3D986" },
                { name: 'Certificats', nombre: 0, icone: require("@/assets/certif.png"), background: "#FE699A" },
                { name: 'Evénements', nombre: 0, icone: require("@/assets/event.png"), background: "#F6BC61" },
                { name: 'Partenaires', nombre: 0, icone: require("@/assets/partenaire.png"), background: "#17BAEE" },
                { name: 'Etudiants', nombre: 0, icone: require("@/assets/etudiant.png"), background: "#C3D986" },
                { name: 'Enseignants', nombre: 0, icone: require("@/assets/enseignant.png"), background: "#FE699A" },
                { name: 'Managers', nombre: 0, icone: require("@/assets/manager.png"), background: "#F6BC61" },
                { name: 'Badges', nombre: 0, icone: require("@/assets/badge.png"), background: "#17BAEE" },
            ]
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
        countBadge() {
            BadgeService.countBadge().then((res) => {
                this.cards[7].nombre = res.data.count;
            })
        },
        countCertificat() {
            CertificatService.countCertif().then((res) => {
                this.cards[1].nombre = res.data.count;
            })
        },
        countFormation4c() {
            Formation4cService.countFormations4c().then((res) => {
                this.cards[0].nombre = res.data.count;
            })
        },
        countEntreprise() {
            EntrepriseService.countEntreprise().then((res) => {
                this.cards[3].nombre = res.data.count;
            })
        },
        countEtudiant() {
            EtudiantService.countEtudiants().then((res) => {
                this.cards[4].nombre = res.data.count;
            })
        },
        countEnseignant() {
            EnseignantService.countEnseignants().then((res) => {
                this.cards[5].nombre = res.data.count;
            })
        },
        countManagers() {
            UserService.countManagers().then((res) => {
                this.cards[6].nombre = res.data.count;
            })
        },
        countEvents() {
            EventService.count().then((res) => {
                this.cards[2].nombre = res.data.count;
            })
        },
    },
    created() {
        this.countBadge();
        this.countCertificat();
        this.countFormation4c();
        this.countEntreprise();
        this.countEtudiant();
        this.countEnseignant();
        this.countManagers();
        this.countEvents();
    },
    components: {
        navbar,
        Card,
        chart
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

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 50px;
    margin-top: 60px;
}

.card-row {
    width: 100%;
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
}

.card {
    width: calc(25% - 20px);
    margin-bottom: 20px;
    box-sizing: border-box;
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
</style>