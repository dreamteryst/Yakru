<template>
  <section>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item">
        <a href="/">หน้าแรก</a>
      </li>
      <li class="breadcrumb-item active">เพิ่มแบบทดสอบ</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
      เพิ่มแบบทดสอบ
      <small></small>
    </h1>
    <!-- end page-header -->
    <!-- begin panel -->
    <div class="panel panel-inverse">
      <!-- begin panel-heading -->
      <div class="panel-heading">
        <div class="panel-heading-btn">
          <a
            href="javascript:;"
            class="btn btn-xs btn-icon btn-circle btn-warning"
            data-click="panel-collapse"
          >
            <i class="fa fa-minus"></i>
          </a>
        </div>
        <h4 class="panel-title">เพิ่มแบบทดสอบ</h4>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <div class="alert alert-success fade show" v-if="isSuccess">
          <span class="close" data-dismiss="alert">×</span>
          <strong>Success!</strong>
          เพิ่มข้อมูลสำเร็จ
        </div>
        <div class="form-group">
          <label for="example_type">ชื่อแบบทดสอบ</label>
          <b-form-input v-model="example_type" />
          <!-- <select
            class="form-control"
            :class="{'is-invalid':isError('example_type')}"
            id="example_type"
            v-model="example_type"
          >
            <option value="pretest">ก่อนเรียน</option>
            <option value="posttest">หลังเรียน</option>
          </select> -->
          <div class="invalid-feedback" v-if="isError('example_type')">{{ errors.example_type[0] }}</div>
        </div>
        <b-row>
          <b-col>
            <div class="form-group">
              <label for="time_limit">จำกัดเวลา</label>
              <input
                type="text"
                class="form-control"
                id="time_limit"
                v-model="time_limit"
                placeholder="นาที"
              >
            </div>
          </b-col>
        </b-row>
        <b-row>
          <div class="col-md-2 offset-md-11 col-4 offset-9">
            <i class="fa fa-plus fa-2x m-t-5" @click="addEx"></i>
            <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeEx"></i>
          </div>
        </b-row>
        <b-row v-for="(example, i) in examples" :key="i">
          <b-col>
            <div class="form-group">
              <label :for="`example-${i}-question`">คำถาม {{ i + 1 }}</label>
              <input
                type="text"
                class="form-control"
                :id="`example-${i}-question`"
                v-model="example.question"
                placeholder="Question"
              >
            </div>
            <div class="form-group">
              <label :for="`example-${i}-ans`">เฉลย</label>
              <select class="form-control" :id="`example-${i}-ans`" v-model="example.ans">
                <option v-for="n in example.choices.length" :key="n" v-text="n" :value="n"/>
              </select>
            </div>
            <b-row>
              <div class="col-md-2 offset-md-11 col-4 offset-9">
                <i class="fa fa-plus fa-2x m-t-5" @click="addChoice(i)"></i>
                <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeChoice(i)"></i>
              </div>
            </b-row>
            <b-row v-for="(choice, j) in example.choices" :key="j">
              <b-col md="10" offset-md="2">
                <div class="form-group">
                  <label :for="`choice-${j}-text`">ตัวเลือกที่ {{ j+1 }}</label>
                  <input
                    type="text"
                    class="form-control"
                    :id="`choice-${j}-text`"
                    v-model="choice.text"
                    placeholder="Choice"
                  >
                </div>
              </b-col>
            </b-row>
            <hr>
          </b-col>
        </b-row>
        <div class="pull-right">
          <button class="btn btn-primary" @click="save">
            <i class="fa fa-paper-plane"></i> บันทึก
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
    data() {
        return {
            course_id: "",
            example_type: "",
            examples: [],
            time_limit: "",
            errors: [],
            isSuccess: false
        };
    },
    mounted() {
        axios.get(`/api/example/${this.$route.params.id}`).then(({ data }) => {
            this.course_id = data.course_id
            this.example_type = data.example_type
            this.time_limit = data.time_limit
            data.question.map(item => {
                this.examples.push({
                    question: item.question,
                    ans: item.ans,
                    choices: item.choice
                })
            })
        })
    },
    methods: {
        addEx() {
            this.examples.push({
                question: "",
                ans: "",
                choices: [{ text: "" }]
            });
        },
        removeEx() {
            this.examples.pop();
        },
        addChoice(i) {
            this.examples[i].choices.push({
                text: ""
            });
        },
        removeChoice(i) {
            this.examples[i].choices.pop();
        },
        save() {
            const formData = new FormData();
            formData.append("_method", "PUT");
            formData.append("example_type", this.example_type);
            formData.append("course_id", this.course_id);
            formData.append("time_limit", this.time_limit);
            this.examples.forEach((item, i) => {
                formData.append(`question[${i}][question]`, item.question);
                formData.append(`question[${i}][ans]`, item.ans);
                item.choices.forEach((choice, j) => {
                    formData.append(
                        `question[${i}][choice][${j}][text]`,
                        choice.text
                    );
                });
            });

            axios
                .post(`/admin/api/example/${this.$route.params.id}`, formData)
                .then(response => {
                    if (response.status === 200) {
                        window.location.href = `/admin/course/example/${
                            this.$route.params.id
                        }`;
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    console.log(error.response);
                });
        },
        isError(field) {
            return this.errors[field] !== undefined;
        }
    }
};
</script>

<style>
</style>
