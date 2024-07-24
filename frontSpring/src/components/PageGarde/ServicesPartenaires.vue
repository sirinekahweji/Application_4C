
<template>
    <div class="ServicesPartenaires">
        <h2>Services Partenaires<br>
            <span class="decription">Recrutez la prochaine génération de talents!</span></h2>
        <div class="service-icons-container">
            <div v-for="(item, index) in firstRow" :key="index" class="service-icon-container">
                <!-- Vos icônes ici -->
                <div class="circle-wrapper">
                    <div class="service-icon-background1" :style="{ backgroundColor: item.borderColor }"></div>
                    <div class="service-icon-background2" :style="{ backgroundColor: item.backgroundColor }"></div>
                    <img :src="item.img" class="service-icon" alt="ServicePartenaire-icon">
                </div>
                <p class="serviceDescription ">
                    {{ item.title }}
                </p>
            </div>
        </div>
        <!-- Deuxième ligne d'icônes -->
        <div class="service-icons-container">
            <div v-for="(item, index) in secondRow" :key="index" class="service-icon-container">
                <!-- Vos icônes ici -->
                <div class="circle-wrapper">
                    <div class="service-icon-background1" :style="{ backgroundColor: item.borderColor }"></div>
                    <div class="service-icon-background2" :style="{ backgroundColor: item.backgroundColor }"></div>
                    <img :src="item.img" class="service-icon" alt="ServicePartenaire-icon">
                </div>
                <p class="serviceDescription ">
                    {{ item.title }}
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.service-icons-container {
    display: flex;
    justify-content: center;
    gap: 30px;
}
.serviceDescription {
    font-family: 'Calibri';
    font-weight: bolder;
    font-size: 15px;
    text-align: center;
    
}

.service-icon-background1,
.service-icon-background2 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
}
.service-icon-background2 {
    width: 100px;
    height: 100px;
}
.service-icon-background1 {
    width: 120px;
    height: 120px;
}
.service-icon-background2 {
    width: 100px;
    height: 100px;
}
.service-icon {
    width: 60px;
    height: 60px;
    margin: 35px;
    position: relative;
    z-index:2;
    cursor:pointer;

}
.circle-wrapper {
    position: relative;
    width: 130px;
    height: 130px;
    cursor:pointer;
   

}

.service-icon-container {
        display: flex;
    flex-direction: column;
    align-items: center;
}
.decription {
    font-size: 15px;
    color: rgb(65, 64, 64);
}
.ServicesPartenaires h2 {
    font-family: 'Calibri';
}
.ServicesPartenaires {
    background-color: rgb(255, 255, 255);
    margin: 80px 0px;
    text-align: center;
    padding: 30px;
}
@media screen and (max-width: 700px) {

.service-icons-container {
flex-direction: column; 
align-items: center;
justify-content: center; 
margin: 0 auto; 
max-width: 150px; 
}

.service-icon-container {
width: 100%;
text-align: center; 
margin-bottom: 10px;
}
}
</style>

<script>
export default {
    data() {
        return {
            ServicesPartenaires: [
                { 
                    img: require("../../assets/PageGarde/iconworking.png"), 
                    title: "Publier votre offre d'emploi",
                    backgroundColor: "rgb(51,154,240)",
                    borderColor: "rgba(51, 154, 240, 0.5)" 
                },
                { 
                    img: require("../../assets/PageGarde/icon-search-for-the-candidate.png"), 
                    title: "Chercher des candidats",
                    backgroundColor: "rgb(232,219,219)", 
                    borderColor: "rgba(232,219,219,0.5)"
                },
                { 
                    img: require("../../assets/PageGarde/iconsemployee.png"), 
                    title: "Publier offre de stage",
                    backgroundColor: "rgb(128, 182, 39)", 
                    borderColor: "rgba(128, 182, 39, 0.7)" 

                },
                { 
                    img: require("../../assets/PageGarde/iconlecturer.png"), 
                    title: "Organiser une journée de carrière",
                    backgroundColor: "rgb(251, 196, 70)", 
                    borderColor: "rgba(251, 196, 70, 0.8)"
                }, 
                { 
                    img: require("../../assets/PageGarde/iconsdeal.png"), 
                    title: "Collaborer avec  4C Iset Bizerte",
                    backgroundColor: "rgb(128, 182, 39)", 
                    borderColor: "rgba(128, 182, 39, 0.7)" 
                },
                { 
                    img: require("../../assets/PageGarde/iconInformations.png"), 
                    title: "Conseil et formation",
                    backgroundColor: "rgb(232,219,219)", 
                    borderColor: "rgba(232,219,219,0.5)"
                },
            ],
        };
    },
    mounted() {
    },
    methods: {
        
    },
    computed: {
        // Divisez les données en deux tableaux
        firstRow() {
            return this.ServicesPartenaires.slice(0, 4);
        },
        secondRow() {
            return this.ServicesPartenaires.slice(4);
        }
    }
};
</script>
