<template>
  <section>
    <b-row>
      <b-col>
        <h4>เมนูข้อสอบ</h4>
        <b-row>
          <b-col md="6">
            <button class="btn btn-block btn-info" @click="openExamp">เริ่มทำข้อสอบ</button>
            <button class="btn btn-block btn-success">ข้อถัดไป</button>
            <button class="btn btn-block btn-danger">สิ้นสุด</button>
          </b-col>
          <b-col md="6">

          </b-col>
        </b-row>
      </b-col>
    </b-row>
    <b-modal ref="modalExamp" no-fade title="เลือกข้อสอบ" @ok="startExam">
      <b-list-group>
        <b-list-group-item v-for="(exam, i) in exams" :key="i" @click="select(i)" :class="{'active': selected === i}">
            {{i + 1}}. {{ exam.example_type }}
        </b-list-group-item>
      </b-list-group>
    </b-modal>
  </section>
</template>

<script>
export default {
    props: ['socket', 'roomId'],
    data() {
        return {
            exams: [],
            selected: -1
        };
    },
    mounted() {
        axios.get(`/api/example/course/${1}`).then(({ data }) => {
            this.exams = data;
        });
    },
    methods: {
        openExamp() {
            this.$refs.modalExamp.show();
        },
        select(i) {
            this.selected = i;
        },
        startExam() {
          console.log('start examp')
          this.socket.emit(this.roomId + '/start exam', 1)
        }
    }
};
</script>

<style>
</style>
