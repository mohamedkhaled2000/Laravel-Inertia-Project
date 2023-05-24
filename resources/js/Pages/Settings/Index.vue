<template lang="">
    <Head title="الاعدادات" />


    <div  class="content-body">

        <div class="container-fluid">
                <div  class="row page-titles mx-0">
                    <div  class="col-sm-6 p-md-0">
                    <div class="welcome-text">

                    </div>
                    </div>
                    <div
                    class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex"
                    >
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        <Link href="/">الرئيسية</Link>
                        </li>
                        <li class="breadcrumb-item active">
                        <a href="javascript:void(0)">الاعدادات</a>
                        </li>
                    </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                            <div
                                v-if="$page.props.flash.message"
                                class="alert alert-success alert-dismissible">
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-hidden="true">
                                    ×
                                </button>
                                <h5><i class="icon fa fa-check"></i> تم بنجاح!</h5>
                                {{ $page.props.flash.message }}
                            </div>

                            <div
                                v-if="$page.props.flash.error"
                                class="alert alert-danger alert-dismissible">
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-hidden="true">
                                    ×
                                </button>
                                <h5><i class="icon fa fa-ban"></i> خطا!</h5>
                                {{ $page.props.flash.error }}
                            </div>
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <form @submit.prevent="form.post(route('setting.update',1))">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>اسم المدرسة</label>
                                            <div class="form-group">
                                                <label>اسم المدرسة</label>
                                                <input v-model="form.school_name" type="text" class="form-control">
                                                <div v-if="form.errors.school_name" v-text="form.errors.school_name" class="text-danger"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>العام الحالى</label>
                                            <select
                                                v-model="form.current_session"
                                                class="form-control"
                                                style="width: 100%"
                                                required>
                                                <option
                                                    :value="sessions" >
                                                    {{ sessions }}
                                                </option>
                                            </select>
                                            <div v-if="form.errors.current_session" v-text="form.errors.current_session" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>اسم المدرسة المختصر</label>
                                            <input v-model="form.school_title" type="text" class="form-control">
                                            <div v-if="form.errors.school_title" v-text="form.errors.school_title" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>الهاتف</label>
                                            <input v-model="form.phone" type="text" class="form-control">
                                            <div v-if="form.errors.phone" v-text="form.errors.phone" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>البريد الالكترونى</label>
                                            <input v-model="form.email" type="text" class="form-control">
                                            <div v-if="form.errors.email" v-text="form.errors.email" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>العنوان</label>
                                            <input v-model="form.address" type="text" class="form-control">
                                            <div v-if="form.errors.address" v-text="form.errors.address" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>نهاية الترم الاول</label>
                                            <input v-model="form.end_first_tearm" type="date" class="form-control">
                                            <div v-if="form.errors.end_first_tearm" v-text="form.errors.end_first_tearm" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>نهاية الترم الثانى</label>
                                            <input v-model="form.end_second_tearm" type="date" class="form-control">
                                            <div v-if="form.errors.end_second_tearm" v-text="form.errors.end_second_tearm" class="text-danger"></div>
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>لوجو المدرسة</label>
                                            <div>
                                                <img :src="'upload/Logo/'+settings.setting.logo" wigth="40px"/>
                                            </div>
                                            <input type="file" @input="form.logo = $event.target.files[0]" />
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                            {{ form.progress.percentage }}%
                                            </progress>
                                            <div v-if="form.errors.logo" v-text="form.errors.logo" class="text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    :disabled="form.processing">
                                    تاكيد
                                </button>
                            </form>


                        </div>
                    </div>
                    </div>
                </div>
            </div>

</div>


</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3';


export default {
    props:{
        settings: Object,
    },
    data(){
        return {
            sessions : new Date().getFullYear() + '-' + (new Date().getFullYear() - 1),
            form: this.$inertia.form({
                _method: 'PUT',
                school_name : this.settings.setting.school_name,
                current_session : this.settings.setting.current_session,
                school_title : this.settings.setting.school_title,
                phone : this.settings.setting.phone,
                email : this.settings.setting.email,
                address : this.settings.setting.address,
                end_first_tearm : this.settings.setting.end_first_tearm,
                end_second_tearm : this.settings.setting.end_second_tearm,
                logo : null,
            }),
        }
    },

}
</script>

