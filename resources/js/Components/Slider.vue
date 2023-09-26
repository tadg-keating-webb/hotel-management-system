<script>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

export default {
    name: 'App',
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    props: {
        title: String, // Define the 'title' prop
    },
    data() {
        return {
            images: [
                'https://i.natgeofe.com/k/cc0e882b-fd28-47a1-886e-5ff5560d4c6a/vietnam-market.jpg?w=1084.125&h=609',
                'https://cdnimgen.vietnamplus.vn/uploaded/wbxx/2022_10_08/cauvang.jpg',
                'https://izitour.com/media/blog/vietnam-in-november.webp',
            ],
        };
    },
}
</script>

<template>
    <div class="slider-wrapper">
        <carousel :items-to-show="1" :wrapAround="true" :autoplay="5000">
            <slide v-for="slide in images" :key="slide">
                <div class="slide-content">
                    <img :src="slide" alt="Slider Image" class="slide-image" />
                </div>
            </slide>
            <template #addons>
                <navigation />
            </template>
        </carousel>
        <!-- Centered Text -->
        <div class="centered-text">
            {{ title }}
        </div>
    </div>
</template>

<style>
.slider-wrapper {
    position: relative;
}

.slide-content {
    text-align: center;
}

.centered-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 34px;
    font-weight: bold; /* Make the text bold */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add a drop shadow */
}

.slide-content {
    width: 100%;
    height: 300px; /* Adjust the fixed height as needed */
    object-fit: cover; /* Crop and maintain aspect ratio */
    position: relative; /* Make the parent for absolute positioning */
}

.slide-image {
    width: 100%;
    height: 300px; /* Adjust the fixed height as needed */
    object-fit: cover; /* Crop and maintain aspect ratio */
    position: relative; /* Make the parent for absolute positioning */
}
</style>
