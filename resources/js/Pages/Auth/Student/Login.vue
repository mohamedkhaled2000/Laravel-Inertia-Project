<template>
    <Head>
        <title>تسجيل الدخول</title>
        <meta type="description" content="Login Informations" />
    </Head>


    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">تسجيل الدخول الطالب</h4>
                                    <form @submit.prevent="loginForm.post(route('loginFormStudent'))">
                                        <div class="form-group">
                                            <label><strong>البريد الالكترونى</strong></label>
                                            <input
                                                type="email"
                                                v-model="loginForm.email"
                                                class="form-control"
                                            />
                                            <div
                                                v-if="loginForm.errors.email"
                                                v-text="loginForm.errors.email"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>كلمة المرور</strong></label>
                                            <input
                                                v-model="loginForm.password"
                                                type="password"
                                                class="form-control"
                                            />
                                            <div
                                                v-if="loginForm.errors.password"
                                                v-text="loginForm.errors.password"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                        <div
                                            class="form-row d-flex justify-content-between mt-4 mb-2"
                                        >
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox ml-1">
                                                    <input
                                                        type="checkbox"
                                                        class="custom-control-input"
                                                        id="basic_checkbox_1"
                                                    />
                                                    <label
                                                        class="custom-control-label"
                                                        for="basic_checkbox_1"
                                                    >تذكرنى</label
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html"
                                                >هل نسيت كلمة المرور؟</a
                                                >
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block" :disabled="loginForm.processing">
                                                تسجيل الدخول
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    layout: false,
    setup(props) {
        const loginForm = useForm({
            email: "",
            password: "",
        });
        return {loginForm}
    }
};
</script>

