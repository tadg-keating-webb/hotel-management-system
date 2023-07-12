<script setup>

</script>

<template>
    <div class="d-flex flex-column vh-100">
        <nav class="navbar navbar-expand-lg bg-transparent py-3 shadow-none">
            <div class="container">
                <a href="javascript:void(0);" class="navbar-brand w-8">
                    <img src="/images/hotel-logo.png" alt="" height="" width="100">
                </a>
                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
                </button>
                <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
                    <ul class="navbar-nav navbar-nav-hover ms-auto">
                        <li class="nav-item mx-2">
                            <a href="javascript:void(0);" class="nav-link ps-2 cursor-pointer">Trips</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="javascript:void(0);" class="nav-link ps-2 cursor-pointer">Review</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="javascript:void(0);" class="nav-link ps-2 cursor-pointer">Contact</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="javascript:void(0);" class="btn bg-gradient-warning mb-0 cursor-pointer">Booking</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <slot />
        </main>

        <footer class="footer py-5 bg-gradient-dark mt-auto py-3 mb-0">
            <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/shapes/waves-white.svg" alt="pattern-lines" class="position-absolute start-0 top-0 w-100 opacity-6">
            <div class="container position-relative z-index-1">
                <div class="row">
                    <div class="col-lg-4 me-auto mb-lg-0 mb-4 text-lg-start text-center">
                        <h6 class="text-white font-weight-bolder text-uppercase mb-lg-4 mb-3">Hotel Management System</h6>
                        <ul class="nav flex-row ms-n3 align-items-center mb-4 mt-sm-0">
                            <li class="nav-item">
                                <a href="javascript:void(0);"  class="nav-link text-white opacity-8">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white opacity-8" href="javascript:;">
                                    Trips
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white opacity-8" href="javascript:;">
                                    Booking
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link text-white opacity-8">
                                    Contact
                                </a>
                            </li>
                        </ul>
                        <p class="text-sm text-white opacity-8 mb-0">
                            Copyright &#174; 2023 Tadg Keating-Webb&#8482;
                        </p>
                    </div>
                    <div class="col-lg-6 ms-auto text-lg-end text-center">
                        <p class="mb-5 text-lg text-white font-weight-bold">
                            Unwind, Connect, and Make Lasting Memories at Our Vibrant Hotel!
                        </p>
                        <a href="javascript:;" class="text-white me-xl-4 me-4 opacity-5">
                            <span class="fab fa-instagram" aria-hidden="true"></span>
                        </a>
                        <a href="javascript:;" class="text-white me-xl-4 me-4 opacity-5">
                            <span class="fab fa-twitter" aria-hidden="true"></span>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=100089126157507" class="text-white me-xl-4 me-4 opacity-5" target="_blank">
                            <span class="fab fa-facebook" aria-hidden="true"></span>
                        </a>
                        <a href="javascript:;" class="text-white me-xl-4 me-4 opacity-5">
                            <span class="fab fa-youtube" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
