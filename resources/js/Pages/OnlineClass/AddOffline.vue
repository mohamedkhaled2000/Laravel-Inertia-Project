<template lang="">
    <Head title="انشاء حصة جديدة يدوى" />


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
                        <a href="javascript:void(0)">انشاء حصة جديدة يدوى</a>
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
                                <h4>المرحلة الدراسية </h4><br>
                            <form @submit.prevent="submit">
                                <div class="row">

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>المرحلة الدراسية</label>
                                            <select
                                                v-model="form.grade_id"
                                                class="form-control"
                                                style="width: 100%"
                                                @change="classss(form.grade_id)" required>
                                                <option
                                                    v-for="grade in grades"
                                                    :value="grade.id" >
                                                    {{ grade.name }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.grade_id"
                                                v-text="form.errors.grade_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group" v-if="classessRom.length > 0">
                                            <label>الصف الدراسى</label>
                                            <select
                                                v-model="form.class_room_id"
                                                class="form-control"
                                                style="width: 100%"
                                                @change="section(form.class_room_id)" required>
                                            <option v-for="(classRoom,i) in classessRom" :value="classRoom['id']">
                                                {{ classRoom["class_name"] }}
                                            </option>
                                            </select>
                                            <div
                                                v-if="form.errors.class_room_id"
                                                v-text="form.errors.class_room_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group" v-if="sectionss.length > 0">
                                            <label>القسم</label>
                                            <select
                                                v-model="form.section_id"
                                                class="form-control"
                                                style="width: 100%" required>
                                                <option v-for="(section,i) in sectionss" :value="section['id']">
                                                    {{ section["section_name"] }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.section_id"
                                                v-text="form.errors.section_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم الحصة</label>
                                            <input v-model="form.topic" type="text" class="form-control" id="exampleInputEmail1">
                                            <div v-if="form.errors.topic" v-text="form.errors.topic" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">رقم الحصة</label>
                                            <input v-model="form.meeting_id" type="text" class="form-control" id="exampleInputEmail1">
                                            <div v-if="form.errors.meeting_id" v-text="form.errors.meeting_id" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">كلمة المرور</label>
                                            <input v-model="form.password" type="text" class="form-control" id="exampleInputEmail1">
                                            <div v-if="form.errors.password" v-text="form.errors.password" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ناريخ ووقت الحصة</label>
                                            <input class="form-control" type="datetime-local" v-model="form.start_time">
                                            <div v-if="form.errors.start_time" v-text="form.errors.start_time" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">مدة الحصة</label>
                                            <input v-model="form.duration" type="number" class="form-control" id="exampleInputEmail1">
                                            <div v-if="form.errors.duration" v-text="form.errors.duration" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">رابط الحصة</label>
                                            <input v-model="form.join_url" type="text" class="form-control" id="exampleInputEmail1">
                                            <div v-if="form.errors.join_url" v-text="form.errors.join_url" class="text-danger"></div>
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
        grades: Object,
        class_rooms: Object,
        sections: Object,
    },

    data(){
        return {
            classessRom : [],
            sectionss : [],
        }
    },

    methods:{
        classss(id){
            this.classessRom = []

            this.class_rooms.forEach(el => {
                if(el.grade_id == id){
                    this.classessRom.push(el)
                }
            });
        },

        section(id){
            this.sectionss = []

            this.sections.forEach(el => {
                if(el.class_room_id == id){
                    this.sectionss.push(el)
                }
            });
        },

    },

    setup(){
        let form = useForm({
            grade_id :"",
            class_room_id :"",
            section_id :"",
            topic :"",
            meeting_id :"",
            password :"",
            duration :"",
            start_time :"",
            join_url :"",
        });

        let submit = () => {
            form.post(route('storeOffline'), {
                preserveScroll: true,
                onSuccess: () => form.reset(),
            })
        }

        return {form,submit}
    }
}
</script>

