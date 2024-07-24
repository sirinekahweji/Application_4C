<template>
    <div class="buttons">
        <button type="button" @click="downloadPDF()" class="btn btn-primary btn-fill float-right">Télécharger</button>
        <button type="button" @click="BackToAffiche()" class="btn btn-danger btn-fill float-right">Retour</button>
    </div>
    <div class="cv">

        <main class="l-main bd-container">
            <!-- Resume CV -->
            <div class="resume" id="area-cv">
                <div class="resume_left">

                    <!-- HOME -->
                    <section class="home" id="home">
                        <div class="home_container section bd-grid">

                            <div class="home_data bd-grid">
                                <img :src="getImageSource()" alt="Icon picture" class="home_img" id="home-img">
                                <!--<img alt="Icon picture" class="home_img" id="home-img">-->
                                <h1 class="home_title"><b>{{ user.prenom }} <span>{{ user.nom }}</span></b></h1>
                                <h3 class="home_profession"
                                v-if="this.user.user_type === 'Etudiant' || this.user.user_type === 'Enseignant'">{{
                                    user.user_type }}</h3>
                                <div class="info" v-if="user.user_type === 'Etudiant'">
                                    <p>{{ specialite.nom }}</p>
                                    <p>{{ Etudiant.etablissement }}</p>
                                </div>
                                <div class="info" v-if="user.user_type === 'Enseignant'">
                                    <p>{{ Enseignant.etablissement }}</p>
                                </div>
                                <div class="infoPersonnel" v-if="this.user.user_type === 'PersonnelEntreprise'">
                                    <p>{{ this.personnel.fonctionnalite }}</p>
                                </div>
                            </div>

                            <div class="home_address bd-grid">
                                <span class="home_information">
                                    <i class="fa-solid fa-location-dot home_icon"></i> {{ user.adresse }}
                                </span>
                                <span class="home_information">
                                    <a href="#" class="home_link">
                                        <i class="fa-solid fa-envelope home_icon"></i> {{ user.email }}
                                    </a>
                                </span>
                                <span class="home_information">
                                    <a href="#" class="home_link">
                                        <i class="fa-solid fa-phone home_icon"></i>{{ user.phoneNumber }}
                                    </a>
                                </span>
                                <span class="home_information">
                                    <a href="#" class="home_link">
                                        <i class="fa-brands fa-linkedin social_icon"></i>{{ user.lienLinkdIn }}
                                    </a>
                                </span>

                            </div>
                        </div>

                    </section>
                    <!-- SKILLS  -->
                    <section class="skills section" id="skills">
                        <h2 class="section-title">Compétences</h2>
                        <div class="skills_container">
                            <div>
                                <div class="languages_name" v-for="Compétence in Compétences" :key="Compétence.id">
                                    <span class="skills_text">{{ Compétence.nom }}</span>

                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- LANGUAGES -->
                    <section class="languages section" id="languages">
                        <h2 class="section-title">Langues</h2>

                        <div class="languages_container">
                            <ul class="languages_content bd-grid">
                                <li class="languages_name" v-for="language in Langues" :key="language.id">
                                    <span class="languages_text">{{ language.nom }}</span>

                                </li>
                            </ul>
                        </div>
                    </section>

                </div>

                <div class="resume_right">

                    <!-- EDUCATION -->
                    <section class="education section" id="education">
                        <h2 class="section-title">Formation Académique</h2>

                        <div class="education_container bd-grid">
                            <div class="education_content" v-for="education in FormationAcadémique" :key="education.id">
                                <div class="education_time">
                                    <span class="education_rounder"></span>
                                    <span v-if="education.dateFin" class="education_line"></span>
                                </div>
                                <div class="education_data bd-grid">
                                    <h3 class="education_title">{{ education.diplome }}</h3>
                                    <span class="education_studies">{{ education.etablissement }}</span>
                                    <span class="education_year">{{ education.dateDebut }} - {{ education.dateFin ?
                                        education.dateFin : 'present' }}</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- CERTIFICATES -->
                    <section class="certificate section" id="certificates">
                        <h2 class="section-title">Certifications</h2>

                        <div class="certificate_container bd-grid">
                            <div class="certificate_content" v-for="certificate in Certifications"
                                :key="certificate.id">
                                <div class="certificate_item">
                                    <span class="certificate_rounder"></span>
                                </div>
                                <div class="certificate_data bd-grid">
                                    <h3 class="certificate_year">{{ certificate.date }}</h3>
                                    <span class="certificate_title">{{ certificate.titre }}</span>
                                </div>
                            </div>
                        </div>
                    </section>


                    <!-- EXPERIENCE -->
                    <section class="experience section" id="experience">
                        <h2 class="section-title">Experience</h2>

                        <div class="experience_container bd-grid">
                            <div class="experience_content" v-for="exp in Expériences" :key="exp.id">
                                <div class="experience_time">
                                    <span class="experience_rounder"></span>
                                    <span v-if="exp.dateFin" class="experience_line"></span>
                                </div>
                                <div class="experience_data bd-grid">
                                    <h3 class="experience_title">{{ exp.poste }}</h3>
                                    <span class="experience_company">{{ exp.entreprise }} | {{ exp.lieu }}</span>
                                    <span class="experience_year">{{ exp.dateDebut }} | {{ exp.dateFin ? exp.dateFin :
                                        'present' }}</span>
                                    <p class="experience_description">{{ exp.description }}</p>
                                </div>

                            </div>
                        </div>
                    </section>

                    <!-- INTERESTS -->


                </div>
            </div>
        </main>
    </div>
</template>
<script>
import html2pdf from 'html2pdf.js';
export default {
    data() {
        return {

        };
    },
    props: {

        specialite: Array,
        user: Array,
        Compétences: Array,
        Langues: Array,
        Expériences: Array,
        Certifications: Array,
        FormationAcadémique: Array,
        departement: Array,
        Etudiant: Array,
        Enseignant: Array,
        personnel: Array,
    },
    methods: {
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

        BackToAffiche() {
            this.$emit("changerView", 'profile');
        },
        downloadPDF() {
            const options = {
                margin: 1,
                filename: `cv.pdf`,
                image: { type: 'png', quality: 0.1 },
                html2canvas: { scale: 3, windowHeight: document.body.scrollHeight },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().from(document.getElementsByClassName("cv")[0]).set(options).save();
        }
        // Autres méthodes du composant cv...
    },
};
</script>
<style scoped>
/* Réinitialisation des marges et des rembourrages */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Style du corps */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.profile_description {
    color: var(--side-nav);
}

/* Style de la classe cv */
.cv {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 10%;
}

/* Style de l'en-tête */
.l-header {
    text-align: center;
    margin-bottom: 30px;
    color: var(--side-nav);
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav_logo {
    font-size: 24px;
    font-weight: bold;
    color: var(--side-nav);
    text-decoration: none;
}

.nav_menu {
    display: none;
}

.nav_list {
    list-style: none;
    display: flex;
}

.nav_item {
    margin-right: 20px;
}

.nav_link {
    text-decoration: none;
    color: var(--side-nav);
    font-weight: bold;
}

/* Style du contenu principal */
.l-main {
    display: flex;
}

.resume {
    width: 100%;
    padding-right: 20px;
    display: flex;
    flex-direction: row;
    color: var(--side-nav);
}

.resume_right {
    padding: 30px;
    flex-grow: 3;
    box-sizing: border-box;
}

.resume_left img {
    width: 60%;
    border-radius: 50%;
    margin-top: 4%;
}

.resume_left {
    background-color: #EBE6E4;
    padding: 20px;
    width: 100%;
    height: auto;
    box-sizing: border-box;
}

.home_data {
    text-align: center;
    color: var(--side-nav);
}

.home_data .home_title {
    font-size: 120%;
    margin-top: 4%;
    color: var(--side-nav);
}

.home_data .home_title b {
    color: var(--side-nav);
}

.home_data .home_profession {
    font-size: 100%;
    margin: 4%;
    margin-bottom: 20%;
    color: var(--side-nav);
}

.home_address {
    display: flex;
    flex-direction: column;
    color: var(--side-nav);
    margin-bottom: 15%;
}

.home_address a {
    text-decoration: none;
    color: var(--side-nav);
}

.home_address span {
    display: flex;
    flex-direction: row;
    gap: 3%;
    align-items: center;
    font-size: 90%;
    margin-bottom: 5%;
    color: var(--side-nav);
}

i {
    width: 20px;
    margin-right: 0%;
    color: var(--side-nav);
}

.section {
    margin-bottom: 7%;
    display: flex;
    flex-direction: column;
}

.section .section-title {
    margin-bottom: 4%;
    font-family: ui-monospace;
    font-weight: bold;
    color: var(--side-nav);
}





.skills_name {
    display: flex;
    flex-direction: row-reverse;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 10px;
    color: var(--side-nav);
}

.skills_name::before {
    content: "";
    flex: 0 0 auto;
    width: 100px;
    height: 10px;
    background-color: var(--side-nav);
    margin-left: 10px;
    justify-self: center;
}

.skills_progress {
    display: block;
    height: 100%;
    background-color: #4caf50;
    /* Couleur de la barre de progression */
}

span {
    margin-right: 0;
    width: 100%;
    color: var(--side-nav);
}

.languages_name {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 10px;
}

.experience_data,
.certificate_data,
.education_data {
    display: flex;
    flex-direction: column;
    margin-left: 3%;
    color: var(--side-nav);
}

.experience_title,
.education_title {
    font-weight: bold;
    font-size: 110%;
    margin-bottom: 1%;
    color: var(--side-nav);
}

.experience_company,
.education_studies {
    font-size: 90%;
    font-weight: bold;
    margin-bottom: 1%;
    color: var(--side-nav);
}

.experience_year,
.education_year {
    font-size: 85%;
    margin-bottom: 1%;
    color: var(--side-nav);
}

.experience_description {
    font-size: 85%;
    color: #868686;
    font-weight: bold;
    margin-bottom: 5%;

}

.certificate_year {
    font-size: 90%;
    margin-bottom: 1% !important;
}

.certificate_year::before {
    content: "*";
    display: inline-block;
    margin-right: 15px;
    /* Ajustez selon vos préférences */
    color: #575656;
}

.certificate_title {
    font-size: 90%;
    margin-left: 5% !important;
    margin-bottom: 5%;
}

.education_content {
    margin-bottom: 5% !important;
}

.interests_container {
    display: flex;
    flex-wrap: wrap;
    gap: 6%;
    margin-left: 5%;
}

.interests_content {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #aaaaaa;
    margin-bottom: 4%;
}

.resume_right>section {
    page-break-after: auto;
}

.buttons {
    margin-top: 8%;
    margin-bottom: 2%;
    margin-left: 2%;
    display: flex;
    gap: 1%;
}

.buttons button {
    padding: 10px;
}

.info {
    margin: -20%;
    text-align: center;
    font-size: 12px;
    padding-bottom: 30%;
}
.infoPersonnel{
    margin: 2%;
    text-align: center;
    font-size: 12px;
}

@media screen and (max-width: 1000px) {
    .buttons {
        margin-top: 15%;
    }
}

@media screen and (max-width: 570px) {
    .buttons {
        margin-top: 22%;
        margin-left: 5%;
    }

    .cv {
        width: 100%;
        font-size: 10px;
    }

    .resume_left {
        width: 50%;
        padding: 2%;
    }

    .resume_right {
        padding: 3%;
    }

    .profile_description {
        font-size: 70%
    }

    .section {
        margin-bottom: 2%;
    }

    .section-title {
        font-size: 120%;
    }

    .home_address {
        margin-bottom: 1%;
        font-size: 70%;
    }

    .home_address i {
        margin-right: 0px;
    }

    .home_address span {
        margin-left: 1px;
    }

    .home_title {
        font-size: 90% !important;
    }

    .home_profession {
        margin-bottom: 7% !important;
        font-size: 80% !important;
    }

    .social_container {
        font-size: 70% !important;
    }

    .skills_name::before {
        width: 50px;
        height: 7px;
    }

    .skills_name {
        font-size: 80% !important;
    }

    .languages_name {
        font-size: 80% !important;
    }

    .languages_stars i {
        width: auto;
    }

    .experience_title,
    .education_title {
        font-size: 90%;
    }

    .experience_company,
    .education_studies,
    .certificate_title {
        font-size: 80%;
    }

    .experience_year,
    .education_year {
        font-size: 80%;
    }

    .certificate_data {
        font-size: 90%;
    }

    .experience_description {
        font-size: 80% !important;
    }

    .interests_content {
        font-size: 80% !important;
    }
}
</style>