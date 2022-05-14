<template lang="">
    <Head title="تعديل معلم" />

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
                            <a href="javascript:void(0)">تعديل معلم</a>
                        </li>
                    </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <div class="card-body">

                                    <form @submit.prevent="form.put(route('teacher.update',teacher.id))">

                                        <div class="row">

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>البريد الالكترونى</label>
                                                    <input
                                                        v-model="form.email"
                                                        type="email"
                                                        class="form-control"
                                                    />
                                                    <div
                                                        v-if="form.errors.email"
                                                        v-text="form.errors.email"
                                                        class="text-danger"
                                                    ></div>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-sm-12">

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">اسم المعلم</label>
                                                    <input
                                                        v-model="form.name"
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputEmail1"
                                                        aria-describedby="emailHelp"
                                                    />
                                                    <div
                                                        v-if="form.errors.name"
                                                        v-text="form.errors.name"
                                                        class="text-danger"
                                                    ></div>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>اختير التخصص</label>
                                                    <select
                                                        v-model="form.speicalize_id "
                                                        class="form-control"
                                                        style="width: 100%">
                                                        <option
                                                            v-for="spicalize in spicalizes"
                                                            :value="spicalize.id" >
                                                            {{ spicalize.name }}
                                                        </option>
                                                    </select>
                                                    <div
                                                        v-if="form.errors.speicalize_id "
                                                        v-text="form.errors.speicalize_id "
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">عنوان المعلم</label>
                                                    <input
                                                        v-model="form.address"
                                                        type="text"
                                                        class="form-control"
                                                    />
                                                    <div
                                                        v-if="form.errors.address"
                                                        v-text="form.errors.address"
                                                        class="text-danger"
                                                    ></div>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>اختير الجنس</label>
                                                    <select
                                                        v-model="form.gender"
                                                        class="form-control"
                                                        style="width: 100%">
                                                        <option value="1">
                                                            ذكر
                                                        </option>
                                                        <option value="2">
                                                            انثى
                                                        </option>
                                                    </select>
                                                    <div
                                                        v-if="form.errors.gender"
                                                        v-text="form.errors.gender"
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" :disabled="form.processing">تعديل</button>
                                        </div>
                                    </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

</div>


</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    props:{
        spicalizes : Object,
        teacher : Object
    },

    setup(props) {

        let form = useForm({
            email: props.teacher.email,
            name: props.teacher.name,
            speicalize_id: props.teacher.speicalize_id,
            address: props.teacher.address,
            gender: props.teacher.gender,
        });

        return { form };
    },
}
</script>
