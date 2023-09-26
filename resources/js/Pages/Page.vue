<script setup>
    import AppLayout from "../Layouts/AppLayout.vue";
    import Slider from "../Components/Slider.vue";

    defineProps({
        page: Object,
    });

</script>

<template>
    <AppLayout>
        <section>
            <div class="container py-4">
                <Slider :title="page.title" :images="page.images"/>
                <div v-html:='page.content'></div>
            </div>
        </section>
    </AppLayout>
</template>
