<template lang="">
    <Head title="الاقسام الدراسية" />

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
                        <li class="breadcrumb-item active">الاقسام الدراسية</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
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
                        <h5><i class="icon fas fa-check"></i> تم بنجاح!</h5>
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
                        <h5><i class="icon fas fa-ban"></i> خطا!</h5>
                        {{ $page.props.flash.error }}
                    </div>

                    <button
                        type="button"
                        class="btn btn-success"
                        data-toggle="modal"
                        data-target="#staticBackdrop"
                    >
                        اضافة صف
                    </button>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float: right"></h3>

                            <div class="card-tools" style="float: left">
                                <button
                                    type="button"
                                    class="btn btn-tool"
                                    data-card-widget="collapse"
                                    data-toggle="tooltip"
                                    title="Collapse"
                                ></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div
                                id="accordion-four"
                                class="accordion accordion-no-gutter accordion-bordered"
                            >
                                <div
                                    v-for="grade in grades"
                                    class="accordion__item"
                                >
                                    <div
                                        class="accordion__header collapsed"
                                        data-toggle="collapse"
                                        :data-target="
                                            '#bordered_no-gutter_collapse' +
                                            grade.id
                                        "
                                    >
                                        <span class="accordion__header--text">{{
                                            grade.name
                                        }}</span>
                                        <span
                                            class="accordion__header--indicator style_two"
                                        ></span>
                                    </div>
                                    <div
                                        :id="
                                            'bordered_no-gutter_collapse' +
                                            grade.id
                                        "
                                        class="collapse accordion__body"
                                        data-parent="#accordion-four"
                                    >
                                        <div class="accordion__body--text">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">
                                                            #
                                                        </th>
                                                        <th>اسم القسم</th>
                                                        <th>اسم المرحلة</th>
                                                        <th>الحالة</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            section, i
                                                        ) in sections"
                                                    >
                                                        <td
                                                            v-if="
                                                                section.grade_id ==
                                                                grade.id
                                                            "
                                                        >
                                                            {{ ++i }}
                                                        </td>
                                                        <td
                                                            v-if="
                                                                section.grade_id ==
                                                                grade.id
                                                            "
                                                        >
                                                            {{
                                                                section.section_name
                                                            }}
                                                        </td>
                                                        <td
                                                            v-if="
                                                                section.grade_id ==
                                                                grade.id
                                                            "
                                                        >
                                                            {{
                                                                section
                                                                    .section_room
                                                                    .class_name
                                                            }}
                                                        </td>
                                                        <td
                                                            v-if="
                                                                section.grade_id ==
                                                                grade.id
                                                            "
                                                        >
                                                            <span
                                                                :class="{
                                                                    'badge badge-danger':
                                                                        section.status ==
                                                                        0,
                                                                    'badge badge-success':
                                                                        section.status ==
                                                                        1,
                                                                }"
                                                                >{{
                                                                    section.status ==
                                                                    0
                                                                        ? "معلق"
                                                                        : "نشط"
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td
                                                            v-if="
                                                                section.grade_id ==
                                                                grade.id
                                                            "
                                                            class="text-right py-0 align-middle"
                                                        >
                                                            <div
                                                                class="btn-group btn-group-sm"
                                                            >
                                                                <Link
                                                                    :href="
                                                                        route(
                                                                            'section.edit',
                                                                            section.id
                                                                        )
                                                                    "
                                                                    class="btn btn-info"
                                                                    ><i
                                                                        class="fa fa-edit"
                                                                    ></i
                                                                ></Link>
                                                                <button
                                                                    type="submit"
                                                                    @click="
                                                                        destory(
                                                                            section.id
                                                                        )
                                                                    "
                                                                    class="btn btn-danger"
                                                                >
                                                                    <i
                                                                        class="fa fa-trash"
                                                                    ></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div
        class="modal fade"
        id="staticBackdrop"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة صف</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form
                        role="form"
                        @submit.prevent="form.post(route('section.store'))"
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
                                style="width: 100%" @change="classss(form.grade_id)">
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
                        <div class="form-group" v-if="classessRom.length > 0">
                            <label>اختير الفصل الدراسية</label>
                            <select
                                v-model="form.class_room_id"
                                class="form-control"
                                style="width: 100%">

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
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                اغلاق
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="form.processing"
                            >
                                اضافة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
import swal from "sweetalert";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
  props: {
    sections: Object,
    grades: Object,
    classRom: Object,
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

  setup() {
    const destory = (id) => {
      swal({
        title: "هل انت متاكد من الحذف؟",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          Inertia.delete(route("section.delete", id), {
            onSuccess: () => {
              swal("تم الحذف بنجاح", {
                icon: "success",
              });
            },
          });
        } else {
          swal("هناك شى خطا");
        }
      });
    };

    let form = useForm({
      section_name: "",
      grade_id: "",
      class_room_id: "",
    });

    return { destory, form };
  },
};
</script>
<style lang=""></style>
