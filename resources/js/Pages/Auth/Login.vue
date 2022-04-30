<template lang="">
    <Head>
        <title>Login</title>
        <meta type="description" content="Login Informations" />
    </Head>


    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form @submit.prevent="form.post(route('login'))">
                    <div class="input-group mb-3">
                        <input
                            type="email"
                            v-model="form.email"
                             name="email"
                            class="form-control"
                            placeholder="Email"
                        />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                    </div>
                    <div
                            v-if="form.errors.email"
                            v-text="form.errors.email"
                            class="text-danger"
                        ></div>
                    <div class="input-group mb-3">
                        <input
                            name="password"
                            v-model="form.password"
                            type="password"
                            class="form-control"
                            placeholder="Password"
                        />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                    </div>
                        <div
                            v-if="form.errors.password"
                            v-text="form.errors.password"
                            class="text-danger"
                        ></div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" />
                                <label for="remember"> Remember Me </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button
                                type="submit"
                                class="btn btn-primary btn-block btn-flat"
                                :disabled="form.processing"
                            >
                                Sign In
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using
                        Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using
                        Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="#">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center"
                        >Register a new membership</a
                    >
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</template>

<script>
    export default {
        layout: false,
    };
</script>

<script setup>
    import { useForm } from "@inertiajs/inertia-vue3";
    let form = useForm({
        email: "",
        password: "",
    });


</script>
