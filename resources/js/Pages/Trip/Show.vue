<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import {defineComponent} from "vue";
import PluralizeDay from "../../Components/PluralizeDay.vue";

defineProps({
    trip: Object,
});

defineComponent({
    PluralizeDay,
})

</script>

<template>
    <AppLayout>
        <section>
            <div class="container py-4">
                <h3 class="text-center">{{ trip.name }}</h3>
                <div v-html:='trip.long_description'></div>
                <div class="row">
                    <div class="col-9">
                        <table class="table table-bordered table-fixed-layout mt-4">
                            <colgroup>
                                <col style="width: 20%;" />
                                <col style="width: 30%;" />
                            </colgroup>
                            <tbody>
                            <tr>
                                <td><b>Description: </b></td>
                                <td>{{ trip.description }}`</td>
                            </tr>
                            <tr>
                                <td><b>Duration: </b></td>
                                <td><PluralizeDay :duration="trip.duration" /></td>
                            </tr>
                            <tr>
                                <td><b>Price: </b></td>
                                <td>{{ trip.price ?? 'Contact us for pricing' }}</td>
                            </tr>
                            <tr></tr>
                            </tbody>
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
