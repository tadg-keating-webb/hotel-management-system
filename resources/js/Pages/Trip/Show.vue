<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";

defineProps({
    trip: Object,
});

</script>

<template>
    <AppLayout>
        <section>
            <div class="container py-4">
                <h3 class="text-center">{{ trip.name }}</h3>
                <div v-html:='trip.long_description'></div>
            </div>
        </section>
    </AppLayout>
</template>
