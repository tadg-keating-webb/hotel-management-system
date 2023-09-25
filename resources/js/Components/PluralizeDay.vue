<template>
    <span>
        {{ duration }} {{ pluralizeDay(duration) }}
    </span>
</template>

<script>
export default {
    props: {
        duration: Number,
    },
    methods: {
        pluralizeDay(duration) {
            return duration > 1 ? 'Days' : 'Day';
        },
    },
};
</script>



