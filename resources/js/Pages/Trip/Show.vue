<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Slider from "../../Components/Slider.vue";

defineProps({
    trip: Object,
});

</script>

<template>
    <AppLayout>
        <section>
            <div class="container py-4">
                <Slider :title="trip.title + ' - ' + trip.duration" :images="trip.images"/>
                <h3 class="text-center">{{ trip.name }}</h3>
                <div v-html:='trip.long_description'></div>
                <div class="row">
                    <div class="col-9">
                            <table class="border table-bordered mt-4">
                                <tr>
                                    <td><b>Description: </b> &nbsp;&nbsp;</td>
                                    <td>{{ trip.description }}</td>
                                </tr>
                                <tr>
                                    <td><b>Duration: </b></td>
                                    <td>{{ trip.duration }}</td>
                                </tr>
                                <tr>
                                    <td><b>Price: </b></td>
                                    <td>{{ trip.price ?? 'Contact us for pricing' }}</td>
                                </tr>

                            </table>
                    </div>

                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a href="javascript:void(0);" class="btn bg-gradient-warning mb-0 cursor-pointer">Book {{ trip.name }} Now</a>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.border {
    border-color: var(--bs-gradient-dark-right)
}
</style>
