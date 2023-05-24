<template lang="">
    <Head title="تعديل قسم" />

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0"></div>
                <div
                    class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex"
                >
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link href="/">الرئيسية</Link>
                        </li>
                        <li class="breadcrumb-item">
                            <Link :href="route('section.index')"
                                >الاقسام الدراسية</Link
                            >
                        </li>
                        <li class="breadcrumb-item active">تعديل قسم</li>
                    </ol>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form
                                role="form"
                                @submit.prevent="
                                    form.post(route('section.update', section.id))
                                "
                            >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">اسم الصف</label>
                                    <input
                                        v-model="form.section_name"
                                        type="text"
                                        class="form-control"
                                        id="exampleInputEmail1"
                                        aria-describedby="emailHelp"
                                    />
                                    <div
                                        v-if="form.errors.section_name"
                                        v-text="form.errors.section_name"
                                        class="text-danger"
                                    ></div>
                                </div>

                                <div class="form-group">
                                    <label>اختير المرحلة الدراسية</label>
                                    <select
                                        v-model="form.grade_id"
                                        class="form-control"
                                        style="width: 100%"
                                        @change="classss(form.grade_id)"
                                    >
                                        <option
                                            v-for="grade in grades"
                                            :value="grade.id"
                                        >
                                            {{ grade.name }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.grade_id"
                                        v-text="form.errors.grade_id"
                                        class="text-danger"
                                    ></div>
                                </div>

                                <div class="form-group">
                                    <label>اختير الفصل الدراسية</label>
                                    <select
                                        v-model="form.class_room_id"
                                        class="form-control"
                                        style="width: 100%">

                                        <option v-for="classRoom in classessRom" :value="classRoom['id']">
                                            {{ classRoom["class_name"] }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.class_room_id"
                                        v-text="form.errors.class_room_id"
                                        class="text-danger"
                                    ></div>
                                </div>


                                <div class="form-group">
                                    <label>اختير المعلمين</label>
                                    <select v-model="form.teacher_id" class="form-control" multiple aria-label="multiple select example" style="width: 100%">
                                        <option v-for="teacher in teachers" :value="teacher.id" >{{ teacher.name }} {{checkTeacher(teacher.id)}} </option> <!-- :selected="checkTeacher(teacher.id)" -->
                                    </select>
                                    <div
                                        v-if="form.errors.teacher_id"
                                        v-text="form.errors.teacher_id"
                                        class="text-danger"
                                    ></div>

                                </div>


                                <div class="form-group">
                                    <label>اختير الحالة</label>
                                    <select
                                        v-model="form.status"
                                        class="form-control"
                                        style="width: 100%"
                                    >
                                        <option :value="1">نشط</option>
                                        <option :value="0">معلق</option>
                                    </select>
                                    <div
                                        v-if="form.errors.class_room_id"
                                        v-text="form.errors.class_room_id"
                                        class="text-danger"
                                    ></div>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        :disabled="form.processing"
                                    >
                                        تعديل
                                    </button>
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
    props: {
        section: Object,
        grades: Object,
        classRom: Object,
        teachers: Object,
    },

    data(){
        return {
            classessRom : [],
        }
    },

    methods:{
        classss(id){
            this.classessRom = []
            this.classessRom = this.classRom.filter((el) => el.grade_id == id)
        },

        checkTeacher(teacher_id) {
            return  this.section.teachers.filter(teach => teach.id == teacher_id);
        }
    },

    mounted(){
        this.classessRom = this.classRom.filter((el) => el.grade_id == this.section.grade_id)
    },

    setup(props) {
        let form = useForm({
            section_name: props.section.section_name,
            grade_id: props.section.grade_id,
            class_room_id: props.section.class_room_id,
            status: props.section.status,
            teacher_id: props.section.teachers.id,
        });

        return { form };
    },
};
</script>
