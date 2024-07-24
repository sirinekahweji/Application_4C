<template>
    <span id="top"></span>
    <navBar></navBar>
    <section>
        <div class="row" style="margin-right: 0px;">
            <div class="col-md-3">
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
            
        </div>
                
                
                
            </div>
          
          
          
           <div class="liste-post col-md-9">
                <BadgesD></BadgesD>
            </div>
            <div class="liste-post col-md-9">

            </div>
        </div>
    </section>
    <div class="button">
        <a href="#top"><i class="fa-solid fa-arrow-up"></i></a>
    </div>
</template>

<script>
import navBar from "@/components/navbar.vue";

import BadgesD from "@/components/Dashboard/BadgesDetails.vue"

export default {
    name: "app",
    components: {
        navBar,
        BadgesD,
    },
}
</script>

<style scoped>
section {
    padding-top: 80px;
}


.buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #808080;
}

.buttons>button {
    padding: 5px 10px;
    background: lightgrey;
    color: #808080;
    text-transform: uppercase;
    border: none;
    outline: none;
    border-radius: 3px;
    cursor: pointer;
}

.buttons>button.abled {
    background: blue;
    color: #fff;
}

.button a {
    position: fixed;
    bottom: 20px;
    right: 20px;
    color: #fff;
    background: #2980b9;
    padding: 7px 12px;
    ;
    font-size: 18px;
    border-radius: 6px;
    box-shadow: rgba(0, 0, 0, 0.15);
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


</style>