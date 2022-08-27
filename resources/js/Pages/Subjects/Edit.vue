<template lang="">
    <Head title="تعديل مادة" />

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
                        <li class="breadcrumb-item active">تعديل مادة</li>
                    </ol>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <form
                        role="form"
                        @submit.prevent="
                            form.put(route('subject.update', subject.id))">
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

                        <div class="form-group" v-if="classessRom.length > 0">
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


                        <div class="form-group" v-else>
                            <label>اختير الفصل الدراسية</label>
                            <select
                                v-model="form.class_room_id"
                                class="form-control"
                                style="width: 100%"
                            >
                                <option
                                    v-for="classes in classRom"
                                    :value="classes.id"
                                    :class="{ 'd-none': !form.grade_id }"
                                >
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

                        <div class="form-group">
                            <label>اختير المعلمين</label>
                            <select
                                v-model="form.teacher_id"
                                class="form-control"
                                style="width: 100%">

                                <option v-for="teacher in teachers" :value="teacher.id">
                                    {{ teacher["name"] }}
                                </option>
                            </select>
                            <div
                                v-if="form.errors.teacher_id"
                                v-text="form.errors.teacher_id"
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


</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    props: {
        subject: Object,
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

                this.classRom.forEach(el => {
                    if(el.grade_id == id){
                        this.classessRom.push(el)
                    }
                });
        }
    },

    setup(props) {
        let form = useForm({
            name: props.subject.name,
            grade_id: props.subject.grade_id,
            class_room_id: props.subject.class_room_id,
            teacher_id: props.subject.teacher_id,
        });

        return { form };
    },
};
</script>
