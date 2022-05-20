<template lang="">
   <Head title="ترقية الطلاب" />


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
                        <a href="javascript:void(0)">ترقية الطلاب</a>
                        </li>
                    </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <h4>المرحلة الدراسية القديمة</h4><br>
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
                                </div><br><br>

                                <h4>المرحلة الدراسية الجديدة</h4><br>
                                <div class="row">

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>المرحلة الدراسية</label>
                                            <select
                                                v-model="form.new_grade_id"
                                                class="form-control"
                                                style="width: 100%"
                                                @change="new_classss(form.new_grade_id)" required>
                                                <option
                                                    v-for="grade in grades"
                                                    :value="grade.id" >
                                                    {{ grade.name }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.new_grade_id"
                                                v-text="form.errors.new_grade_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group" v-if="new_classessRom.length > 0">
                                            <label>الصف الدراسى</label>
                                            <select
                                                v-model="form.new_class_room_id"
                                                class="form-control"
                                                style="width: 100%"
                                                @change="new_section(form.new_class_room_id)" required>
                                            <option v-for="(classRoom,i) in new_classessRom" :value="classRoom['id']">
                                                {{ classRoom["class_name"] }}
                                            </option>
                                            </select>
                                            <div
                                                v-if="form.errors.new_class_room_id"
                                                v-text="form.errors.new_class_room_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group" v-if="new_sectionss.length > 0">
                                            <label>القسم</label>
                                            <select
                                                v-model="form.new_section_id"
                                                class="form-control"
                                                style="width: 100%" required>
                                                <option v-for="(section,i) in new_sectionss" :value="section['id']">
                                                    {{ section["section_name"] }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.new_section_id"
                                                v-text="form.errors.new_section_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>
                                </div><br>

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
        grades : Object,
        sections : Object,
        classRom : Object,
    },
    data(){
        return {
            classessRom : [],
            sectionss : [],

            new_classessRom : [],
            new_sectionss : [],
        }
    },
    methods:{
        classss(id){
            this.classessRom = []

            this.classRom.forEach(el => {
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

        new_classss(id){
            this.new_classessRom = []

            this.classRom.forEach(el => {
                if(el.grade_id == id){
                    this.new_classessRom.push(el)
                }
            });
        },

        new_section(id){
            this.new_sectionss = []

            this.sections.forEach(el => {
                if(el.class_room_id == id){
                    this.new_sectionss.push(el)
                }
            });
        },
    },
    setup(){

        let form = useForm({
            grade_id :"",
            class_room_id :"",
            section_id :"",
            new_grade_id :"",
            new_class_room_id :"",
            new_section_id :"",
        });

        let submit = () => {
            form.post(route('promotion.store'), {
                preserveScroll: true,
                onSuccess: () => form.reset(),
            })
        }

        return {form,submit}
    }
}
</script>
