<template lang="">
    <Head title="تعديل طالب جديد" />


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
                        <a href="javascript:void(0)">تعديل طالب جديد</a>
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
                            <form @submit.prevent="submit">
                                <h3 class="text-primary">المعلومات الشخصية</h3>
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم الطالب</label>
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
                                            <label for="exampleInputEmail1">الايميل</label>
                                            <input
                                                v-model="form.email"
                                                type="email"
                                                class="form-control"
                                                id="exampleInputEmail1"
                                                aria-describedby="emailHelp"
                                            />
                                            <div
                                                v-if="form.errors.email"
                                                v-text="form.errors.email"
                                                class="text-danger"
                                            ></div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>اختير النوع</label>
                                            <select
                                                v-model="form.gender "
                                                class="form-control"
                                                style="width: 100%">
                                                <option value="1">ذكر</option>
                                                <option value="2">انثى</option>
                                            </select>
                                            <div
                                                v-if="form.errors.gender "
                                                v-text="form.errors.gender "
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>اختير الجنسية</label>
                                            <select
                                                v-model="form.nationality_id"
                                                class="form-control"
                                                style="width: 100%">
                                                <option
                                                    v-for="nation in data.nationality_id"
                                                    :value="nation.id" >
                                                    {{ nation.name }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.nationality_id"
                                                v-text="form.errors.nationality_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>اختير فصيلة الدم</label>
                                            <select
                                                v-model="form.type_blood_id"
                                                class="form-control"
                                                style="width: 100%">
                                                <option
                                                    v-for="blood in data.type_blood_id"
                                                    :value="blood.id" >
                                                    {{ blood.name }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.type_blood_id"
                                                v-text="form.errors.type_blood_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>تاريخ الميلاد</label>
                                            <input
                                                v-model="form.date_brith"
                                                type="date"
                                                class="form-control"
                                                id="exampleInputEmail1"
                                                aria-describedby="emailHelp"
                                            />
                                            <div
                                                v-if="form.errors.date_brith "
                                                v-text="form.errors.date_brith "
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                </div>

                                <h3 class="text-primary">معلومات الطالب</h3>

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
                                                    v-for="grade in data.grade_id"
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
                                                    v-for="classes in data.class_room_id"
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
                                        <div class="form-group" v-if="sections.length > 0">
                                            <label>القسم</label>
                                            <select
                                                v-model="form.section_id"
                                                class="form-control"
                                                style="width: 100%">
                                                <option v-for="(section,i) in sections" :value="section['id']">
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
                                                    v-for="section in data.section_id"
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
                                        <div class="form-group">
                                            <label>ولى الامر</label>
                                            <select
                                                v-model="form.parent_id"
                                                class="form-control"
                                                style="width: 100%">
                                                <option
                                                    v-for="parent in data.parent_id"
                                                    :value="parent.id" >
                                                    {{ parent.father_name }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.parent_id"
                                                v-text="form.errors.parent_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>السنة الدراسية</label>
                                            <select
                                                v-model="form.academic_year"
                                                class="form-control"
                                                style="width: 100%">
                                                <option v-for="y in currentYear" :value="y">
                                                    {{ y }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.academic_year"
                                                v-text="form.errors.academic_year"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    :disabled="form.processing"
                                >
                                    تعديل
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
        data: Object,
        student: Object,
    },

    data(){
        return {
            classessRom : [],
            sections : [],
            currentYear : [
                 new Date().getFullYear(),
                 new Date().getFullYear()+1
            ],

        }
    },

    methods:{
        classss(id){
            this.classessRom = []

            this.data.class_room_id.forEach(el => {
                if(el.grade_id == id){
                    this.classessRom.push(el)
                }
            });
        },

        section(id){
            this.sections = []

            this.data.section_id.forEach(el => {
                if(el.class_room_id == id){
                    this.sections.push(el)
                }
            });
        },
        getYear(){
            var current = new Date().getFullYear();
            for(let y=current; y<=current; y++){
                this.currentYear.push(y)
            }
        },


    },

    setup(props){

        let form = useForm({
            name: props.student.name,
            email: props.student.email,
            gender: props.student.gender,
            nationality_id: props.student.nationality_id,
            type_blood_id: props.student.type_blood_id,
            date_brith: props.student.date_brith,
            grade_id : props.student.grade_id,
            class_room_id : props.student.class_room_id,
            section_id : props.student.section_id,
            parent_id : props.student.parent_id,
            academic_year: props.student.academic_year,

        });

        let submit = () => {
            form.put(route('student.update',props.student.id), {
                preserveScroll: true,
            })
        }

        return {form,submit}
    }
}
</script>

