<template>
  <div>
    <table :id="id" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th v-if="checkable"></th>
          <th v-for="(item, i) in columns" :key="i" :class="item.class">
            {{ item.text }}
          </th>
          <th v-if="!disabledActions"></th>
        </tr>
      </thead>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      required: true
    },
    columns: {
      type: Array,
      required: true
    },
    buttons: {
      type: Array,
      default: () => []
    },
    url: {
      type: String,
      default: '',
      required: true
    },
    disabledActions: {
      tyle: Boolean,
      default: false
    },
    checkType: {
      type: String,
      default: 'checkbox'
    },
    checkable: {
      type: Boolean,
      default: false
    },
    newable: {
      type: Boolean,
      default: false
    },
    viewable: {
      type: Boolean,
      default: true
    },
    editable: {
      type: Boolean,
      default: true
    },
    deleteable: {
      type: Boolean,
      default: true
    },
    exportable: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    table: '',
    searching: [],
    data: []
  }),
  mounted() {
    const self = this
    $(() => {
      self.table = $(`#${self.id}`).DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        dom: 'lBfrtip',
        buttons: self.renderButtons(),
        ajax: this.url,
        columns: self.renderColumns(),
        drawCallback: () => {
          $('.btn-viewable').on('click', function() {
            self.$emit('clickView', self.getData(this))
          })
          $('.btn-editable').on('click', function() {
            self.$emit('clickEdit', self.getData(this))
          })
          $('.btn-deleteable').on('click', function() {
            self.alertErrorConfirm().then(result => {
              if (result.value) {
                self.$emit('clickDelete', self.getData(this))
              }
            })
          })
          $('.checkable').on('click', function() {
            if (self.checkType === 'checkbox') {
              let datas = []
              $(this)
                .closest('tbody')
                .find('tr')
                .map((key, item) => {
                  const el = $(item).find("input[type='checkbox']")
                  if (el.prop('checked')) {
                    datas.push(JSON.parse($(el).attr('data')))
                  }
                })
              self.$emit('check', datas)
            } else {
              self.$emit('check', JSON.parse($(this).attr('data')))
            }
          })
        }
      })
    })
  },
  methods: {
    renderColumns() {
      const self = this
      const cols = [...this.columns]
      if (!this.disabledActions) {
        cols.push({
          data: null,
          responsivePriority: 2,
          searchable: false,
          orderable: false,
          className: 'fit',
          render: (data, type, row) => {
            return `<div class="actions" data='${JSON.stringify(
              row,
              self.replacer,
              '\t'
            )}'>
                  ${row['hideViewable'] ? '' : self.renderView()}
                  ${row['hideEditable'] ? '' : self.renderEdit()}
                  ${row['hideDeleteable'] ? '' : self.renderDelete()}
              </div>`
          }
        })
      }
      if (this.checkable) {
        cols.unshift({
          data: null,
          responsivePriority: 2,
          searchable: false,
          orderable: false,
          className: 'fit',
          render: (data, type, row) => {
            return `<input type="${
              self.checkType
            }" class="checkable" name="checkable" data='${JSON.stringify(
              row
            )}'>`
          }
        })
      }
      return cols
    },
    renderButtons() {
      const self = this
      const btnWithNew =
        this.newable && !this.disabledActions
          ? [
              {
                text: 'เพิ่ม',
                action: function(e) {
                  self.$emit('clickNew', e)
                },
                className: 'btn-sm btn-success'
              },
              ...this.buttons
            ]
          : this.buttons
      return this.exportable
        ? [
            ...btnWithNew,
            {
              text: 'Excel',
              action: function() {
                self
                  .post(self.url.replace('index', 'excel'), self.data)
                  .then(({ data }) => {
                    window.open(`/download/excel/${data}`, '_blank')
                  })
              },
              className: 'btn-sm'
            }
          ]
        : btnWithNew
    },
    renderView() {
      return this.viewable
        ? `<button type="button" class="btn btn-primary btn-xs btn-viewable">
          <i class="fa fa-search"></i>
        </button>`
        : ''
    },
    renderEdit() {
      return this.editable
        ? `<button type="button" class="btn btn-warning btn-xs btn-editable">
          <i class="fa fa-edit"></i>
        </button>`
        : ''
    },
    renderDelete() {
      return this.deleteable
        ? `<button type="button" class="btn btn-danger btn-xs btn-deleteable">
          <i class="fa fa-trash-alt"></i>
        </button>`
        : ''
    },
    reload() {
      return this.table.ajax.reload()
    },
    getData(element) {
      const data = JSON.parse(
        $(element)
          .closest('div')
          .attr('data')
      )
      return data
    }
  }
}
</script>

<style></style>
