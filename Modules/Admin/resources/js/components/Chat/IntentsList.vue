<template>
  <div class="intents-list">
    <div class="white-box filter-box">
      <el-input
        v-model="filter.name"
        size="large"
        clearable
        placeholder="Поиск по названию и коду"
        @clear="getIntentsList();setParams('name',filter.name);"
        @keyup.enter="getIntentsList();setParams('name',filter.name);"
      ></el-input>
      <el-select
        v-model="filter.exclude_vika_type_id"
        placeholder="Тип Vika"
        filterable
        clearable
        :loading="loadingVikaTypes"
        size="large"
        @change="getIntentsList();setParams('exclude_vika_type_id',filter.exclude_vika_type_id);">
        <el-option
          v-for="item in vikaTypesList"
          :key="'vikaTypesList'+item.id"
          :label="item.description"
          :value="item.id"
        >
        </el-option>
      </el-select>
      <el-select
        v-model="filter.active"
        placeholder="Активность"
        filterable
        clearable
        size="large"
        @change="getIntentsList();setParams('active',filter.active);">
        <el-option
          v-for="item in activeList"
          :key="'activeList'+item.id"
          :label="item.name"
          :value="item.id">
        </el-option>
      </el-select>
      <el-button
        size="large"
        class="filter-button"
        type="primary"
        @click="setGraphic(0);"
      >
        График
      </el-button>
      <el-button
        size="large"
        class="filter-button"
        type="success"
        @click="setNewIntent();"
      >
        Добавить интент
      </el-button>
    </div>
    <div class="table-box white-box">
      <el-table
        ref="intentTable"
        v-loading="loadingTable"
        :data="intentsList"
        row-key="id"
        style="width: 100%"
        stripe
        table-layout="auto"
        :scrollbar-always-on="true"
        @selection-change="selectionTableChange"
      >
        <el-table-column type="selection" width="55"/>
        <el-table-column property="name" label="Название"/>
        <el-table-column property="code" label="Код"/>
        <el-table-column label="Активность" align="center" header-align="center">
          <template #default="scope">
            {{ scope.row.active ? 'Активен' : 'Не активен' }}
          </template>
        </el-table-column>
        <el-table-column label="" width="100px" align="center" header-align="center">
          <template #default="scope">
            <div class="table-button-box">
              <el-button circle type="warning" title="Редактировать интент" @click="getIntent(scope.row.id)">
                <div class="ico ico-edit"></div>
              </el-button>
              <el-button circle type="danger" title="Удалить интент" @click="setDeleteIntent(scope.row)">
                <div class="ico ico-delete"></div>
              </el-button>
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="pagination-box white-box">
      <el-pagination
        v-model:current-page="pagination.current_page"
        v-model:page-size="pagination.per_page"
        v-model:total="pagination.total"
        :page-sizes="[1, 15, 50, 100]"
        :pager-count="isMobile ? 5 : 7"
        :background="true"
        :layout="isMobile ? 'prev, pager, next' : 'total,sizes, prev, pager, next, jumper'"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
      />
      <div class="button-box">
        <el-button
          v-if="selectTable.length!==0" circle type="danger" title="Удалить ответы"
          @click="setDeleteIntentGroup()">
          <div class="ico ico-delete"></div>
        </el-button>
      </div>

    </div>

    <el-dialog
      v-if="modalActive"
      v-model="modalActive"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      :top="full?'20px':'15vh'"
      :before-close="handleClose"
      :title="intentInfo.id ? 'Редактирование интента' :'Новый интент'"
    >
      <div v-loading="loadIntent" class="dialog-content-box">
        <el-form
          ref="intent-form"
          :model="intentInfo"
          label-width="auto"
          size="large"
          :rules="rules"
          style="width: 100%"
          status-icon
        >

          <el-form-item label="Активность" prop="active">
            <el-checkbox v-model="intentInfo.active" :value="true" name="active">Активный</el-checkbox>
          </el-form-item>

          <el-form-item
            label="Название"
            prop="name"
          >
            <el-input
              v-model="intentInfo.name"
              placeholder="Название"
              size="large"
            />
          </el-form-item>

          <el-form-item
            label="Код"
            prop="code"
          >
            <el-input
              v-model="intentInfo.code"
              placeholder="Код"
              size="large"
            />
          </el-form-item>

          <el-form-item
            label="Обработчик интента"
            prop="handler_id"
          >
            <el-select
              v-model="intentInfo.handler_id"
              placeholder="Выберите обработчик"
              filterable
              :value-on-clear="null"
              clearable
              :loading="loadingHandler"
              size="large"
              @change="isHandler(intentInfo.handler_id)">
              <el-option
                v-for="item in handlerList"
                :key="'handlerList'+item.name"
                :label="item.name+' ( '+item.code+' )'"
                :value="item.id">
                {{ item.name + ' ( ' + item.code + ' )' }}
              </el-option>
            </el-select>
          </el-form-item>

          <el-form-item
            v-if="full"
            label="Контекст поиска"
            prop="document"
          >
            <el-input
              v-model="intentInfo.document"
              placeholder="Контекст поиска"
              size="large"
              type="textarea"
              :rows="3"
            />
          </el-form-item>

          <el-form-item
            v-if="full"
            label="Cистемный промпт"
            prop="system_prompt"
          >
            <el-input
              v-model="intentInfo.system_prompt"
              placeholder="Cистемный промпт"
              size="large"
              type="textarea"
              :rows="3"
            />
          </el-form-item>

        </el-form>

        <el-dialog
          v-model="modalActiveText"
          title="Новый пример вопроса"
          style="max-width: 600px; width: 90%; min-width: 320px"
          :close-on-click-modal="false"
        >

          <el-form
            ref="text-form"
            :model="testRequests"
            label-width="auto"
            size="large"
            :rules="rule"
            style="width: 100%"
            status-icon
            @keydown.stop.prevent.enter="setCreateTestRequests()"
          >
            <el-form-item
              label="Текст"
              prop="text"
            >
              <el-input
                ref="textQuestion"
                v-model="testRequests.text"
                placeholder="Текст"
                size="large"
              />
            </el-form-item>
          </el-form>

          <div v-loading="loadRecommendation" class="recommendation-box">
            <div class="title-recommendation">Рекомендации</div>
            <div v-for="item in recommendationList" :key="item" class="item-recommendation">
              <a
                href=""
                class="link-recommendation"
                @click.stop.prevent="testRequests.text=item"
              >
                {{ item }}
              </a>
            </div>
            <div v-if="recommendationList.length===0 && !loadRecommendation" class="item-recommendation">Для выбранного
              интента нет рекомендаций
            </div>
          </div>


          <template #footer>
            <div class="dialog-footer">
              <el-button @click="modalActiveText = false">Отмена</el-button>
              <el-button type="primary" :loading="loadSaveTestRequests" @click="setCreateTestRequests()">
                Добавить
              </el-button>
            </div>
          </template>

        </el-dialog>

        <div v-if="intentInfo.test_requests" class="test-requests-box scroll-box">
          <div class="test-requests-title">Примеры вопросов
            <el-button @click="setNewTestRequests(intentInfo.id)">Добавить</el-button>
          </div>
          <div
            v-for="(item, index) in intentInfo.test_requests" :key="'test_requests'+index.id"
            class="test-requests-item">
            <div>{{ item.text }}</div>
            <el-button circle type="danger" title="Удалить" @click="deleteTestRequest(item)">
              <div class="ico ico-delete"></div>
            </el-button>
          </div>
        </div>


      </div>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeIntent();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="intentInfo.id ? updateIntent() :createIntent()">
            {{ intentInfo.id ? 'Сохранить' : 'Добавить' }}
          </el-button>
        </div>
      </template>

    </el-dialog>

    <el-drawer
      v-if="modalGraphic"
      v-model="modalGraphic"
      title="График"
      :close-on-click-modal="false"
      size="100%"
      direction="btt"
      :before-close="beforeCloseGraphic"
    >
      <div v-loading="loadGraphic" class="graphic-box">
        <iframe
          v-if="dataGraphic!==null" :srcdoc="dataGraphic.plot"
          style="border: none; width: 100%; height: 100%"></iframe>
      </div>
      <template #footer>
        <div class="dialog-footer">
          <div v-if="dataGraphic!==null">{{ dataGraphic.last_updated_at }}</div>
          <el-button @click="setGraphic(1);">Обновить</el-button>
        </div>
      </template>
    </el-drawer>

  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'IntentsList',
  data() {
    return {
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      filter: {
        name: null,
        exclude_vika_type_id: null,
        active: null,
        need_pagination: 1,
      },
      activeList: [
        {
          id: 1,
          name: 'Активные',
        },
        {
          id: 0,
          name: 'Не активные',
        },
      ],
      selectTable: [],
      modalActive: false,
      loadSave: false,
      loadingTable: false,
      vikaTypesList: [],
      loadingVikaTypes: false,
      intentsList: [],
      intentInfo: {
        name: null,
        code: null,
        handler_id: null,
        document: null,
        system_prompt: null,
        active: true,
      },
      rules: {
        'name': [{
          required: true,
          message: 'Введите название',
          trigger: 'blur',
        }],
        'code': [{
          required: true,
          message: 'Введите код',
          trigger: 'blur',
        }],
        'handler_id': [{
          required: true,
          message: 'Выберите обработчик',
          trigger: 'change',
        }],
      },
      rule: {
        'text': [
          {
            required: true,
            message: 'Введите текст',
            trigger: 'blur',
          }
        ]
      },
      testRequests: {
        text: null,
      },
      modalActiveText: false,
      loadSaveTestRequests: false,
      loadIntent: false,
      loadRecommendation: false,
      recommendationList: [],
      loadGraphic: false,
      dataGraphic: null,
      modalGraphic: false,
      loadingHandler: false,
      handlerList: [],
      full:false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI', 'isMobile']),
  },
  created() {
    this.initialData();
    this.getIntentsList();
    this.getHandlers();
    this.getVikaTypes();
  },
  methods: {
    getIntentsList(page) {
      this.loadingTable = true;
      let params = this.filter;
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;
      this.$axios.get(this.linkAPI + 'chat/intents/list', {params})
        .then((response) => {
          console.log('Интенты:', response);
          this.intentsList = response.data.data;
          this.pagination.current_page = response.data.current_page;
          this.pagination.per_page = response.data.per_page;
          this.pagination.total = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    handleCurrentChange(val) {
      this.getIntentsList(val);
      this.setParams('current_page', val);
    },
    handleSizeChange(val) {
      this.getIntentsList();
      this.setParams('per_page', val);
    },
    selectionTableChange(selection) {
      this.selectTable = selection;
    },
    getVikaTypes() {
      this.loadingVikaTypes = true;
      this.$axios.get(this.linkAPI + 'chat/vika_types/list')
        .then((response) => {
          console.log('Типы Vika:', response);
          this.vikaTypesList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingVikaTypes = false;
        });
    },
    createIntent() {
      this.$refs['intent-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.intentInfo;
          this.$axios.post(this.linkAPI + 'chat/intents/create', params)
            .then((response) => {
              console.log('Создание нового интента:', response.data);
              if (response.data.success) {
                this.modalActive = false;
                ElMessage({
                  type: 'success',
                  message: 'Интент успешно добавлен',
                });
                this.getIntentsList(this.pagination.current_page);
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
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
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    },
    updateIntent() {
      this.$refs['intent-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.intentInfo;
          this.$axios.post(this.linkAPI + 'chat/intents/' + this.intentInfo.id + '/update', params)
            .then((response) => {
              this.loading = false;
              console.log('Обновление интента:', response.data);
              if (response.data.success) {
                this.modalActive = false;
                ElMessage({
                  type: 'success',
                  message: 'Интент успешно обновлен',
                });
                this.getIntentsList(this.pagination.current_page);
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
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
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    },
    setNewIntent() {
      this.intentInfo = {
        name: null,
        code: null,
        handler_id: null,
        document: null,
        system_prompt: null,
        active: true,
      };
      this.modalActive = true;
    },
    getIntent(id) {
      this.loadingTable = true;
      this.loadIntent = true;
      this.$axios.get(this.linkAPI + 'chat/intents/' + id + '/get')
        .then((response) => {
          console.log('Интент:', response);
          this.intentInfo.id = response.data.id;
          this.intentInfo.name = response.data.name;
          this.intentInfo.code = response.data.code;
          this.intentInfo.handler_id = response.data.handler_id;
          this.intentInfo.active = response.data.active;
          this.intentInfo.test_requests = response.data.test_requests;
          this.intentInfo.document = response.data.document;
          this.intentInfo.system_prompt = response.data.system_prompt;
          this.modalActive = true;
          this.setParams('intent_id', this.intentInfo.id);
          this.isHandler(this.intentInfo.handler_id);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
          this.loadIntent = false;
        })
      ;
    },
    setCreateTestRequests() {
      this.$refs['text-form'].validate((valid) => {
        if (valid) {
          (async () => {
            let response = await this.canCreate(this.intentInfo.id, this.testRequests.text);

            console.log(response.data);

            if (response.data.can_add === null) {
              ElMessage.error(response.data.error);
            } else if (response.data.can_add === true) {
              this.createTestRequests();
            } else if (response.data.can_add === false) {
              let params = {
                description: response.data.description !== null ? response.data.description : '-',
                similarity: response.data.metrics !== null && response.data.metrics.similarity !== null ? response.data.metrics.similarity : '-',
                similar_test_request_text: response.data.metrics !== null && response.data.metrics.similar_test_request !== null ? response.data.metrics.similar_test_request.text : '-',
                intent_density_prev: response.data.metrics !== null && response.data.metrics.intent_density_prev !== null ? response.data.metrics.intent_density_prev : '-',
                intent_density_new: response.data.metrics !== null && response.data.metrics.intent_density_new !== null ? response.data.metrics.intent_density_new : '-',
                distant_to_nearest_intent_prev: response.data.metrics !== null && response.data.metrics.distant_to_nearest_intent_prev !== null ? response.data.metrics.distant_to_nearest_intent_prev : '-',
                distant_to_nearest_intent_new: response.data.metrics !== null && response.data.metrics.distant_to_nearest_intent_new !== null ? response.data.metrics.distant_to_nearest_intent_new : '-',
                nearest_intent_sample_text: response.data.metrics !== null && response.data.metrics.nearest_intent_sample !== null ? response.data.metrics.nearest_intent_sample.text : '-',
                nearest_intent_sample_chat_intent: response.data.metrics !== null && response.data.metrics.nearest_intent_sample !== null ? response.data.metrics.nearest_intent_sample.chat_intent.name : '-',
                nearest_intent_sample_chat_intent_id: response.data.metrics !== null && response.data.metrics.nearest_intent_sample !== null ? response.data.metrics.nearest_intent_sample.chat_intent.id : '-',
              };
              console.log(params);
              ElMessageBox.confirm(
                '<div class="error-message-box">' +
                '<div class="error-question">Вы действительно хотите добавить этот пример?</div>' +
                '<div class="error-description">' + params.description + '</div>' +
                '<div class="error-item"><div class="title-item-error">Похожесть примера вопроса на уже добавленный пример вопроса в данный интент:</div> <div class="text-item-error">' + params.similar_test_request_text + ' (' + params.similarity + ')</div></div>' +
                '<div class="error-item"><div class="title-item-error">Кучность интента:</div> <div class="text-item-error">' + params.intent_density_prev + ' → ' + params.intent_density_new + '</div></div>' +
                '<div class="error-item"><div class="title-item-error">Расстояние до ближайшего интента:</div> <div class="text-item-error">' + params.distant_to_nearest_intent_prev + ' → ' + params.distant_to_nearest_intent_new + '</div></div>' +
                '<div class="error-item"><div class="title-item-error">Пример вопроса с которым идёт пересечение в другом интенте:</div> <div class="text-item-error"> <a href="/admin/chat/intents?intent_id=' + params.nearest_intent_sample_chat_intent_id + '" target="_blank">' + params.nearest_intent_sample_text + ' (' + params.nearest_intent_sample_chat_intent + ')</a></div></div>' +
                '</div>',
                'Внимание!',
                {
                  confirmButtonText: 'Да',
                  cancelButtonText: 'Нет',
                  dangerouslyUseHTMLString: true,
                }
              )
                .then(() => {
                  this.createTestRequests();
                })
                .catch(() => {
                  ElMessage({
                    type: 'info',
                    message: 'Добавление отменено',
                  });
                });
            }
          })();
        } else {
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    },
    createTestRequests() {
      this.loadSaveTestRequests = true;
      this.$axios.post(this.linkAPI + 'chat/intents/' + this.intentInfo.id + '/test_requests/create', this.testRequests)
        .then((response) => {
          console.log('Создание нового примера вопроса:', response.data);
          if (response.data.success) {
            this.modalActiveText = false;
            ElMessage({
              type: 'success',
              message: 'Пример вопроса успешно добавлен',
            });
            this.getIntent(this.intentInfo.id);
          } else {
            ElMessage({
              type: 'error',
              message: response.data.error,
            });
          }
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadSaveTestRequests = false;
        });
    },
    setNewTestRequests(id) {
      this.testRequests.text = null;
      this.recommendationList = [];
      this.modalActiveText = true;
      this.getRecommendations(id);
    },
    getRecommendations(id) {
      this.loadRecommendation = true;
      this.$axios.get(this.linkAPI + 'chat/intents/' + id + '/get_recommendations')
        .then((response) => {
          console.log('Рекомендации примеров вопросов:', response);
          this.recommendationList = response.data;
          this.$nextTick(() => {
            const input = this.$refs.textQuestion.$el.querySelector('input');
            input.focus();
            input.setSelectionRange(input.value.length, input.value.length);
          });
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadRecommendation = false;
        })
      ;
    },
    deleteTestRequest(testRequest) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить "' + testRequest.text + '"?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadIntent = true;
          this.$axios.post(this.linkAPI + 'chat/intents/test_requests/' + testRequest.id + '/delete')
            .then((response) => {
              console.log('Удаление примера вопроса:', response.data);
              this.loadIntent = false;
              if (response.data.success) {
                this.getIntent(this.intentInfo.id);
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
                });
              }
            })
            .catch((error) => {
              this.loadIntent = false;
              console.log(error);
            });
        })
        .catch(() => {
          ElMessage({
            type: 'info',
            message: 'Удаление отменено',
          });
        });
    },
    async canCreate(id, text) {
      this.loadSaveTestRequests = true;
      let response = await this.$axios.post(this.linkAPI + 'chat/intents/' + id + '/test_requests/can_create', {text: text});
      this.loadSaveTestRequests = false;
      return response;
    },
    async deleteIntent(id) {
      try {
        let response = await this.$axios.post(this.linkAPI + 'chat/intents/' + id + '/delete');
        return response;
      } catch (error) {
        console.log(error);
        return error;
      }
    },
    setDeleteIntent(intent) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить интент «' + intent.name + '»?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(async () => {
          this.loadingTable = true;
          let response = await this.deleteIntent(intent.id);
          this.loadingTable = false;
          if (response.data.success) {
            ElMessage({
              type: 'success',
              message: 'Интент успешно удален',
            });
            this.getIntentsList(this.pagination.current_page);
          } else {
            ElMessage({
              type: 'error',
              message: response.data.error,
            });
          }
        })
        .catch(() => {
          ElMessage({
            type: 'info',
            message: 'Удаление отменено',
          });
        });

    },
    setDeleteIntentGroup() {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить выбранные интенты?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadingTable = true;
          Promise.allSettled(this.selectTable.map(item => this.deleteIntent(item.id))).finally(() => {
            this.loadingTable = false;
            this.getIntentsList(this.pagination.current_page);
          });
        })
        .catch(() => {
          ElMessage({
            type: 'info',
            message: 'Удаление отменено',
          });
        });
    },
    initialData() {
      if (this.$route.query.intent_id) {
        this.getIntent(this.$route.query.intent_id);
      }
      if (this.$route.query.name) {
        this.filter.name = this.$route.query.name;
      }
      if (this.$route.query.exclude_vika_type_id) {
        this.filter.exclude_vika_type_id = parseInt(this.$route.query.exclude_vika_type_id);
      }
      if (this.$route.query.active) {
        this.filter.active = parseInt(this.$route.query.active);
      }
      if (this.$route.query.current_page) {
        this.pagination.current_page = parseInt(this.$route.query.current_page);
      }
      if (this.$route.query.per_page) {
        this.pagination.per_page = parseInt(this.$route.query.per_page);
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
    handleClose(done) {
      this.closeIntent();
      done();
    },
    closeIntent() {
      this.modalActive = false;
      this.full = false;
      this.rules = {
        'name': [{
          required: true,
          message: 'Введите название',
          trigger: 'blur',
        }],
        'code': [{
          required: true,
          message: 'Введите код',
          trigger: 'blur',
        }],
        'handler_id': [{
          required: true,
          message: 'Выберите обработчик',
          trigger: 'change',
        }],
      };
      this.setParams('intent_id', null);
    },
    setGraphic(force_update) {
      this.dataGraphic = null;
      this.modalGraphic = true;
      this.loadGraphic = true;
      this.$axios.post(this.linkAPI + 'chat/intents/get_plot', {force_update: force_update})
        .then((response) => {
          console.log('График:', response);
          this.dataGraphic = response.data;
        })
        .finally(() => {
          this.loadGraphic = false;
        });
    },
    beforeCloseGraphic(done) {
      this.loadGraphic = false;
      this.dataGraphic = null;
      done();
    },
    getHandlers() {
      this.loadingHandler = true;
      this.$axios.get(this.linkAPI + 'chat/intents/get_handlers')
        .then((response) => {
          console.log('Обработчики интентов:', response);
          this.handlerList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingHandler = false;
        })
      ;
    },
    isHandler(id) {
      if(id !== null && id !== ''){
        if (this.handlerList.find(item => item.id === id).code === 'llm_with_prompt') {
          this.rules['document'] = [{
              required: true,
              message: 'Введите контекст поиска',
              trigger: 'blur',
            }];
          this.rules['system_prompt'] = [{
              required: true,
              message: 'Введите системный промпт',
              trigger: 'blur',
            }];
          this.full = true;
        } else {
          delete this.rules['document'];
          delete this.rules['system_prompt'];
          this.full = false;
        }
      }
    }
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: repeat(3, auto) max-content max-content;
  gap: 20px;
}

.table-box {
  margin-top: 20px;
}

.table-box ul {
  margin: 0;
  padding-left: 20px;
}

.pagination-box {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 20px;
}

.table-button-box {
  display: flex;
  flex-wrap: nowrap;
  gap: 5px;
}

.dialog-footer {
  display: flex;
  gap: 10px;
  align-items: center;
  justify-content: flex-end;
}

.ico {
  width: 22px;
  height: 22px;
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 22px;
}

.ico.ico-edit {
  background-color: var(--el-color-white);
  mask-image: url("../../../assets/icons/Pencil.svg");
}

.ico.ico-delete {
  background-color: var(--el-color-white);
  mask-image: url("../../../assets/icons/Trash 3.svg");
}

.ico.ico-close {
  background-color: var(--el-color-black);
  mask-image: url("../../../assets/icons/Cross.svg");
}

.ico.ico-login {
  background-color: var(--el-color-white);

  mask-image: url("../../../assets/icons/Sign_in.svg");
}

.test-requests-box {
  max-height: 50dvh;
  overflow-y: auto;
}

.test-requests-title {
  font-size: 18px;
  font-weight: 500;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
}

.test-requests-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 20px;
  gap: 20px;
}

.recommendation-box {
  min-height: 50px;
}

.title-recommendation {
  font-size: 16px;
  font-weight: 500;
}

.item-recommendation {
  margin-top: 5px;
}

.graphic-box {
  width: 100%;
  height: calc(100% - 23px);
}

@media (width <= 1200px) {
  .filter-box {
    grid-template-columns: 1fr 1fr;
  }
}

@media (width <= 992px) {
  .filter-box {
    grid-template-columns: 1fr;
  }
}

@media (width <= 768px) {
  .filter-box {
    grid-template-columns: 1fr;
  }
}


</style>

<style>
.error-message-box .error-question {
  margin-bottom: 10px;
  font-weight: 600;
  font-size: 16px;
}

.error-message-box .error-description {
  margin-bottom: 10px;
  line-height: 140%;
}

.error-message-box .error-item {
  margin-bottom: 15px;
}

.error-message-box .error-item .title-item-error {
  font-size: 13px;
  line-height: 120%;
  margin-bottom: 5px;
}

.error-message-box .error-item .text-item-error {
  font-size: 16px;
  font-weight: 600;
}

</style>
