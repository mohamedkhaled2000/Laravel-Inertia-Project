<template lang="">
    <Head title="تعديل الامتحان" />

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
                        <li class="breadcrumb-item active">تعديل الامتحان</li>
                    </ol>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <form
                        role="form"
                        @submit.prevent="
                            form.put(route('exam.update', exam.id))">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المادة</label>
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


                        <div class="row">

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>المرحلة الدراسية</label>
                                    <select
                                        v-model="form.grade_id"
                                        class="form-control"
                                        style="width: 100%"
                                        @change="classss(form.grade_id)">
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

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" v-if="classessRom.length > 0">
                                    <label>الصف الدراسى</label>
                                    <select
                                        v-model="form.class_room_id"
                                        class="form-control"
                                        style="width: 100%"
                                        @change="section(form.class_room_id)">
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

                                <div class="form-group" v-else>
                                    <label>الصف الدراسى</label>
                                    <select
                                        v-model="form.class_room_id"
                                        class="form-control"
                                        style="width: 100%">
                                        <option
                                            v-for="classes in classRom"
                                            :value="classes.id"
                                            :class="{ 'd-none': !form.grade_id }">
                                            {{
                                                classes.grade_id == form.grade_id
                                                    ? classes.class_name
                                                    : null
                                            }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.class_room_id"
                                        v-text="form.errors.class_room_id"
                                        class="text-danger"
                                    ></div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" v-if="sectionss.length > 0">
                                    <label>القسم</label>
                                    <select
                                        v-model="form.section_id"
                                        class="form-control"
                                        style="width: 100%">
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


                                <div class="form-group" v-else>
                                    <label>القسم</label>
                                    <select
                                        v-model="form.section_id"
                                        class="form-control"
                                        style="width: 100%">
                                        <option
                                            v-for="section in sections"
                                            :value="section.id"
                                            :class="{ 'd-none': !form.class_room_id }">
                                            {{
                                                section.class_room_id == form.class_room_id
                                                    ? section.section_name
                                                    : null
                                            }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.section_id"
                                        v-text="form.errors.section_id"
                                        class="text-danger"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" >
                                    <label>المعلم</label>
                                    <select
                                        v-model="form.teacher_id"
                                        class="form-control"
                                        style="width: 100%">
                                        <option v-for="(teacher,i) in teachers" :value="teacher['id']">
                                            {{ teacher["name"] }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.teacher_id"
                                        v-text="form.errors.teacher_id"
                                        class="text-danger"
                                    ></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" >
                                    <label>اختر المادة</label>
                                    <select
                                        v-model="form.subject_id"
                                        class="form-control"
                                        style="width: 100%">
                                        <option v-for="(subject,i) in subjects" :value="subject['id']">
                                            {{ subject["name"] }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.subject_id"
                                        v-text="form.errors.subject_id"
                                        class="text-danger"
                                    ></div>
                                </div>
                            </div>
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


</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    props: {
        exam: Object,
        subjects  : Object,
        grades  : Object,
        classRom  : Object,
        teachers  : Object,
        sections  : Object,

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

    },
    setup(props) {
        let form = useForm({
            name: props.exam.name,
            grade_id : props.exam.grade_id,
            class_room_id : props.exam.class_room_id,
            section_id : props.exam.section_id,
            teacher_id : props.exam.teacher_id,
            subject_id : props.exam.subject_id,
        });

        return { form };
    },
};
</script>
