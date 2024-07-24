<template>
    <div>
        <span id="top"></span>
        <navBar></navBar>
        <section>
            <div class="row" style="margin-right: 0px;">
                <div class="col-md-3">
                    <information_personnel></information_personnel>
                </div>
                <div class="liste-post col-md-9">
                    <EvenementD></EvenementD>
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
import EvenementD from "@/components/participation/EvenementDetail.vue"


export default {
    name: "app",
    components: {
        navBar,
        information_personnel,
        EvenementD
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
</style>