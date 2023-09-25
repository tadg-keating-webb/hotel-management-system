<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import PluralizeDay from "../../Components/PluralizeDay.vue";
import { Link } from "@inertiajs/vue3";
import {defineComponent} from "vue";

defineProps({
    trips: Object,
});

defineComponent({
    PluralizeDay,
})

</script>

<template>
    <AppLayout>
        <section>
            <div class="container py-4">
                <h3 class="text-center">Our Most Popular Trips</h3>
                <section class="py-6 bg-gray-100">
                    <div class="container">
                        <div class="row">
                            <div v-for="(trip, index) in trips" class="col-lg-4 mb-lg-0 mb-4" :class="{'mt-4': index >= 3}">
                                <div class="card">
                                    <div class="p-0 mx-3 mt-3 position-relative z-index-1">
                                        <Link :href="route('trip.show', trip)" :class="'d-block'">
                                            <img :src="'/storage/' + trip.image" class="img-fluid border-radius-lg">
                                        </Link>
                                    </div>
                                    <div class="card-body pt-3">
                                        <Link :href="route('trip.show', trip)" :class="'card-title h5 d-block text-darker'">{{ trip.name }} - <PluralizeDay :duration="trip.duration" /></Link>
                                        <p v-html="trip.description" class="card-description mb-4">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </AppLayout>
</template>
