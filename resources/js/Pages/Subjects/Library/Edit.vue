<template lang="">
    <Head title="تعديل كتاب جديد" />


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
                        <a href="javascript:void(0)">تعديل كتاب جديد</a>
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
                            <form @submit.prevent="form.post(route('library.update',library.id))">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">عنوان الكتاب</label>
                                            <input v-model="form.title" type="text" class="form-control" id="exampleInputEmail1">
                                            <div v-if="form.errors.title" v-text="form.errors.title" class="text-danger"></div>
                                        </div>
                                    </div>
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


                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>المعلم</label>
                                            <select
                                                v-model="form.teacher_id"
                                                class="form-control"
                                                style="width: 100%"
                                                required>
                                                <option
                                                    v-for="teacher in teachers"
                                                    :value="teacher.id" >
                                                    {{ teacher.name }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.teacher_id"
                                                v-text="form.errors.teacher_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">مرفق الكتاب</label>
                                            <input class="form-control" type="file"  @input="form.file_name = $event.target.files[0]">
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                            {{ form.progress.percentage }}%
                                            </progress>
                                            <div v-if="form.errors.file_name" v-text="form.errors.file_name" class="text-danger"></div>
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
        library: Object,
        grades: Object,
        class_rooms: Object,
        sections: Object,
        teachers: Object,
    },

    data(){
        return {
            classessRom : [],
            sectionss : [],
            form: this.$inertia.form({
                _method: 'PUT',
                title : this.library.title,
                grade_id : this.library.grade_id,
                class_room_id : this.library.class_room_id,
                section_id : this.library.section_id,
                teacher_id : this.library.teacher_id,
                file_name : "",
            })
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
}
</script>

