<template>
  <div class="answers-list">
    <div class="white-box filter-box">
      <el-input
        v-model="filter.name"
        size="large"
        clearable
        placeholder="Поиск по названию"
        @clear="getIntentsList(); setParams('name', filter.name);"
        @keyup.enter="getIntentsList(); setParams('name', filter.name);"
      ></el-input>
      <el-select
        v-model="filter.intent_id"
        placeholder="Интент"
        filterable
        clearable
        :loading="loadingIntents"
        size="large"
        @change="getIntentsList(); setParams('intent_id', filter.intent_id);">
        <el-option
          v-for="item in intentsList"
          :key="'intentsList'+item.id"
          :label="item.name"
          :value="item.id"
        >
        </el-option>
      </el-select>
      <el-select
        v-model="filter.vika_type_id"
        placeholder="Тип Vika"
        filterable
        clearable
        :loading="loadingVikaTypes"
        size="large"
        @change="getIntentsList(); setParams('vika_type_id', filter.vika_type_id);">
        <el-option
          v-for="item in vikaTypesList"
          :key="'vikaTypesList'+item.id"
          :label="item.description"
          :value="item.id"
        >
        </el-option>
      </el-select>
      <el-select
        v-model="filter.is_active"
        placeholder="Активность"
        filterable
        clearable
        size="large"
        @change="getIntentsList(); setParams('is_active', filter.is_active);">
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
        type="success"
        @click="setNewAnswer()"
      >
        Добавить ответ
      </el-button>
    </div>
    <div class="table-box white-box">
      <el-table
        ref="answerTable"
        v-loading="loadingTable"
        :data="answersList"
        row-key="id"
        style="width: 100%"
        stripe
        table-layout="auto"
        :scrollbar-always-on="true"
        @selection-change="selectionTableChange"
      >
        <el-table-column type="selection" width="55"/>
        <el-table-column property="name" label="Название">
          <template #default="scope">
            {{ scope.row.name }}
          </template>
        </el-table-column>
        <el-table-column property="vika_type" label="Тип Vika">
          <template #default="scope">
            <div v-if="scope.row.vika_type!==null">{{ scope.row.vika_type.description }}
              ({{ scope.row.vika_type.name }})
            </div>
            <div v-else>Не задан</div>
          </template>
        </el-table-column>
        <el-table-column property="chat_intent" label="Интент">
          <template #default="scope">
            <div v-if="scope.row.chat_intent!==null">{{ scope.row.chat_intent.name }}
              ({{ scope.row.chat_intent.code }})
            </div>
            <div v-else>Не задан</div>
          </template>
        </el-table-column>
        <el-table-column label="Активность" align="center" header-align="center">
          <template #default="scope">
            {{ scope.row.is_active ? 'Активен' : 'Не активен' }}
          </template>
        </el-table-column>
        <el-table-column label="" width="100px" align="center" header-align="center">
          <template #default="scope">
            <div class="table-button-box">
              <el-button circle type="warning" title="Редактировать ответ" @click="getIntent(scope.row.id)">
                <div class="ico ico-edit"></div>
              </el-button>
              <el-button circle type="danger" title="Удалить ответ" @click="setDeleteAnswer(scope.row)">
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
          @click="setDeleteAnswerGroup()">
          <div class="ico ico-delete"></div>
        </el-button>
      </div>

    </div>


    <el-drawer
      v-if="modalActive"
      v-model="modalActive"
      :title="answerInfo.id ? 'Редактирование ответа' :'Новый ответ'"
      :close-on-click-modal="false"
      size="100%"
      direction="btt"
      :before-close="handleClose"
    >

      <div class="title-box">Общая информация</div>

      <div class="form-box">
        <div class="item-form">
          <div class="title-item-form">Тип Vika
            <div class="required">*</div>
          </div>
          <el-select
            v-model="answerInfo.vika_type_id"
            placeholder="Тип Vika"
            filterable
            clearable
            :disabled="answerInfo.id!==undefined"
            :loading="loadingVikaTypes"
            :value-on-clear="null"
            size="large"
            :class="{ 'is-error': errors.vika_type_id }"
            @change="changeVikaType();errors.vika_type_id = null;">
            <el-option
              v-for="item in vikaTypesList"
              :key="'vikaTypesListAnswer'+item.id"
              :label="item.description+ ' ('+item.name+')'"
              :value="item.id"
            >
              {{ item.description }} ({{ item.name }})
            </el-option>
          </el-select>
          <div v-if="errors.vika_type_id" class="el-form-item__error">{{ errors.vika_type_id }}</div>
        </div>

        <div class="item-form">
          <div class="title-item-form">Интент
            <div class="required">*</div>
          </div>
          <el-select
            v-model="answerInfo.intent_id"
            placeholder="Интент"
            filterable
            clearable
            :value-on-clear="null"
            :disabled="answerInfo.vika_type_id===null || answerInfo.id!==undefined"
            :loading="loadingIntentsAnswer"
            size="large"
            :class="{ 'is-error': errors.intent_id }"
            @change="setAnswerName();errors.intent_id = null;">
            <el-option
              v-for="item in intentsListAnswer"
              :key="'intentsListAnswer'+item.id"
              :label="item.name + ' ('+item.code+')'"
              :value="item.id"
            >
              {{ item.name }} ({{ item.code }})
            </el-option>
          </el-select>
          <div v-if="errors.intent_id" class="el-form-item__error">{{ errors.intent_id }}</div>
          <div v-if="answerInfo.vika_type_id===null" class="message-item-form">Необходимо указать Тип Vika</div>
        </div>

        <div class="item-form">
          <div class="title-item-form">Название
            <div class="required">*</div>
          </div>
          <el-input
            v-model="answerInfo.name"
            placeholder="Название"
            size="large"
            :class="{ 'is-error': errors.name }"
            @input="errors.name = null;"
          />
          <div v-if="errors.name" class="el-form-item__error">{{ errors.name }}</div>
        </div>

        <div class="item-form">
          <div class="title-item-form">Активность</div>
          <el-checkbox
            v-model="answerInfo.is_active"
            label="Активен" size="large"/>
        </div>
      </div>

      <div class="title-box">
        Варианты текстов ответа
        <div class="form-button-box">
          <el-button type="primary" @click="setNewAnswerText()">Добавить текст</el-button>
        </div>
      </div>

      <div class="answer-text-box">
        <div
          v-for="(answer_text_item, answer_text_index) in answerInfo.chat_answer_texts"
          :key="'answer_text'+answer_text_index"
          class="item-answer-text">
          <div style="width: 100%">
            <el-input
              v-model="answerInfo.chat_answer_texts[answer_text_index]"
              placeholder="Вариант текста"
              style="width: 100%"
              :rows="4"
              :class="{ 'is-error': errors.chat_answer_texts[answer_text_index] }"
              type="textarea"
              @input="errors.chat_answer_texts[answer_text_index]=null"
            />
            <div v-if="errors.chat_answer_texts[answer_text_index]" class="el-form-item__error">
              {{ errors.chat_answer_texts[answer_text_index] }}
            </div>
          </div>
          <el-button circle type="danger" title="Удалить текст" @click="deleteAnswerText(answer_text_index)">
            <div class="ico ico-delete"></div>
          </el-button>
        </div>
      </div>

      <div class="title-box">
        Кнопки
        <div class="form-button-box">
          <el-button type="primary" @click="setNewAnswerButton()">Добавить кнопку</el-button>
        </div>
      </div>

      <div class="answer-button-box">
        <div
          v-for="(answer_button_item, answer_button_index) in answerInfo.chat_answer_buttons"
          :key="'answer_button_item'+answer_button_index" class="item-answer-button">
          <div class="title-close-box">
            Кнопка №{{ answer_button_index + 1 }}
            <el-button link title="Удалить кнопку" @click="deleteAnswerButton(answer_button_index)">
              <div class="ico ico-close"></div>
            </el-button>
          </div>
          <div class="form-box">
            <div class="item-form">
              <div class="title-item-form">Тип кнопки
                <div class="required">*</div>
              </div>
              <el-select
                v-model="answerInfo.chat_answer_buttons[answer_button_index].button_type_id"
                placeholder="Тип кнопки"
                filterable
                clearable
                :value-on-clear="null"
                :loading="loadingButtonType"
                :class="{ 'is-error': errors.chat_answer_buttons[answer_button_index].button_type_id }"
                size="large"
                @change="answerInfo.chat_answer_buttons[answer_button_index].url = null; answerInfo.chat_answer_buttons[answer_button_index].chat_widget_id = null; errors.chat_answer_buttons[answer_button_index].button_type_id = null;">
                <el-option
                  v-for="item in buttonTypeList"
                  :key="answer_button_index+'buttonTypeList'+item.id"
                  :label="item.name"
                  :value="item.id"
                >
                </el-option>
              </el-select>
              <div v-if="errors.chat_answer_buttons[answer_button_index].button_type_id" class="el-form-item__error">
                {{ errors.chat_answer_buttons[answer_button_index].button_type_id }}
              </div>
            </div>
            <div class="item-form">
              <div class="title-item-form">Название кнопки
                <div class="required">*</div>
              </div>
              <el-input
                v-model="answerInfo.chat_answer_buttons[answer_button_index].name"
                placeholder="Название кнопки"
                size="large"
                :class="{ 'is-error': errors.chat_answer_buttons[answer_button_index].name }"
                @input="errors.chat_answer_buttons[answer_button_index].name=null;"
              />
              <div v-if="errors.chat_answer_buttons[answer_button_index].name" class="el-form-item__error">
                {{ errors.chat_answer_buttons[answer_button_index].name }}
              </div>
            </div>
            <div class="item-form">
              <div class="title-item-form">Надпись на кнопке
                <div class="required">*</div>
              </div>
              <el-input
                v-model="answerInfo.chat_answer_buttons[answer_button_index].button_message_text"
                placeholder="Надпись на кнопке"
                size="large"
                :class="{ 'is-error': errors.chat_answer_buttons[answer_button_index].button_message_text }"
                @input="errors.chat_answer_buttons[answer_button_index].button_message_text=null;"
              />
              <div
                v-if="errors.chat_answer_buttons[answer_button_index].button_message_text"
                class="el-form-item__error">{{ errors.chat_answer_buttons[answer_button_index].button_message_text }}
              </div>
            </div>
            <div
              v-if="isTypeButton(answerInfo.chat_answer_buttons[answer_button_index].button_type_id, 'link')"
              class="item-form">
              <div class="title-item-form">Ссылка
                <div class="required">*</div>
              </div>
              <el-input
                v-model="answerInfo.chat_answer_buttons[answer_button_index].url"
                placeholder="URL"
                size="large"
                :class="{ 'is-error': errors.chat_answer_buttons[answer_button_index].url }"
                @input="errors.chat_answer_buttons[answer_button_index].url=null;"
              />
              <div v-if="errors.chat_answer_buttons[answer_button_index].url" class="el-form-item__error">
                {{ errors.chat_answer_buttons[answer_button_index].url }}
              </div>
            </div>
            <div
              v-if="isTypeButton(answerInfo.chat_answer_buttons[answer_button_index].button_type_id, 'widget')"
              class="item-form">
              <div class="title-item-form">Виджет
                <div class="required">*</div>
              </div>
              <el-select
                v-model="answerInfo.chat_answer_buttons[answer_button_index].chat_widget_id"
                placeholder="Виджет"
                filterable
                clearable
                :disabled="answerInfo.vika_type_id===null"
                :value-on-clear="null"
                :loading="loadingWidgetAnswer"
                :class="{ 'is-error': errors.chat_answer_buttons[answer_button_index].chat_widget_id }"
                size="large"
                @change="errors.chat_answer_buttons[answer_button_index].chat_widget_id=null;">
                <el-option
                  v-for="item in widgetListAnswer"
                  :key="answer_button_index+'widgetListAnswer'+item.id"
                  :label="item.name"
                  :value="item.id"
                >
                </el-option>
              </el-select>
              <div v-if="errors.chat_answer_buttons[answer_button_index].chat_widget_id" class="el-form-item__error">
                {{ errors.chat_answer_buttons[answer_button_index].chat_widget_id }}
              </div>
              <div v-if="answerInfo.vika_type_id===null" class="message-item-form">Необходимо указать Тип Vika</div>
            </div>
          </div>
          <div class="title-box">
            Сущности
            <div class="form-button-box">
              <el-button type="primary" @click="setNewAnswerButtonEntity(answer_button_index)">Добавить сущность
              </el-button>
            </div>
          </div>

          <div class="button-entities-box">
            <div
              v-for="(button_entities_item, button_entities_index) in answerInfo.chat_answer_buttons[answer_button_index].chat_answer_button_entities"
              :key="answer_button_index+'button_entities_item'+button_entities_index" class="button-entities-item">
              <div class="title-close-box">
                Сущность №{{ button_entities_index + 1 }}
                <el-button
                  link title="Удалить сущность"
                  @click="deleteAnswerButtonEntity(answer_button_index, button_entities_index)">
                  <div class="ico ico-close"></div>
                </el-button>
              </div>


              <div class="form-box">
                <div class="item-form">
                  <div class="title-item-form">Название
                    <div class="required">*</div>
                  </div>
                  <el-input
                    v-model="answerInfo.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].name"
                    placeholder="Название"
                    size="large"
                    :class="{ 'is-error': errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].name }"
                    @input="errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].name=null;"
                  />
                  <div
                    v-if="errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].name"
                    class="el-form-item__error">{{
                      errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].name
                    }}
                  </div>
                </div>

                <div class="item-form">
                  <div class="title-item-form">Код
                    <div class="required">*</div>
                  </div>
                  <el-input
                    v-model="answerInfo.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].code"
                    placeholder="Код"
                    size="large"
                    :class="{ 'is-error': errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].code }"
                    @input="errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].code=null;"
                  />
                  <div
                    v-if="errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].code"
                    class="el-form-item__error">{{
                      errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].code
                    }}
                  </div>
                </div>

                <div class="item-form">
                  <div class="title-item-form">Название параметра кнопки
                    <div class="required">*</div>
                  </div>
                  <el-input
                    v-model="answerInfo.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].param_name"
                    placeholder="Название параметра кнопки"
                    size="large"
                    :class="{ 'is-error': errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].param_name }"
                    @input="errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].param_name=null;"
                  />
                  <div
                    v-if="errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].param_name"
                    class="el-form-item__error">{{
                      errors.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].param_name
                    }}
                  </div>
                </div>

                <div class="item-form">
                  <div class="title-item-form">Множественность</div>
                  <el-checkbox
                    v-model="answerInfo.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].multiple"
                    label="Множественное" size="large"/>
                </div>

                <div class="item-form">
                  <div class="title-item-form">Название таблицы</div>
                  <el-input
                    v-model="answerInfo.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].table"
                    placeholder="Название таблицы"
                    size="large"
                  />
                </div>

                <div class="item-form">
                  <div class="title-item-form">Название колонки поиска</div>
                  <el-input
                    v-model="answerInfo.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].search_column"
                    placeholder="Название колонки поиска"
                    size="large"
                  />
                </div>

                <div class="item-form">
                  <div class="title-item-form">Название колонки значения</div>
                  <el-input
                    v-model="answerInfo.chat_answer_buttons[answer_button_index].chat_answer_button_entities[button_entities_index].value_column"
                    placeholder="Название колонки значения"
                    size="large"
                  />
                </div>

              </div>
            </div>
          </div>
        </div>
        <div v-if="answerInfo.chat_answer_buttons.length!==0" class="form-button-box">
          <el-button type="primary" @click="setNewAnswerButton()">Добавить кнопку</el-button>
        </div>
      </div>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeAnswer()">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="answerInfo.id ? updateAnswer() :createAnswer()">
            {{ answerInfo.id ? 'Сохранить' : 'Добавить' }}
          </el-button>
        </div>
      </template>

    </el-drawer>

  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'AnswersList',
  data() {
    return {
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      filter: {
        name: null,
        intent_id: null,
        is_active: null,
        vika_type_id: null,
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
      loadingIntents: false,
      loadingIntentsAnswer: false,
      loadingButtonType: false,
      loadingWidgetAnswer: false,
      intentsList: [],
      intentsListAnswer: [],
      vikaTypesList: [],
      buttonTypeList: [],
      loadingTable: false,
      loadingVikaTypes: false,
      answersList: [],
      selectTable: [],
      widgetListAnswer: [],
      answerInfo: {
        is_active: true,
        intent_id: null,
        vika_type_id: null,
        name: null,
        chat_answer_texts: [],
        chat_answer_buttons: []
      },
      modalActive: false,
      loadSave: false,
      errors: {
        is_active: null,
        vika_type_id: null,
        intent_id: null,
        name: null,
        chat_answer_texts: [],
        chat_answer_buttons: [],
      },
      formSave:null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI', 'isMobile']),
  },
  created() {
    this.initialData();
    this.getIntents();
    this.getIntentsList();
    this.getVikaTypes();
    this.getButtonTypeList();
  },
  methods: {
    getIntents() {
      this.loadingIntents = true;
      this.$axios.get(this.linkAPI + 'chat/intents/list')
        .then((response) => {
          console.log('Интенты:', response);
          this.intentsList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingIntents = false;
        })
      ;
    },
    getIntentsAnswer() {
      this.loadingIntentsAnswer = true;
      this.$axios.get(this.linkAPI + 'chat/intents/list', {params: {exclude_vika_type_id: this.answerInfo.vika_type_id}})
        .then((response) => {
          console.log('Интенты для типа Vika:', response);
          this.intentsListAnswer = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingIntentsAnswer = false;
        })
      ;
    },
    getWidgetByVikaType() {
      this.loadingWidgetAnswer = true;
      this.$axios.get(this.linkAPI + 'chat/widgets/list', {params: {include_vika_types: [this.answerInfo.vika_type_id]}})
        .then((response) => {
          console.log('Виджеты для типа Vika:', response);
          this.widgetListAnswer = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingWidgetAnswer = false;
        })
      ;
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
        })
      ;
    },
    getIntentsList(page) {
      this.loadingTable = true;
      let params = this.filter;
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;
      this.$axios.get(this.linkAPI + 'chat/answers/list', {params})
        .then((response) => {
          console.log('Ответы:', response);
          this.answersList = response.data.data;
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
    selectionTableChange(selection) {
      this.selectTable = selection;
    },
    handleCurrentChange(val) {
      this.getIntentsList(val);
      this.setParams('current_page',val);
    },
    handleSizeChange(val) {
      this.getIntentsList();
      this.setParams('per_page',val);
    },
    setNewAnswer() {
      this.answerInfo = {
        is_active: true,
        intent_id: null,
        vika_type_id: null,
        name: null,
        chat_answer_texts: [],
        chat_answer_buttons: []
      };
      this.errors = {
        is_active: null,
        vika_type_id: null,
        intent_id: null,
        name: null,
        chat_answer_texts: [],
        chat_answer_buttons: [],
      };
      this.modalActive = true;
      this.formSave = JSON.stringify(this.answerInfo);
    },
    setAnswerName() {
      this.answerInfo.name = 'Ответ для интента "' + this.intentsList.find(item => item.id === this.answerInfo.intent_id).name + '" типа Vika "' + this.vikaTypesList.find(item => item.id === this.answerInfo.vika_type_id).description + '"';
    },
    setNewAnswerText() {
      this.answerInfo.chat_answer_texts.push(null);
      this.errors.chat_answer_texts.push(null);
    },
    deleteAnswerText(index) {
      if(this.answerInfo.chat_answer_texts[index]===null || this.answerInfo.chat_answer_texts[index]===''){
        this.answerInfo.chat_answer_texts.splice(index, 1);
        this.errors.chat_answer_texts.splice(index, 1);
      }else{
        ElMessageBox.confirm(
          'Вы действительно хотите удалить текст?',
          'Внимание!',
          {
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет',
            type: 'warning',
          }
        )
          .then(() => {
            this.answerInfo.chat_answer_texts.splice(index, 1);
            this.errors.chat_answer_texts.splice(index, 1);
          })
          .catch(() => {
            ElMessage({
              type: 'info',
              message: 'Удаление отменено',
            });
          });
      }

    },
    setNewAnswerButton() {
      this.answerInfo.chat_answer_buttons.push({
        button_type_id: null,
        name: null,
        button_message_text: null,
        url: null,
        chat_widget_id: null,
        chat_answer_button_entities: []
      });
      this.errors.chat_answer_buttons.push({
        button_type_id: null,
        name: null,
        button_message_text: null,
        url: null,
        chat_widget_id: null,
        chat_answer_button_entities: []
      });
      this.$nextTick(() => {
        const messagesBox = document.querySelector('.el-drawer__body');
        if (messagesBox) {
          messagesBox.scrollTo({
            top: messagesBox.scrollHeight,
            behavior: 'smooth', // Плавная анимация если не задан параметр
          });
        }
      });
    },
    deleteAnswerButton(index) {
      let clear = {button_type_id: null, name: null, button_message_text: null, url: null, chat_widget_id: null, chat_answer_button_entities: []};
      if(JSON.stringify(this.answerInfo.chat_answer_buttons[index]) === JSON.stringify(clear)){
        this.answerInfo.chat_answer_buttons.splice(index, 1);
        this.errors.chat_answer_buttons.splice(index, 1);
      }else{
        ElMessageBox.confirm(
          'Вы действительно хотите удалить кнопку?',
          'Внимание!',
          {
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет',
            type: 'warning',
          }
        )
          .then(() => {
            this.answerInfo.chat_answer_buttons.splice(index, 1);
            this.errors.chat_answer_buttons.splice(index, 1);
          })
          .catch(() => {
            ElMessage({
              type: 'info',
              message: 'Удаление отменено',
            });
          });
      }

    },
    setNewAnswerButtonEntity(index) {
      this.answerInfo.chat_answer_buttons[index].chat_answer_button_entities.push({
        name: null,
        code: null,
        param_name: null,
        multiple: false,
        table: null,
        search_column: null,
        value_column: null
      });
      this.errors.chat_answer_buttons[index].chat_answer_button_entities.push({
        name: null,
        code: null,
        param_name: null,
        multiple: false,
        table: null,
        search_column: null,
        value_column: null
      });
    },
    deleteAnswerButtonEntity(index, indexEntity) {
      let clear = {
        name: null,
        code: null,
        param_name: null,
        multiple: false,
        table: null,
        search_column: null,
        value_column: null
      };

      if(JSON.stringify(this.answerInfo.chat_answer_buttons[index].chat_answer_button_entities[indexEntity]) === JSON.stringify(clear)){
        this.answerInfo.chat_answer_buttons[index].chat_answer_button_entities.splice(indexEntity, 1);
        this.errors.chat_answer_buttons[index].chat_answer_button_entities.splice(indexEntity, 1);
      }else{
        ElMessageBox.confirm(
          'Вы действительно хотите удалить сущность?',
          'Внимание!',
          {
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет',
            type: 'warning',
          }
        )
          .then(() => {
            this.answerInfo.chat_answer_buttons[index].chat_answer_button_entities.splice(indexEntity, 1);
            this.errors.chat_answer_buttons[index].chat_answer_button_entities.splice(indexEntity, 1);
          })
          .catch(() => {
            ElMessage({
              type: 'info',
              message: 'Удаление отменено',
            });
          });
      }
    },
    getButtonTypeList() {
      this.loadingButtonType = true;
      this.$axios.get(this.linkAPI + 'chat/button_types/list')
        .then((response) => {
          console.log('Типы кнопок:', response);
          this.buttonTypeList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingButtonType = false;
        })
      ;
    },
    changeVikaType() {
      this.getIntentsAnswer();
      this.getWidgetByVikaType();
      this.answerInfo.intent_id = null;
      this.answerInfo.chat_answer_buttons.forEach(item => {
        item.chat_widget_id = null;
      });
    },
    isTypeButton(id, code) {
      let type = this.buttonTypeList.find(item => item.id === id);
      if (type !== undefined && type.code === code) {
        return true;
      } else {
        return false;
      }
    },
    isValidForm() {
      let isValid = true;

      if (!this.answerInfo.vika_type_id) {
        this.errors.vika_type_id = 'Укажите тип Vika';
        isValid = false;
      } else {
        this.errors.vika_type_id = null;
      }

      if (!this.answerInfo.intent_id) {
        this.errors.intent_id = 'Укажите интент';
        isValid = false;
      } else {
        this.errors.intent_id = null;
      }

      if (!this.answerInfo.name) {
        this.errors.name = 'Укажите название';
        isValid = false;
      } else {
        this.errors.name = null;
      }
      if (this.answerInfo.chat_answer_texts.length === 0) {
        isValid = false;
        ElMessage({
          type: 'error',
          message: 'Нужно добавить хотя бы один вариант текста ответа',
        });
      } else {
        this.answerInfo.chat_answer_texts.forEach((item, index) => {
          if (!item) {
            this.errors.chat_answer_texts[index] = 'Необходимо указать тест ответа';
            isValid = false;
          } else {
            this.errors.chat_answer_texts[index] = null;
          }
        });
      }
      if (this.answerInfo.chat_answer_buttons.length !== 0) {
        this.answerInfo.chat_answer_buttons.forEach((item, index) => {

          if (!item.button_type_id) {
            this.errors.chat_answer_buttons[index].button_type_id = 'Необходимо указать тип кнопки';
            isValid = false;
          } else {
            this.errors.chat_answer_buttons[index].button_type_id = null;
          }

          if (!item.name) {
            this.errors.chat_answer_buttons[index].name = 'Необходимо указать название кнопки';
            isValid = false;
          } else {
            this.errors.chat_answer_buttons[index].name = null;
          }

          if (!item.button_message_text) {
            this.errors.chat_answer_buttons[index].button_message_text = 'Необходимо указать надпись на кнопке';
            isValid = false;
          } else {
            this.errors.chat_answer_buttons[index].button_message_text = null;
          }

          if (this.isTypeButton(item.button_type_id, 'link') && !item.url) {
            this.errors.chat_answer_buttons[index].url = 'Необходимо указать ссылку';
            isValid = false;
          } else {
            this.errors.chat_answer_buttons[index].url = null;
          }

          if (this.isTypeButton(item.button_type_id, 'widget') && !item.chat_widget_id) {
            this.errors.chat_answer_buttons[index].chat_widget_id = 'Необходимо указать виджет';
            isValid = false;
          } else {
            this.errors.chat_answer_buttons[index].chat_widget_id = null;
          }

          if (item.chat_answer_button_entities.length !== 0) {
            item.chat_answer_button_entities.forEach((itemEntities, indexEntities) => {
              if (!itemEntities.name) {
                this.errors.chat_answer_buttons[index].chat_answer_button_entities[indexEntities].name = 'Необходимо указать название';
                isValid = false;
              } else {
                this.errors.chat_answer_buttons[index].chat_answer_button_entities[indexEntities].name = null;
              }

              if (!itemEntities.code) {
                this.errors.chat_answer_buttons[index].chat_answer_button_entities[indexEntities].code = 'Необходимо указать код';
                isValid = false;
              } else {
                this.errors.chat_answer_buttons[index].chat_answer_button_entities[indexEntities].code = null;
              }

              if (!itemEntities.param_name) {
                this.errors.chat_answer_buttons[index].chat_answer_button_entities[indexEntities].param_name = 'Необходимо указать название';
                isValid = false;
              } else {
                this.errors.chat_answer_buttons[index].chat_answer_button_entities[indexEntities].param_name = null;
              }
            });
          }


        });
      }

      return isValid;
    },
    createAnswer() {
      if (this.isValidForm()) {
        this.loadSave = true;
        let params = this.answerInfo;
        this.$axios.post(this.linkAPI + 'chat/answers/create', params)
          .then((response) => {
            this.loading = false;
            console.log('Создание нового ответа:', response.data);
            if (response.data.success) {
              this.modalActive = false;
              ElMessage({
                type: 'success',
                message: 'Ответ успешно добавлен',
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
            ElMessage({
              type: 'error',
              message: error.response.data.message,
            });
          })
          .finally(() => {
            this.loadSave = false;
          });
      } else {
        ElMessage.error('Заполните обязательные поля');
        return false;
      }
    },
    getIntent(id) {
      this.loadingTable = true;
      this.$axios.get(this.linkAPI + 'chat/answers/' + id + '/get')
        .then((response) => {
          console.log('Вопрос:', response);
          this.answerInfo = {
            id: response.data.id,
            is_active: response.data.is_active,
            intent_id: response.data.intent_id,
            vika_type_id: response.data.vika_type_id,
            name: response.data.name,
            chat_answer_texts: [],
            chat_answer_buttons: []
          };
          this.errors = {
            vika_type_id: null,
            intent_id: null,
            name: null,
            chat_answer_texts: [],
            chat_answer_buttons: [],
          };

          response.data.chat_answer_texts.forEach(item => {
            this.answerInfo.chat_answer_texts.push(item.text);
            this.errors.chat_answer_texts.push(null);
          });

          response.data.chat_answer_buttons.forEach(item => {
            this.answerInfo.chat_answer_buttons.push({
              button_type_id: item.button_type_id,
              name: item.name,
              button_message_text: item.button_message_text,
              url: item.url,
              chat_widget_id: item.chat_widget_id,
              chat_answer_button_entities: item.chat_answer_button_entities.map(itemMap => {
                return {
                  name: itemMap.name,
                  code: itemMap.code,
                  param_name: itemMap.param_name,
                  multiple: itemMap.multiple,
                  table: itemMap.table,
                  search_column: itemMap.search_column,
                  value_column: itemMap.value_column
                };
              })
            });
            this.errors.chat_answer_buttons.push({
              button_type_id: null,
              name: null,
              button_message_text: null,
              url: null,
              chat_widget_id: null,
              chat_answer_button_entities: item.chat_answer_button_entities.map(() => {
                return {
                  name: null,
                  code: null,
                  param_name: null,
                  multiple: null,
                  table: null,
                  search_column: null,
                  value_column: null,
                };
              })
            });
          });

          this.intentsListAnswer = [response.data.chat_intent];
          this.getWidgetByVikaType();
          this.modalActive = true;
          this.setParams('answer_id', this.answerInfo.id);
          this.formSave = JSON.stringify(this.answerInfo);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    updateAnswer() {
      if (this.isValidForm()) {
        this.loadSave = true;
        let params = this.answerInfo;
        this.$axios.post(this.linkAPI + 'chat/answers/' + this.answerInfo.id + '/update', params)
          .then((response) => {
            this.loading = false;
            console.log('Обновление ответа:', response.data);
            if (response.data.success) {
              this.modalActive = false;
              ElMessage({
                type: 'success',
                message: 'Ответ успешно изменен',
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
            ElMessage({
              type: 'error',
              message: error.response.data.message,
            });
            console.log(error);
          })
          .finally(() => {
            this.loadSave = false;
          });
      } else {
        ElMessage.error('Заполните обязательные поля');
        return false;
      }
    },
    async deleteAnswer(id) {
      try {
        let response = await this.$axios.post(this.linkAPI + 'chat/answers/' + id + '/delete');
        return response;
      } catch (error) {
        console.log(error);
        return error;
      }
    },
    setDeleteAnswer(answer) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить ответ «' + answer.name + '»?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(async () => {
          this.loadingTable = true;
          let response = await this.deleteAnswer(answer.id);
          this.loadingTable = false;
          if (response.data.success) {
            ElMessage({
              type: 'success',
              message: 'Ответ успешно удален',
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
    setDeleteAnswerGroup() {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить выбранные ответы?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadingTable = true;
          Promise.allSettled(this.selectTable.map(item => this.deleteAnswer(item.id))).finally(() => {
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
      if (this.$route.query.answer_id) {
        this.getIntent(this.$route.query.answer_id);
      }
      if (this.$route.query.name) {
        this.filter.name = this.$route.query.name;
      }
      if (this.$route.query.intent_id) {
        this.filter.intent_id = parseInt(this.$route.query.intent_id);
      }
      if (this.$route.query.is_active) {
        this.filter.is_active = parseInt(this.$route.query.is_active);
      }
      if (this.$route.query.vika_type_id) {
        this.filter.vika_type_id = parseInt(this.$route.query.vika_type_id);
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
      if(this.closeAnswer()){
        done();
      }
    },
    closeAnswer() {
      if(JSON.stringify(this.answerInfo)!== this.formSave){
        ElMessageBox.confirm(
          'Есть изменение. При закрытии окна они будут потеряны. Вы действительно хотите закрыть окно?',
          'Внимание!',
          {
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет',
            type: 'warning',
          }
        )
          .then(() => {
            this.modalActive = false;
            this.setParams('answer_id', null);
            return true;
          })
          .catch(()=>{
            return false;
          });
      }else{
        this.modalActive = false;
        this.setParams('answer_id', null);
        return true;
      }
    },
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: repeat(4, auto) max-content;
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

.answer-text-box {
  width: 100%;
  margin-bottom: 20px;
}

.answer-button-box {
  width: 100%;
}

.item-answer-button {
  padding: 20px;
  border: 1px solid var(--el-color-primary);
  border-radius: var(--el-border-radius-base);
  margin-bottom: 20px;
}

.answer-button-box .item-answer-button:last-child {
  margin-bottom: 0;
}

.answer-text-box .item-answer-text {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 20px;
  margin-top: 20px;
}

.answer-button-box .item-answer-button {
  width: 100%;
  margin-top: 20px;
}


.title-box {
  font-size: 18px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 20px;
  margin-bottom: 20px;
}

.form-box {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 20px;
  margin-bottom: 20px;
}

div .form-box:last-child {
  margin-bottom: 0;
}

.button-entities-item {
  width: 100%;
  padding: 20px;
  border: 1px solid var(--el-border-color);
  border-radius: var(--el-border-radius-base);
  margin-bottom: 20px;
}

.button-entities-box .button-entities-item:last-child {
  margin-bottom: 0;
}

.title-close-box {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
  font-weight: 500;
}

.title-item-form {
  font-size: 14px;
  font-weight: 400;
  margin-bottom: 3px;
  color: var(--el-text-color-primary);
  display: flex;
  align-items: center;
  gap: 5px;
}

.title-item-form .required {
  color: red;
  font-size: 16px;
}

.message-item-form {
  font-size: 13px;
  margin-top: 2px;
  font-weight: 300;
  color: var(--el-text-color-primary);
}

@media (width <= 1920px) {
  .form-box {
    grid-template-columns: repeat(4, 1fr);;
  }
}

@media (width <= 1200px) {
  .filter-box {
    grid-template-columns: 1fr 1fr;
  }

  .form-box {
    grid-template-columns: repeat(3, 1fr);;
  }
}

@media (width <= 992px) {
  .filter-box {
    grid-template-columns: 1fr;
  }

  .form-box {
    grid-template-columns: repeat(2, 1fr);;
  }
}

@media (width <= 768px) {
  .filter-box {
    grid-template-columns: 1fr;
  }

  .form-box {
    grid-template-columns: repeat(1, 1fr);;
  }
}


</style>
