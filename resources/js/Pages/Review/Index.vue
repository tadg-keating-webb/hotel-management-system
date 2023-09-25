<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";

defineProps({
    reviews: Object,
});

</script>

<style scoped>
.star-rating {
    display: inline-block;
    font-size: 2em;
}

.star-rating::before {
    content: "★"; /* Unicode star character for filled star */
    color: #f0d419; /* Color of filled stars */
    margin-right: 2px; /* Adjust spacing between stars */
}

.star-rating[data-rating="1"]::before {
    content: "★";
}

.star-rating[data-rating="2"]::before {
    content: "★★";
}

.star-rating[data-rating="3"]::before {
    content: "★★★";
}

.star-rating[data-rating="4"]::before {
    content: "★★★★";
}

.star-rating[data-rating="5"]::before {
    content: "★★★★★";
}
</style>

<template>
    <AppLayout>
        <section>
            <div class="container py-4">
                <h3 class="text-center">See What People Have To Say</h3>
                <section class="py-6 bg-gray-100">
                    <div class="container">
                        <div v-for="review in reviews" class="col-lg-12 mb-lg-0 mb-4">
                            <div class="col-lg-12 mx-auto text-center mb-5">
                                <div class="star-rating" :data-rating='review.rating'></div>
                                <p class="lead">"{{ review.review }}"</p>
                                <div class="author justify-content-center">
                                    <div class="name ps-2">
                                        <span>{{ review.name }} - {{ review.created_at }}</span>
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
