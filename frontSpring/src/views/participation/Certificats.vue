<template>
    <div>
        <span id="top"></span>
        <navBar></navBar>
        <section>
            <div class="list" style="margin-right: 0px;">
                <div class="col-md-3" style="width:267px">
                    <information_personnel></information_personnel>
                </div>
                <div class="liste-post col-md-9" style="width:82%">
                    <certificats></certificats>
                </div>
            </div>
        </section>
        <div class="button">
            <a href="#top"><i class="fa-solid fa-arrow-up"></i></a>
        </div>
    </div>
</template>

<script>
import navBar from "@/components/navbar.vue";
import information_personnel from "@/components/Accueil/information-personnel.vue";
import certificats from "@/components/participation/certificats.vue"

export default {
    name: "app",
    components: {
        navBar,
        information_personnel,
        certificats
    },
}
</script>

<style scoped>
.information_personnel {
    position: fixed;
}

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

.list {
    display: flex;
    flex-direction: row;
    gap: 0;
}

.liste-post {
    width: 75%;
    min-height: 68ch;
    height: auto;
    margin-top: -10px !important;
    background-color: var(--bg-participation);
    background-image: var(--bg-participation);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
}

@media screen and (max-width: 1050px) {
    .liste-post {
        width: 80% !important;
    }

    .information_personnel {
        display: none;
    }
}

@media screen and (max-width: 920px) {
    .liste-post {
        width: 100% !important;
    }

    .information_personnel {
        display: none;
    }
}
</style>