<template lang="">
    <Head title="الحضور والغياب" />

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
                        <li class="breadcrumb-item active">الحضور والغياب</li>
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
                                class="accordion accordion-no-gutter accordion-bordered">
                                <div
                                    v-for="grade in grades"
                                    class="accordion__item">
                                    <div
                                        class="accordion__header collapsed"
                                        data-toggle="collapse"
                                        :data-target="
                                            '#bordered_no-gutter_collapse' +
                                            grade.id">
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
                                        data-parent="#accordion-four">
                                        <div class="accordion__body--text">
                                            <div class="table-responsive">

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">
                                                                #
                                                            </th>
                                                            <th>اسم القسم</th>
                                                            <th>اسم المرحلة</th>
                                                            <th>المعلمين</th>
                                                            <th>الحالة</th>
                                                            <th>العمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                section, i
                                                            ) in sections">
                                                            <td
                                                                v-if="
                                                                    section.grade_id ==
                                                                    grade.id">
                                                                {{ ++i }}
                                                            </td>
                                                            <td
                                                                v-if="
                                                                    section.grade_id ==
                                                                    grade.id">
                                                                {{
                                                                    section.section_name
                                                                }}
                                                            </td>
                                                            <td
                                                                v-if="section.grade_id == grade.id">
                                                                {{
                                                                    section
                                                                        .section_room
                                                                        .class_name
                                                                }}
                                                            </td>
                                                            <td v-if="section.grade_id == grade.id">
                                                                <span v-for="(teacher,n) in section.teachers">{{++n}}-{{teacher.name}}<br></span>
                                                            </td>
                                                            <td
                                                                v-if="
                                                                    section.grade_id ==
                                                                    grade.id">
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
                                                                    }}</span>
                                                            </td>
                                                            <td
                                                                v-if="
                                                                    section.grade_id ==
                                                                    grade.id"
                                                                class="text-right py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <Link
                                                                        :href="
                                                                            route('attentance.show',section.id)"
                                                                        class="btn btn-info">
                                                                        قائمة الطلاب
                                                                    </Link>

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
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
      teacher_id: [],
    });

    return { destory, form };
  },
};
</script>
<style lang=""></style>
