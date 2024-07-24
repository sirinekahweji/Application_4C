<template>
    <div class="statistiquePageGarde">
        <div v-for="(item, index) in statisticItems" :key="index" class="groupstat" >
            <p :class="{ 'textStat': true, 'last-textStat': index === statisticItems.length - 1 }">
                <span class="counter" v-text="animatedNumbers[index]"></span><br>
                {{ item.title }}
            </p>
        </div>
    </div>
</template>

<script>
import CertificatService from '@/services/certificat4cs.js'
import Formation4cService from '@/services/formations4c.js'
import EtudiantService from '@/services/etudiants.js'
import EnseignantService from '@/services/enseignants.js'
import EventService from '@/services/evenements.js'
export default {
    created(){
        this.countCertificat();  
        this.countFormation4c();  
        this.countEtudiant();
        this.countEnseignant();
        this.countEvent();
    },
    data() {
        return {
            statisticItems: [
                { title: "Formations", target: 0 },
                { title: "Certifications", target: 0 },
                { title: "Evénements", target: 0 },
                { title: "Etudiants", target: 0 },
                { title: "Enseignants", target: 0 }
            ],
            animatedNumbers: new Array(5).fill(0) 
        };
    },
    mounted() {
        this.animateCounters();
    },
    methods: {
        countEtudiant() {
            EtudiantService.countEtudiants().then((res) => {
                this.statisticItems[3].target = res.data.count;
                this.animateCounters();
            })
        },
        countEnseignant() {
            EnseignantService.countEnseignants().then((res) => {
                this.statisticItems[4].target = res.data.count;
                this.animateCounters();
            })
        },
        countCertificat() {
            CertificatService.countCertif().then((res) => {
                this.statisticItems[1].target = res.data.count;
                this.animateCounters();
            })
        },
        countFormation4c() {
            Formation4cService.countFormations4c().then((res) => {
                this.statisticItems[0].target = res.data.count;
                this.animateCounters();
            })
        },
        countEvent() {
            EventService.count().then((res) => {
                this.statisticItems[2].target = res.data.count;
                this.animateCounters();
            })
        },
        animateCounters() {
            const steps = this.statisticItems.map(item => Math.ceil(item.target / 100)); 

            const intervals = this.statisticItems.map((item, index) => {
                return setInterval(() => {
                    this.animatedNumbers[index] += steps[index];
                    if (this.animatedNumbers[index] >= item.target) {
                        this.animatedNumbers[index] = item.target;
                        clearInterval(intervals[index]);
                    }
                }, 30); 
            });
        }
    }
};
</script>

<style scoped>
.counter{
    color: white;
}
.statistiquePageGarde {
    background-color: rgba(0, 161, 255, 0.7); 
    border-radius: 15px;
    display: flex; 
    width: 660px;
    height: 68px;
    text-align: center;
    margin-top: 60px;
    margin-left: 130px;
}

.textStat {
    font-size: 17px;
    text-align: center;
    border-right: 2px solid white; 
    padding: 0px 16px;
    margin: 10px 0px;
    color:white;


}


.last-textStat{
    border-right: none; 
    color:white;

}

</style>