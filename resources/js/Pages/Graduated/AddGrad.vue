<template lang="">
    <Head title="اضافة متخرج جديد" />
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text"></div>
                </div>
                <div
                    class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex"
                >
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link href="/">الرئيسية</Link>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="javascript:void(0)">اضافة متخرج جديد</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div
                        v-if="$page.props.flash.message"
                        class="alert alert-success alert-dismissible"
                    >
                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                        >
                            ×
                        </button>
                        <h5><i class="icon fa fa-check"></i> تم بنجاح!</h5>
                        {{ $page.props.flash.message }}
                    </div>
                    <div
                        v-if="$page.props.flash.error"
                        class="alert alert-danger alert-dismissible"
                    >
                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                        >
                            ×
                        </button>
                        <h5><i class="icon fa fa-ban"></i> خطا!</h5>
                        {{ $page.props.flash.error }}
                    </div>
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <h4>المرحلة الدراسية</h4>
                            <br />
                            <form @submit.prevent="submit">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>المرحلة الدراسية</label>
                                            <select
                                                v-model="form.grade_id"
                                                class="form-control"
                                                style="width: 100%"
                                                @change="classss(form.grade_id)"
                                                required
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
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>الصف الدراسى</label>
                                            <select
                                                v-model="form.class_room_id"
                                                class="form-control"
                                                style="width: 100%"
                                                @change="
                                                    section(form.class_room_id)
                                                "
                                                required
                                            >
                                                <option
                                                    v-for="(
                                                        classRoom, i
                                                    ) in classessRom"
                                                    :value="classRoom['id']"
                                                >
                                                    {{
                                                        classRoom["class_name"]
                                                    }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.class_room_id"
                                                v-text="
                                                    form.errors.class_room_id
                                                "
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>القسم</label>
                                            <select
                                                v-model="form.section_id"
                                                class="form-control"
                                                style="width: 100%"
                                                required
                                            >
                                                <option
                                                    v-for="(
                                                        section, i
                                                    ) in sectionss"
                                                    :value="section['id']"
                                                >
                                                    {{
                                                        section["section_name"]
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
                                </div>
                                <br /><br />
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    :disabled="form.processing"
                                >
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
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props: {
        grades: Object,
        class_rooms: Object,
        sections: Object,
    },

    data() {
        return {
            classessRom: [],
            sectionss: [],
        };
    },

    methods: {
        classss(id) {
            this.classessRom = [];
            this.classessRom = this.class_rooms.filter(
                (el) => el.grade_id == id
            );
        },

        section(id) {
            this.sectionss = [];
            this.sectionss = this.sections.filter(
                (el) => el.class_room_id == id
            );
        },
    },

    setup() {
        let form = useForm({
            grade_id: "",
            class_room_id: "",
            section_id: "",
        });

        let submit = () => {
            form.post(route("graduated.store"), {
                preserveScroll: true,
                onSuccess: () => form.reset(),
            });
        };

        return { form, submit };
    },
};
</script>
