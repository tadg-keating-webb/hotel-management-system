<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import {router, useForm} from '@inertiajs/vue3'

const form = useForm({
    first_name: null,
    last_name: null,
    email: null,
    message: null,
    terms: null,
})

function submit() {
    form.post(route('contact.store'), {
        onSuccess: () => form.reset(),
    })
}

</script>

<template>
    <AppLayout>
        <section>
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                        <h3 class="text-center">Contact us</h3>
                        <form @submit.prevent="submit">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label>First Name</label>
                                        <div class="input-group">
                                            <input class="form-control" placeholder="" aria-label="First Name..." type="text" v-model="form.first_name">
                                        </div>
                                        <div class="text-danger mt-1" v-if="form.errors.first_name">{{ form.errors.first_name }}</div>
                                    </div>
                                    <div class="col-md-6 ps-2">
                                        <label>Last Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="" aria-label="Last Name..." v-model="form.last_name">
                                        </div>
                                        <div class="text-danger mt-1 mb-3" v-if="form.errors.last_name">{{ form.errors.last_name }}</div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label>Email Address</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="" v-model="form.email">
                                    </div>
                                    <div class="text-danger mt-1 mb-3" v-if="form.errors.email">{{ form.errors.email }}</div>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Your message</label>
                                    <textarea v-model="form.message" class="form-control" id="message" rows="4"></textarea>
                                    <div class="text-danger mt-1 mb-3" v-if="form.errors.message">{{ form.errors.message }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check form-switch mb-4">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" v-model="form.terms">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">I agree to the <a href="javascript:;" class="text-dark"><u>Terms and Conditions</u></a>.</label>
                                            <div class="text-danger mt-1 mb-3 ml-0" v-if="form.errors.terms">{{ form.errors.terms }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-dark w-100">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
