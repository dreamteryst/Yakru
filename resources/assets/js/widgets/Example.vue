<template>
  <b-modal
    ref="modal"
    :title="`${title} : เหลือเวลา ${time_left} นาที`"
    no-close-on-backdrop
    ok-title="บันทึก"
    cancel-title="ปิด"
    size="lg"
    no-close-on-esc
    no-fade
    @ok="submit"
  >
    <b-row>
      <b-col class="p-20">
        <b-form-group v-for="(item, i) in reQuestions" :key="i" :label="item.label">
          <b-form-radio-group v-model="answers[i]" :options="item.choices"/>
        </b-form-group>
      </b-col>
    </b-row>
  </b-modal>
</template>

<script>
export default {
    props: ["title", "questions", "time_limit"],
    data() {
        return {
            time_left: this.time_limit,
            answers: []
        };
    },
    computed: {
        reQuestions() {
            const questions = this.shuffle(this.questions);
            return questions.map(item => {
                const choices = this.shuffle(item.choice);
                return {
                    label: item.question,
                    choices: choices.map((choice, j) => {
                        return {
                            text: choice.text,
                            value: choice.text
                        };
                    })
                };
            });
        }
    },
    methods: {
        show() {
            this.$refs.modal.show();
            if (this.time_left > 0) {
                setInterval(() => {
                    this.time_left = this.time_left - 1;
                }, 1000);
            } else {
              this.$emit("timeOver", this.answers);
            }
        },
        submit() {
            this.$emit("submit", this.answers);
        }
    }
};
</script>

<style>
</style>
