<template>
  <div class="widget-panel">
    <div class="white-box filter-box">
      <el-select
        v-model="vika_type_id"
        placeholder="Выберите тип Vika"
        filterable
        :value-on-clear="null"
        clearable
        :loading="loadingVikaType"
        size="large"
        @change="getStructure();setParams('vika_type', vika_type)">
        <el-option
          v-for="item in vikaTypesList"
          :key="'vikaTypesList'+item.id"
          :label="item.description"
          :value="item.id">
        </el-option>
      </el-select>
    </div>
    <div v-if="vika_type_id!==null" v-loading="loadingStructure" class="white-box structure">
      <div class="button-top-box">
        <el-button
          size="large"
          type="primary"
          @click="setNewCategory()"
        >
          Добавить категорию
        </el-button>
        <el-button
          size="large"
          type="success"
          @click="setNewWidget()"
        >
          Привязать виджет
        </el-button>
      </div>
      <div v-for="item in structure" :key="'structure'+item.id" class="item-position">
        <div v-if="!item.is_widget" class="category">
          <div class="line-box">
            <div :class="['arrow', item.active ? 'active' : '']"  @click="item.active = !item.active"></div>
            <div :class="['icon',item.icon!==null ? item.icon.code : '' ]"  @click="item.active = !item.active">
              <div class="grad" :style="item.bg_colour!==null ? 'background:'+item.bg_colour : ''"></div>
            </div>
            <div class="title" @click="item.active = !item.active">
              <div :class="['name', item.is_favorite ? ' favorite' : '']">{{ item.name }}</div>
              <div class="description">{{ item.description }}</div>
            </div>
            <div class="button-box">
              <el-button circle type="warning" title="Редактировать" @click="setUpdateCategory(item)">
                <div class="ico ico-edit"></div>
              </el-button>
              <el-button circle type="danger" title="Удалить" @click="deleteCategory(item)">
                <div class="ico ico-delete"></div>
              </el-button>
            </div>
          </div>
          <div v-if="item.active" class="widgets-box">
            <div v-for="itemWidget in item.attached_to_vika_type_widgets" :key="'widget'+itemWidget.id" class="widget">
              <div :class="['icon', itemWidget.widget.icon!==null ? itemWidget.widget.icon.code : '']">
                <div
class="grad"
                     :style="itemWidget.widget.bg_colour!==null ? 'background:'+itemWidget.widget.bg_colour : ''"></div>
              </div>
              <div class="title">
                <div :class="['name', itemWidget.is_favorite ? ' favorite' : '' ]">{{ itemWidget.widget.name }}</div>
                <div class="description">{{ itemWidget.widget.description }}</div>
              </div>
              <div class="button-box">
                <el-button circle type="warning" title="Редактировать" @click="setUpdateWidget(itemWidget)">
                  <div class="ico ico-edit"></div>
                </el-button>
                <el-button circle type="danger" title="Отвязать" @click="deleteWidget(itemWidget)">
                  <div class="ico ico-delete"></div>
                </el-button>
              </div>
            </div>
          </div>
        </div>
        <div v-if="item.is_widget" class="widget" style="margin-left: 23px">
          <div :class="['icon', item.widget.icon!==null ? item.widget.icon.code : '']">
            <div class="grad" :style="item.widget.bg_colour!==null ? 'background:'+item.widget.bg_colour : ''"></div>
          </div>
          <div class="title">
            <div :class="['name', item.is_favorite ? ' favorite' : '']">{{ item.widget.name }}</div>
            <div class="description">{{ item.widget.description }}</div>
          </div>
          <div class="button-box">
            <el-button circle type="warning" title="Редактировать" @click="setUpdateWidget(item)">
              <div class="ico ico-edit"></div>
            </el-button>
            <el-button circle type="danger" title="Отвязать" @click="deleteWidget(item)">
              <div class="ico ico-delete"></div>
            </el-button>
          </div>
        </div>
      </div>
    </div>

    <el-dialog
      v-if="modalActiveCategory"
      v-model="modalActiveCategory"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      title="Новая категория"
      :before-close="beforeCloseNewCategory"
    >
      <el-form
        ref="newCategoryRef"
        :model="newCategory"
        label-width="auto"
        size="large"
        :rules="rulesCategory"
        style="width: 100%"
        status-icon
        @keydown.stop.prevent.enter="newCategorySave()"
      >

        <el-form-item label="Панель на главной" prop="is_favorite">
          <el-checkbox v-model="newCategory.is_favorite" :value="true" name="is_favorite">Отображать на главной
          </el-checkbox>
        </el-form-item>

        <el-form-item
          label="Сортировка"
          prop="order"
        >
          <el-input
            v-model="newCategory.order"
            placeholder="Сортировка"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Название"
          prop="name"
        >
          <el-input
            v-model="newCategory.name"
            placeholder="Название"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Описание"
          prop="description"
        >
          <el-input
            v-model="newCategory.description"
            placeholder="Описание"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Иконка"
          prop="icon_id"
        >
          <el-select
            v-model="newCategory.icon_id"
            placeholder="Иконка"
            filterable
            clearable
            :value-on-clear="null"
            :loading="loadingIcons"
            size="large">
            <el-option
              v-for="item in iconList"
              :key="'iconList'+item.id"
              :label="item.name"
              :value="item.id">

              <div :class="['icon',item.code ]">
                <div class="grad" style="background:#236bd8;"></div>
              </div>
              <div style="margin-left: 10px">{{ item.name }}</div>
            </el-option>
          </el-select>
        </el-form-item>

        <el-form-item
          label="Цвет иконки"
          prop="bg_colour"
        >
          <el-color-picker v-model="newCategory.bg_colour" size="large"/>
        </el-form-item>

      </el-form>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="clearNewCategory();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="newCategorySave()">
            Добавить
          </el-button>
        </div>
      </template>

    </el-dialog>
    <el-dialog
      v-if="modalActiveCategoryUpdate"
      v-model="modalActiveCategoryUpdate"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      title="Изменение категории"
      :before-close="beforeCloseUpdateCategory"
    >
      <el-form
        ref="updateCategoryRef"
        :model="updateCategory"
        label-width="auto"
        size="large"
        :rules="rulesCategory"
        style="width: 100%"
        status-icon
        @keydown.stop.prevent.enter="updateCategorySave()"
      >

        <el-form-item label="Панель на главной" prop="is_favorite">
          <el-checkbox v-model="updateCategory.is_favorite" :value="true" name="is_favorite">Отображать на главной
          </el-checkbox>
        </el-form-item>

        <el-form-item
          label="Сортировка"
          prop="order"
        >
          <el-input
            v-model="updateCategory.order"
            placeholder="Сортировка"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Название"
          prop="name"
        >
          <el-input
            v-model="updateCategory.name"
            placeholder="Название"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Описание"
          prop="description"
        >
          <el-input
            v-model="updateCategory.description"
            placeholder="Описание"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Иконка"
          prop="icon_id"
        >
          <el-select
            v-model="updateCategory.icon_id"
            placeholder="Иконка"
            filterable
            clearable
            :value-on-clear="null"
            :loading="loadingIcons"
            size="large">
            <el-option
              v-for="item in iconList"
              :key="'iconList'+item.id"
              :label="item.name"
              :value="item.id">
                <div :class="['icon',item.code ]">
                  <div class="grad" style="background:#236bd8;"></div>
                </div>
                <div style="margin-left: 10px">{{ item.name }}</div>
            </el-option>
          </el-select>
        </el-form-item>

        <el-form-item
          label="Цвет иконки"
          prop="bg_colour"
        >
          <el-color-picker v-model="updateCategory.bg_colour" size="large"/>
        </el-form-item>

      </el-form>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="clearUpdateCategory();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="updateCategorySave()">
            Сохранить
          </el-button>
        </div>
      </template>

    </el-dialog>
    <el-dialog
      v-if="modalActiveWidget"
      v-model="modalActiveWidget"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      title="Привязка виджета"
      :before-close="beforeCloseNewWidget"
    >
      <el-form
        ref="newWidgetRef"
        :model="newWidget"
        label-width="auto"
        size="large"
        :rules="rulesWidget"
        style="width: 100%"
        status-icon
        @keydown.stop.prevent.enter="newWidgetSave()"
      >

        <el-form-item label="Панель на главной" prop="is_favorite">
          <el-checkbox v-model="newWidget.is_favorite" :value="true" name="is_favorite">Отображать на главной
          </el-checkbox>
        </el-form-item>

        <el-form-item
          label="Сортировка"
          prop="order"
        >
          <el-input
            v-model="newWidget.order"
            placeholder="Сортировка"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Виджет"
          prop="chat_widget_id"
        >
          <el-select
            v-model="newWidget.chat_widget_id"
            placeholder="Виджет"
            filterable
            clearable
            :value-on-clear="null"
            :loading="loadingWidget"
            size="large">
            <el-option
              v-for="item in widgetList"
              :key="'widgetList'+item.id"
              :label="item.name"
              :value="item.id">
            </el-option>
          </el-select>
        </el-form-item>

        <el-form-item
          label="Категория"
          prop="category_id"
        >
          <el-select
            v-model="newWidget.category_id"
            placeholder="Категория"
            filterable
            clearable
            :value-on-clear="null"
            :loading="loadCategory"
            size="large">
            <el-option
              v-for="item in categoryList"
              :key="'categoryList'+item.id"
              :label="item.name"
              :value="item.id">
            </el-option>
          </el-select>
        </el-form-item>

      </el-form>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeNewWidget();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="newWidgetSave()">
            Добавить
          </el-button>
        </div>
      </template>

    </el-dialog>
    <el-dialog
      v-if="modalActiveWidgetUpdate"
      v-model="modalActiveWidgetUpdate"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      title="Изменение привязки виджета"
      :before-close="beforeCloseUpdateWidget"
    >
      <el-form
        ref="updateWidgetRef"
        :model="updateWidget"
        label-width="auto"
        size="large"
        :rules="rulesWidgetUpdate"
        style="width: 100%"
        status-icon
        @keydown.stop.prevent.enter="updateWidgetSave()"
      >

        <el-form-item label="Панель на главной" prop="is_favorite">
          <el-checkbox v-model="updateWidget.is_favorite" :value="true" name="is_favorite">Отображать на главной
          </el-checkbox>
        </el-form-item>

        <el-form-item
          label="Сортировка"
          prop="order"
        >
          <el-input
            v-model="updateWidget.order"
            placeholder="Сортировка"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Виджет"
          prop="widget_id"
        >
          <el-select
            v-model="updateWidget.widget_id"
            placeholder="Виджет"
            filterable
            clearable
            disabled
            size="large">
            <el-option
              :label="updateWidget.widget.name"
              :value="updateWidget.widget.id">
            </el-option>
          </el-select>
        </el-form-item>

        <el-form-item
          label="Категория"
          prop="category_id"
        >
          <el-select
            v-model="updateWidget.category_id"
            placeholder="Категория"
            filterable
            clearable
            :value-on-clear="null"
            :loading="loadCategory"
            size="large">
            <el-option
              v-for="item in categoryList"
              :key="'categoryList'+item.id"
              :label="item.name"
              :value="item.id">
            </el-option>
          </el-select>
        </el-form-item>

      </el-form>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeUpdateWidget();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="updateWidgetSave()">
            Сохранить
          </el-button>
        </div>
      </template>

    </el-dialog>

  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'WidgetPanel',
  data() {
    return {
      vika_type_id: null,
      loadingVikaType: false,
      vikaTypesList: [],
      loadingStructure: false,
      structure: [],
      iconList: [],
      loadingIcons: false,
      loadingWidget: false,
      widgetList: [],
      newCategory: {
        name: null,
        description: null,
        icon_id: null,
        bg_colour: null,
        order: 100,
        is_favorite: false,
      },
      updateCategory: {
        id: null,
        name: null,
        description: null,
        icon_id: null,
        bg_colour: null,
        order: 100,
        is_favorite: false,
      },
      modalActiveCategory: false,
      loadSave: false,
      rulesCategory: {
        name: [
          {required: true, message: 'Введите название', trigger: 'blur'}
        ],
      },

      modalActiveWidget: false,
      newWidget: {
        chat_widget_id: null,
        vika_type_id: null,
        category_id: null,
        order: 100,
        is_favorite: false,
      },
      updateWidget: {
        widget_id: null,
        widget: null,
        attaching_id: null,
        category_id: null,
        order: 100,
        is_favorite: false,
      },
      categoryList: [],
      loadCategory: false,
      rulesWidget: {
        chat_widget_id: [
          {required: true, message: 'Выберите виджет', trigger: 'blur'}
        ]
      },
      rulesWidgetUpdate: {},
      modalActiveCategoryUpdate: false,
      modalActiveWidgetUpdate: false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI','isMobile']),
  },
  created() {
    this.initialData();
    this.getIconsList();
    this.getVikaTypes();
  },
  methods: {
    initialData() {
      if (this.$route.query.vika_type) {
        this.vika_type = this.$route.query.vika_type;
        this.getStructure(this.vika_type);
      }
    },
    setParams(name, value) {
      if (name !== undefined) {
        if (value !== null && value !== '') {
          this.$router.replace({
            path: this.$route.path,
            query: {...this.$route.query, [name]: value}
          });
        } else {
          let query = {...this.$route.query};
          delete query[name];
          this.$router.replace({
            path: this.$route.path,
            query: query
          });
        }
      }
    },
    getVikaTypes() {
      this.loadingVikaType = true;
      this.$axios.get(this.linkAPI + 'chat/vika_types/list', {params: {need_pagination: 0}})
        .then((response) => {
          console.log('Типы Vika:', response);
          this.vikaTypesList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingVikaType = false;
        })
      ;
    },
    getStructure() {
      this.loadingStructure = true;
      this.$axios.get(this.linkAPI + 'chat/vika_types/' + this.vika_type_id + '/get_menu')
        .then((response) => {
          console.log('Структура:', response);
          this.structure = response.data.map(item => {
            return {...item, active: false};
          });
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingStructure = false;
        })
      ;
    },
    getIconsList() {
      this.loadingIcons = true;
      this.$axios.get(this.linkAPI + 'chat/widgets/get_icons')
        .then((response) => {
          console.log('Иконки виджетов:', response);
          this.iconList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingIcons = false;
        });
    },
    getWidgetList() {
      this.loadingWidget = true;
      this.widgetList = [];
      let params = {
        need_pagination: 0,
        exclude_vika_types: [this.vika_type_id]
      };
      this.$axios.get(this.linkAPI + 'chat/widgets/list', {params})
        .then((response) => {
          console.log('Виджеты:', response);
          this.widgetList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingWidget = false;
        })
      ;
    },
    setNewCategory() {
      this.newCategory = {
        name: null,
        description: null,
        icon_id: null,
        bg_colour: null,
        order: 100,
        is_favorite: false,
      };
      this.modalActiveCategory = true;
    },
    clearNewCategory() {
      this.newCategory = {
        name: null,
        description: null,
        icon_id: null,
        bg_colour: null,
        order: 100,
        is_favorite: false,
      };
      this.modalActiveCategory = false;
    },
    beforeCloseNewCategory(done) {
      this.clearNewCategory();
      done();
    },
    newCategorySave() {
      this.$refs.newCategoryRef.validate((valid) => {
        if (valid) {
          this.loadSave = true;
          this.$axios.post(this.linkAPI + 'chat/vika_types/' + this.vika_type_id + '/add_widget_category', this.newCategory)
            .then((response) => {
              console.log('Добавление категории:', response);
              if (response.data.success) {
                ElMessage({
                  message: 'Категория успешно добавлена',
                  type: 'success'
                });
                this.getStructure(this.vika_type);
                this.clearNewCategory();
              } else {
                ElMessage({
                  message: response.data.error,
                  type: 'error'
                });
              }
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.loadSave = false;
            })
          ;
        } else {
          return false;
        }
      });
    },
    deleteCategory(category) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить категорию «' + category.name + '»?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadingStructure = true;
          this.$axios.post(this.linkAPI + 'chat/widgets/categories/' + category.id + '/delete')
            .then((response) => {
              console.log('Удаление категории:', response.data);
              if (response.data.success) {
                ElMessage({
                  type: 'success',
                  message: 'Категория успешно удалена',
                });
                this.getStructure();
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
                });
              }
            })
            .catch((error) => {
              console.log(error);
              ElMessage({
                type: 'error',
                message: error.response.data.message,
              });

            })
            .finally(() => {
              this.loadingStructure = false;
            });
        });
    },
    deleteWidget(widget) {
      ElMessageBox.confirm(
        'Вы действительно хотите отвязать виджет «' + widget.widget.name + '»?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadingStructure = true;
          this.$axios.post(this.linkAPI + 'chat/widgets/attaching/' + widget.id + '/delete')
            .then((response) => {
              console.log('Отвязка виджета:', response.data);
              if (response.data.success) {
                ElMessage({
                  type: 'success',
                  message: 'Виджет успешно отвязан',
                });
                this.getStructure();
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
                });
              }
            })
            .catch((error) => {
              console.log(error);
              ElMessage({
                type: 'error',
                message: error.response.data.message,
              });

            })
            .finally(() => {
              this.loadingStructure = false;
            });
        });
    },
    beforeCloseNewWidget(done) {
      this.closeNewWidget();
      done();
    },
    closeNewWidget() {
      this.newWidget = {
        chat_widget_id: null,
        vika_type_id: null,
        category_id: null,
        order: 100,
        is_favorite: false,
      };
      this.modalActiveWidget = false;
    },
    setNewWidget() {
      this.newWidget = {
        chat_widget_id: null,
        vika_type_id: this.vika_type_id,
        category_id: null,
        order: 100,
        is_favorite: false,
      };
      this.getWidgetList();
      this.getCategoryList();
      this.modalActiveWidget = true;
    },
    getCategoryList() {
      this.loadCategory = true;
      this.$axios.get(this.linkAPI + 'chat/vika_types/' + this.vika_type_id + '/get_widget_categories')
        .then((response) => {
          console.log('Категории:', response);
          this.categoryList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadCategory = false;
        })
      ;
    },
    newWidgetSave() {
      this.$refs.newWidgetRef.validate((valid) => {
        if (valid) {
          this.loadSave = true;
          this.$axios.post(this.linkAPI + 'chat/widgets/attaching/create', this.newWidget)
            .then((response) => {
              console.log('Добавление виджета:', response);
              if (response.data.success) {
                ElMessage({
                  message: 'Виджет успешно добавлен',
                  type: 'success'
                });
                this.getStructure();
                this.closeNewWidget();
              } else {
                ElMessage({
                  message: response.data.error,
                  type: 'error'
                });
              }
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.loadSave = false;
            })
          ;
        } else {
          return false;
        }
      });
    },
    setUpdateCategory(category) {
      this.updateCategory = {
        id: category.id,
        name: category.name,
        description: category.description,
        icon_id: category.icon_id,
        bg_colour: category.bg_colour,
        order: category.order,
        is_favorite: category.is_favorite
      };
      this.modalActiveCategoryUpdate = true;
    },
    clearUpdateCategory() {
      this.updateCategory = {
        id: null,
        name: null,
        description: null,
        icon_id: null,
        bg_colour: null,
        order: 100,
        is_favorite: false,
      };
      this.modalActiveCategoryUpdate = false;
    },
    beforeCloseUpdateCategory(done) {
      this.clearUpdateCategory();
      done();
    },
    updateCategorySave() {
      this.$refs.updateCategoryRef.validate((valid) => {
        if (valid) {
          this.loadSave = true;
          this.$axios.post(this.linkAPI + 'chat/widgets/categories/' + this.updateCategory.id + '/update', this.updateCategory)
            .then((response) => {
              console.log('Изменение категории:', response);
              if (response.data.success) {
                ElMessage({
                  message: 'Категория успешно изменена',
                  type: 'success'
                });
                this.getStructure(this.vika_type);
                this.clearUpdateCategory();
              } else {
                ElMessage({
                  message: response.data.error,
                  type: 'error'
                });
              }
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.loadSave = false;
            })
          ;
        } else {
          return false;
        }
      });
    },
    setUpdateWidget(widget) {
      this.updateWidget = {
        widget_id: widget.widget.id,
        widget: widget.widget,
        attaching_id: widget.id,
        category_id: widget.category_id,
        order: widget.order,
        is_favorite: widget.is_favorite,
      };
      this.modalActiveWidgetUpdate = true;
      this.getCategoryList();
    },
    beforeCloseUpdateWidget(done) {
      this.closeUpdateWidget();
      done();
    },
    closeUpdateWidget() {
      this.updateWidget = {
        widget_id: null,
        widget: null,
        attaching_id: null,
        category_id: null,
        order: 100,
        is_favorite: false,
      };
      this.modalActiveWidgetUpdate = false;
    },
    updateWidgetSave() {
      this.$refs.updateWidgetRef.validate((valid) => {
        if (valid) {
          this.loadSave = true;
          this.$axios.post(this.linkAPI + 'chat/widgets/attaching/' + this.updateWidget.attaching_id + '/update', this.updateWidget)
            .then((response) => {
              console.log('Изменение привязки виджета:', response);
              if (response.data.success) {
                ElMessage({
                  message: 'Виджет успешно изменен',
                  type: 'success'
                });
                this.getStructure();
                this.closeUpdateWidget();
              } else {
                ElMessage({
                  message: response.data.error,
                  type: 'error'
                });
              }
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.loadSave = false;
            })
          ;
        } else {
          return false;
        }
      });
    }

  }
};
</script>

<style scoped>
.dialog-footer {
  display: flex;
  gap: 10px;
  align-items: center;
  justify-content: flex-end;
}

.structure {
  margin-top: 20px;
}

.button-top-box {
  display: flex;
  gap: 20px;
}

.item-position {
  margin-top: 20px;
}

.widget {
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: flex-start;
}

.category .line-box .title {
  cursor: pointer;
}

.category .line-box {
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: flex-start;
}

.category .widgets-box {
  margin-left: 70px;
}

.widgets-box .widget {
  margin-top: 20px;
}

.item-position .title .name {
  font-size: 16px;
  font-weight: 600;
  letter-spacing: 0.3px;
}

.name.favorite{
  color: #236bd8;
}

.item-position .title .description {
  font-size: 13px;
  font-weight: 400;
  letter-spacing: -0.3px;
  transition: 0.2s ease;
}

.item-position .button-box {
  display: flex;
  align-items: center;
  gap: 5px;
}

.arrow {
  transform: rotate(180deg);
  width: 13px;
  height: 8px;
  background: url("../../../assets/vi-icons/spanel_arrow.svg") center no-repeat;
  background-size: 13px;
  transition: 0.3s ease;
}

.arrow.active {
  transform: rotate(0deg);
}

.button-box .ico {
  width: 22px;
  height: 22px;
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 22px;
}

.button-box .ico.ico-edit {
  background-color: var(--el-color-white);
  mask-image: url("../../../assets/icons/Pencil.svg");
}

.button-box .ico.ico-delete {
  background-color: var(--el-color-white);
  mask-image: url("../../../assets/icons/Trash 3.svg");
}

.button-box .ico.ico-close {
  background-color: var(--el-color-black);
  mask-image: url("../../../assets/icons/Cross.svg");
}

.button-box .ico.ico-login {
  background-color: var(--el-color-white);

  mask-image: url("../../../assets/icons/Sign_in.svg");
}

</style>
