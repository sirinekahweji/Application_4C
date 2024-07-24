<template>
  <div class="chart-container">
    <div class="chart-wrapper">
      <p class="chart-title">Nombre de participants aux certificats et formations</p>
      <canvas id="myChart1"></canvas>
    </div>
    <div class="chart-wrapper">
      <p class="chart-title">Nombre total de participants</p>
      <canvas id="myChart2"></canvas>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import Chart from 'chart.js/auto';
import participantsFormationsService from '@/services/participantsFormations';
import participantsCertificatsService from '@/services/participantsCertificats';

export default {
  setup() {
    const participantFormations = ref([]);
    const participantCertificats = ref([]);
    const total = ref([]);
    let ctx1; 
    let ctx2;

    onMounted(async () => {
      try {
        const counts = await participantsFormationsService.countparticipant();
        const countsCertif = await participantsCertificatsService.countparticipant();
        participantFormations.value = counts.data.participant; 
        participantCertificats.value = countsCertif.data.participant;
        for (let i = 0; i < participantFormations.value.length; i++) {
          total.value[i] = participantFormations.value[i] + participantCertificats.value[i];
        }

        ctx1 = document.getElementById('myChart1'); 
        ctx2 = document.getElementById('myChart2');

        new Chart(ctx1, {
          type: 'line',
          data: {
            labels: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [
              {
                label: 'Certificats',
                data: participantCertificats.value,
                borderWidth: 1
              },
              {
                label: 'Formations',
                data: participantFormations.value,
                borderWidth: 1
              }
            ]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        new Chart(ctx2, {
          type: 'line',
          data: {
            labels: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
              label: 'Nombre Total',
              data: total.value, 
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      } catch (error) {
        console.error('Error fetching participant formations:', error);
      }
    });

    return {
      participantFormations,
      participantCertificats
    };
  }
};
</script>

<style scoped>
.chart-container {
  display: flex;
  justify-content: space-evenly;
}

.chart-container>div {
  width: 40%;
  border: 2px;
  margin: 1% 0;
  padding: 16px;
  background-color: #FFFFFF;
  box-shadow: 0px 0px 10px grey;
  border-radius: 3%;
  background-color: var(--card-color);
}

.chart-title {
  font-weight: bold;
  font-size: 70%;
}

@media (max-width: 920px) {
  .chart-container {
    flex-direction: column;
  }

  .chart-container>div {
    width: 90%;
    margin-left: 5% !important;
    margin-bottom: 15%;
  }
}
</style>
